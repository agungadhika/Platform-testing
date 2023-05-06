<?php
// cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // baca data dari form
  $nama = $_POST["nama"];
  $email = $_POST["email"];
  $pesan = $_POST["pesan"];

  // buat dokumen XML
  $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><data></data>');
  $xml->addChild('nama', $nama);
  $xml->addChild('email', $email);
  $xml->addChild('pesan', $pesan);

  // tampilkan data
  header('Content-type: text/xml');
  echo $xml->asXML();
  exit;
}
?>

<!-- tampilkan form input -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="nama">Nama:</label>
  <input type="text" id="nama" name="nama"/>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email"/>

  <label for="pesan">Pesan:</label>
  <textarea id="pesan" name="pesan"></textarea>

  <input type="submit" value="Kirim"/>
</form>
