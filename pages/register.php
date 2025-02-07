<?php 
ob_start();
require '../use_reg_api/api.php';
ob_end_clean();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../styling/register-style.css"/>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lexend+Giga:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    
    <div class="intro-text">
        <div class="overlap-2">
            <div class="text-wrapper-9">REST.</div>
            <div class="text-wrapper-10">IT’S TIME TO</div>
            <p class="flavor-text">
                <span class="span">
                    Thanks for dropping by! We’re still testing out functionalities<br/>for our new webpage.
                    <br/><br/>Have some shut-eye while you wait or visit
                </span>
                <span class="text-wrapper-11">rest.fb.com</span>
                <span class="span"> for our current selection of mattresses.</span>
            </p>
        </div>
    </div>

    <div class="text-wrapper-12">Register Below:</div>
    <div class="form-container">
        
        <form action="register.php" method="POST" class="form">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div>
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" required>
            </div>

            <div>
                <label for="birthYear">Birth Year:</label>
                <input type="number" id="birthYear" name="birthYear" required>
            </div>

            <div>
                <label for="birthMonth">Birth Month:</label>
                <input type="number" id="birthMonth" name="birthMonth" required>
            </div>

            <div>
                <label for="birthDay">Birth Day:</label>
                <input type="number" id="birthDate" name="birthDate" required>
            </div>

            <div>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>

            <div>
                <input type="submit" value="Register">
            </div>
        </form>

        <div class="user-list-link">
            <a href="userlist.php">View Registered Users</a>
        </div>
    </div>

</body>
</html>
