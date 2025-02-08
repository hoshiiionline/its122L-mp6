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
</head>
<body>
    <h2>Editing User: <?php echo htmlspecialchars($user['name']);?></h2>

    <form id="editForm">
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

        <button type="submit">Update</button>
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
            .then(response => response.json())
            .then(data => {
                if (data.message === "User updated successfully") {
                    document.getElementById("notification").style.display = "block"; // Show success message
                    setTimeout(() => {
                        window.location.href = "userlist.php"; // Redirect after 2 seconds
                    }, 2000);
                } else {
                    alert("Error: " + data.message); // Show error message if any
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An error occurred while updating the user.");
            });
        });
    </script>

</body>
</html>
