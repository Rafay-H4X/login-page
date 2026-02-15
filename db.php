<?php
$servername = "localhost";
$username = "root";
$password = "gynh2399"; // Your specific password
$dbname = "daraz";      // Your specific database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>