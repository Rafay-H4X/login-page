<?php
session_start();
include("db.php");

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
    <style>
        body { font-family: 'Montserrat', sans-serif; text-align: center; padding: 50px; }
        a { text-decoration: none; color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
   <p>Your email is: <?php echo $_SESSION['email']; ?></p>
    <br>
    <br><br>
    <a href="logout.php">Logout</a>
</body>
</html>