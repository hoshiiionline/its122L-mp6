<?php
include '../use_reg_api/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM users WHERE id=$id");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        die("User not found");
    }
} else {
    die("Invalid user ID");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="../styling/edit-style.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lexend+Giga:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <h2>Editing User: <?php echo htmlspecialchars($user['name']);?></h2>

    <form action="userlist.php" target="_blank" id="editForm" on>
    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>

    <label for="age">Age:</label>
    <input type="number" name="age" value="<?php echo $user['age']; ?>" required><br>

    <label for="birthYear">Birth Year:</label>
    <input type="number" name="birthYear" value="<?php echo $user['birthYear']; ?>" required><br>

    <label for="birthMonth">Birth Month:</label>
    <input type="number" name="birthMonth" value="<?php echo $user['birthMonth']; ?>" required><br>

    <label for="birthDate">Birth Date:</label>
    <input type="number" name="birthDate" value="<?php echo $user['birthDate']; ?>" required><br>

    <label for="address">Address:</label>
    <input type="text" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required><br>

    <input type="submit"></input>
</form>

<div id="notification" style="display: none; color: green; font-weight: bold; margin-top: 10px;">
    Update successful! Redirecting...
</div>

<br>
<a href="userlist.php">Back to User List</a>

<script>
document.getElementById("editForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent normal form submission
    
    let formData = new FormData(this);
    let jsonData = {};
    formData.forEach((value, key) => { jsonData[key] = value; });

    fetch("../use_reg_api/api.php", {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(jsonData)
    })
    .then(response => response.json().catch(() => null)) 
    .then(data => {
        if (data && data.message === "User updated successfully") {
            document.getElementById("notification").style.display = "block";
            setTimeout(() => {
                window.location.href = "userlist.php"; 
            }, 2000);
        } else if (data && data.message) {
            alert("Error: " + data.message); 
        }
    })
    .catch(error => {
        console.error("Silent Error:", error); 
    });
    window.location = 'userlist.php';

});

</script>


</body>
</html>
