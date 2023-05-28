<?php
	$nama = "";
	$komentar = "";
	$nama_length = 0;
	$komentar_length = 0;

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$nama = $_POST['nama'];
		$komentar = $_POST['komentar'];
		$nama_length = strlen($nama);
		$komentar_length = strlen($komentar);
	}

	$output = "Terima kasih atas masukannya";
	$output_length = strlen($output);

	header('Content-Length: ' . $output_length);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Form Input</title>
</head>
<body>
	<form action="" method="post">
		<label for="nama">Nama:</label>
		<input type="text" id="nama" name="nama" value="<?php echo $nama; ?>"><br>

		<label for="komentar">Komentar:</label>
		<textarea id="komentar" name="komentar"><?php echo $komentar; ?></textarea><br>

		<input type="submit" value="Submit">
	</form>

	<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
		<h2>Terima kasih atas masukannya, <?php echo $nama; ?>!</h2>
		<p><?php echo $komentar; ?></p>
	<?php endif; ?>
</body>
</html>
