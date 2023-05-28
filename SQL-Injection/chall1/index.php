<?php
// Menghubungkan ke database
$database = new SQLite3('tugasakhir.db');

// Inisialisasi variabel pesan
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menangkap data yang dikirim dari form login
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Menyeleksi data user dari database
    $query = "SELECT * FROM mahasiswa WHERE username = '$username' AND password = '$password'";
    $result = $database->query($query);

    // Mengecek apakah query berhasil dieksekusi
    if ($result) {
        // Menghitung jumlah data yang ditemukan
        $count = 0;
        while ($row = $result->fetchArray()) {
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

    // Menutup koneksi database
    $database->close();
}

// Menghitung panjang pesan
$contentLength = strlen($message);

// Menambahkan header "Content-Length" ke dalam respons HTTP
header("Content-Length: ". $contentLength);
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
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
