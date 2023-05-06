<?php
// cek apakah form telah disubmit
if (isset($_GET['nama']) && isset($_GET['email']) && isset($_GET['pesan'])) {

  // baca data dari query string
  $nama = $_GET["nama"];
  $email = $_GET["email"];
  $pesan = $_GET["pesan"];

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
<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="nama">Nama:</label>
  <input type="text" id="nama" name="nama"/>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email"/>

  <label for="pesan">Pesan:</label>
  <textarea id="pesan" name="pesan"></textarea>

  <input type="submit" value="Kirim"/>
</form>
