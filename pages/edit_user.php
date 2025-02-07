<?php
include '../use_reg_api/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch user data
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $age = $_POST["age"];
    $birthYear = $_POST["birthYear"];
    $birthMonth = $_POST["birthMonth"];
    $birthDate = $_POST["birthDate"];
    $address = $_POST["address"];

    $update_sql = "UPDATE users SET name=?, email=?, age=?, birthYear=?, birthMonth=?, birthDate=?, address=? WHERE id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssiiissi", $name, $email, $age, $birthYear, $birthMonth, $birthDate, $address, $id);

    if ($stmt->execute()) {
        echo "User updated successfully.";
    } else {
        echo "Error updating user: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the user list
    header("Location: userlist.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lexend+Giga:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styling/edit-style.css"/>
</head>
<body>
    <h2>Editing User: <?php echo htmlspecialchars($user['name']);?></h2>
    <form action="edit_user.php?id=<?php echo $id; ?>" method="POST">
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

        <input type="submit" value="Update">
    </form>

    <br>
    <a href="userlist.php">Back to User List</a>
</body>
</html>
