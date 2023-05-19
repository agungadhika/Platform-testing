const path = require("path")
const qs = require("qs")
const app = require("fastify")({ logger: true })
const mongodb = require("mongodb")

app.register(require('@fastify/formbody'), { parser: str => qs.parse(str) })
app.register(require('@fastify/cookie'))
app.register(require('@fastify/session'), {
    cookieName: 'sessionId',
    secret: 'a secret with minimum length of 32 characters',
    cookie: { secure: false },
    expires: 1800000
})
app.register(require("@fastify/view"), {
    engine: {
        ejs: require("ejs")
    },
    root: path.join(__dirname, "views"),
    propertyName: "view",
})

const port = process.env.PORT
const client = (() => {
    const dburi = "mongodb://admin:admin@mongo:27017/"
    const client = new mongodb.MongoClient(dburi)
    return client
})()
const userDb = client.db("user")
const credsCol = userDb.collection("creds")

app.get("/", async (_, res) => { return res.view("index") })
app.get("/login", async (_, res) => { return res.view("login") })
app.get("/signup", async (_, res) => { return res.view("signup") })
app.get("/about", async (_, res) => { return res.view("about") })
app.get("/services", async (_, res) => { return res.view("services") })
app.get("/contact", async (_, res) => { return res.view("contact") })
app.get("/home", async (req, res) => {
    if (!req.session.user) {
        return res.redirect(302, "/login")
    }
    return res.view("home", req)
})

app.post("/signup", async (req, res) => {
    const { username, password } = req.body
    try {
        await credsCol.insertOne({
            username: username,
            password: password
        })
        return res.view("signup", { success: "please login with your credential" })
    } catch (e) {
        console.error(e)
        return res.view("signup", { error: e.toString() })
    }
})

app.post("/login", async (req, res) => {
    const { username, password } = req.body
    try {
        const user = await credsCol.findOne({ username: username, password: password })
        if (!user) {
            res.code(400)
            return res.view("login", { error: "user not found!" })
        }
        req.session.user = user
        return res.redirect(303, "/home")
    } catch (e) {
        console.error(e)
        return res.view("login", { error: e.toString() })
    }
})

app.listen({
    port: port,
    host: "0.0.0.0",
}, async (err, address) => {
    if (err) {
        app.log.error(err)
        process.exit(1)
    }
    // init db
    await client.connect()
    await credsCol.createIndex({ username: 1 }, { unique: true })
    try {
        await credsCol.insertMany([
            { username: "admin", password: "securePassword123", isAdmin: true },
            { username: "johndoe", password: "johndoe123", isAdmin: false },
            { username: "johnhammond", password: "johnhammond", isAdmin: false },
            { username: "foo", password: "foo", isAdmin: false },
        ])
    } catch (e) {
        console.error(e)
    }
    app.log.info(`Fastify app listening at ${address}`)
})