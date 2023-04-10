<!DOCTYPE html>
<html>
<head>
	<title>Contoh Halaman XSS</title>
</head>
<body>
<h1>Selamat datang!</h1>
    <?php
        $name = $_GET['nama'];
        // $age = $_GET['age'];
        echo "Hello, $name!";
    ?>

	<!-- <p>Halo, <?php echo $_GET['nama']; ?></p> -->
</body>
</html>