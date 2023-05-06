<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
</head>
<body>
	<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// Proses login
		$username = $_POST['username'];
		$password = $_POST['password'];

		$connection = new MongoDB\Client("mongodb://localhost:27017");
		$database = $connection->myDatabase;
		$collection = $database->users;

		$user = $collection->findOne(['username' => $username]);

		if ($user) {
			if ($user['password'] == $password) {
				echo "<p>Login berhasil!</p>";
			} else {
				echo "<p>Login gagal. Password salah.</p>";
			}
		} else {
			echo "<p>Login gagal. Username tidak ditemukan.</p>";
		}
	}
	?>
	<form method="post">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username"><br><br>
		<label for="password">Password:</label>
		<input type="password" id="password" name="password"><br><br>
		<input type="submit" value="Login">
	</form>
</body>
</html>
