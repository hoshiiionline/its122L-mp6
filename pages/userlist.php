<?php
include '../use_reg_api/db.php';

// Fetch users from the database
$sql = "SELECT id, name, email, age, birthMonth, birthDate, birthYear, address FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users</title>
    <link rel="stylesheet" href="../styling/register-style.css"/>
</head>
<body>
    <h2>Registered Users</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Birth Date</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo htmlspecialchars($row["name"]); ?></td>
                    <td><?php echo htmlspecialchars($row["email"]); ?></td>
                    <td><?php echo $row["age"]; ?></td>
                    <td><?php echo $row["birthMonth"] . '/' . $row["birthDate"] . '/' . $row["birthYear"]; ?></td>
                    <td><?php echo htmlspecialchars($row["address"]); ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $row['id']; ?>">Edit</a> |
                        <a href="delete_user.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No registered users found.</td>
            </tr>
        <?php endif; ?>
    </table>

    <br>
    <a href="register.php">Go Back to Registration</a>
</body>
</html>

<?php
$conn->close();
?>  
