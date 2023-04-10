<?php
	// koneksi ke database
	$servername = "localhost";
	$username = "root";
	$password = "ikantongkol";
	$dbname = "tugasakhir";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	// proses input
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$nama = $_POST['nama'];
		$komentar = $_POST['komentar'];
		$sql = "INSERT INTO testing (nama, komentar) VALUES ('$nama', '$komentar')";
		if (mysqli_query($conn, $sql)) {
			echo "<h2>Terima kasih atas masukannya, $nama!</h2>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}

	mysqli_close($conn);
?>
