<!DOCTYPE html>
<html>
<head>
	<title>Hasil Submit</title>
</head>
<body>
	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$nama = $_POST['nama'];
			$komentar = $_POST['komentar'];

			echo "<h2>Terima kasih atas masukannya, $nama!</h2>";
			echo "<p>$komentar</p>";
		}
	?>
</body>
</html>
