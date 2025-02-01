<?php 

require '../use_reg_api/api.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <form action="register.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required><br><br>

        <label for="birthYear">Birth Year:</label>
        <input type="number" id="birthYear" name="birthYear" required><br><br>

        <label for="birthMonth">Birth Month:</label>
        <input type="number" id="birthMonth" name="birthMonth" required><br><br>

        <label for="birthDay">Birth Day:</label>
        <input type="number" id="birthDate" name="birthDate" required><br><br>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>