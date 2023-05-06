<?php
// Menghubungkan ke database
$database = new SQLite3('tugasakhir.db');

// Menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Menyeleksi data user dari database
$query = "SELECT * FROM mahasiswa WHERE username = '$username' AND password = '$password'";
$result = $database->query($query);

// Menghitung jumlah data yang ditemukan
$count = 0;
while ($row = $result->fetchArray()) {
  $count++;
}

// Mengecek apakah data ditemukan
if ($count == 1) {
  echo "Login berhasil!";
} else {
  echo "Login gagal!";
}
?>
