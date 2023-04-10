<?php
// Menghubungkan ke database
$host = "localhost";
$user = "root";
$password = "ikantongkol";
$database = "tugasakhir";
$koneksi = mysqli_connect($host, $user, $password, $database);

// Menangkap data yang dikirim dari form login
$username = $_GET['username'];
$password = $_GET['password'];

// Menyeleksi data user dari database
$query = "SELECT * FROM mahasiswa WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($koneksi, $query);

// Menghitung jumlah data yang ditemukan
$count = mysqli_num_rows($result);

// Mengecek apakah data ditemukan
if ($count == 1) {
	echo "Login berhasil!";
} else {
	echo "Login gagal!";
}
?>
