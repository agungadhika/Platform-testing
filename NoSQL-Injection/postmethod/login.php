<?php
// connect to mongodb
$manager = new MongoDB\Driver\Manager("mongodb://admin:admin123@localhost:27017");

// select database and collection
$db = "mydb";
$collection = "users";

// retrieve username and password from POST request
$username = $_POST["username"];
$password = $_POST["password"];

// create filter to find user with matching username and password
$filter = [
    "username" => $username,
    "password" => $password
];

// execute find command
$query = new MongoDB\Driver\Query($filter);
$cursor = $manager->executeQuery("$db.$collection", $query);

// check if user is found
if ($cursor->isDead()) {
    echo "Login failed";
} else {
    echo "Login successful";
}
?>
