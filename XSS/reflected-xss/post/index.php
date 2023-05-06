<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = $_POST['nama'];
	$age = $_POST['age'];
	echo "<h1>Halo, $name!</h1>";
	echo "<p>Usiamu $age tahun ya?</p>";
}
?>