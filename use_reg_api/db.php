<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usersdb";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, null, '/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock');
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Test
</body>
</html>