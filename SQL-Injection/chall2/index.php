<?php
// Membuat koneksi ke database SQLite3
$database = new SQLite3('tugasakhir.db');

// Menangkap data yang dikirim dari form login
$username = $_GET['username'];
$password = $_GET['password'];

// Mengeksekusi query untuk menyeleksi data user dari database
$query = "SELECT * FROM mahasiswa WHERE username = '$username' AND password = '$password'";
$result = $database->query($query);

// Menghitung jumlah data yang ditemukan
$count = 0;
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $count++;
}

// Mengecek apakah data ditemukan
if ($count == 1) {
    echo "Login berhasil!";
} else {
    echo "Login gagal!";
}

// Menutup koneksi ke database
$database->close();
?>
