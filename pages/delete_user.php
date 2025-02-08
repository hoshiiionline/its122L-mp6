<?php
include '../use_reg_api/db.php';
include '../use_reg_api/api.php';

/*if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}*/

header(header: 'Refresh: 0; URL = pages/register.php');
exit();
?>
