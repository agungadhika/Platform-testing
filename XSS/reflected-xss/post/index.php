<?php
	$nama = "";
	$output = "";
	$output_length = 0;

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$nama = $_POST['nama'];
		$output = "Terima kasih atas masukannya, $nama!";
		$output_length = strlen($output);
		header("Content-Length: $output_length");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Form Input dengan POST dan 1 Inputan</title>
</head>
<body>
	<form action="" method="post">
		<label for="nama">Nama:</label>
		<input type="text" id="nama" name="nama"><br>
		<input type="submit" value="Submit">
	</form>

	<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
		<h2>Output:</h2>
		<p><?php echo $output; ?></p>
		<p>Panjang Output: <?php echo $output_length; ?></p>
	<?php endif; ?>
</body>
</html>
