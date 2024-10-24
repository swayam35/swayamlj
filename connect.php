<?php
// MySQLi version of connecting to the database

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'car_rental';

// Create connection
$con = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Setting charset to UTF-8
if (!$con->set_charset("utf8")) {
    echo "Error loading character set utf8: " . $con->error;
}

// Your code for further operations goes here...

?>
