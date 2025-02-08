<?php
include '../use_reg_api/api.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lexend+Giga:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styling/userlist-style.css"/>
    <script src="../script/script.js"></script>
</head>
<body>
    <h2>REGISTERED USERS</h2>
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
        <?php if (!empty($users)): ?>
            <?php foreach ($users as $row): ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo htmlspecialchars($row["name"]); ?></td>
                    <td><?php echo htmlspecialchars($row["email"]); ?></td>
                    <td><?php echo $row["age"]; ?></td>
                    <td><?php echo $row["birthMonth"] . '/' . $row["birthDate"] . '/' . $row["birthYear"]; ?></td>
                    <td><?php echo htmlspecialchars($row["address"]); ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $row['id']; ?>" style="background: rgba(53, 255, 188, 0.41);">Edit</a> |
                        <a href="#" onclick="deleteUser(<?php echo $row['id']; ?>)" style="background: rgba(255, 53, 53, 0.41);">Delete</a>
                        </td>
                </tr>
            <?php endforeach; ?>
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
