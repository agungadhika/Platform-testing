<?php
// Membuat koneksi ke database SQLite3
$database = new SQLite3('tugasakhir.db');

// Inisialisasi variabel pesan
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['username']) && isset($_GET['password'])) {
    // Menangkap data yang dikirim dari form login
    $username = $_GET['username'];
    $password = $_GET['password'];

    // Mengeksekusi query untuk menyeleksi data user dari database
    $query = "SELECT * FROM mahasiswa WHERE username = '$username' AND password = '$password'";
    $result = $database->query($query);

    // Mengecek apakah query berhasil dieksekusi
    if ($result) {
        // Menghitung jumlah data yang ditemukan
        $count = 0;
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $count++;
        }

        // Mengecek apakah data ditemukan
        if ($count == 1) {
            $message = "Login berhasil!";
        } else {
            $message = "Login gagal!";
        }
    } else {
        // Jika terjadi kesalahan dalam eksekusi query
        $error = $database->lastErrorMsg();
        $message = "Kesalahan query: $error";
    }

    // Menutup koneksi ke database
    $database->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Login</title>
</head>
<body>
    <h1>Form Login</h1>
    <?php if (!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
