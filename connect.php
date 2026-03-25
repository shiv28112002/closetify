<!-- // connect.php -->
<?php
$host = 'localhost';
$db   = 'users';
$user = 'root';    // change to your MySQL username
$pass = '';    // change to your MySQL password


$mysqli = new mysqli('localhost', 'root', '', 'users', 3307);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>

