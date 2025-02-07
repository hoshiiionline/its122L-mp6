<?php
include 'db.php';

// Set header for JSON response
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']); // Ensure ID is an integer
            $result = $conn->query("SELECT * FROM users WHERE id=$id");

            if ($result->num_rows > 0) {
                $data = $result->fetch_assoc();
                echo json_encode($data);
            } else {
                echo json_encode(["message" => "User not found"]);
            }
        } else {
            $result = $conn->query("SELECT * FROM users");
            $users = [];

            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }

            // Ensure valid JSON response
            if (!empty($users)) {
                echo json_encode($users);
            } else {
                echo json_encode(["message" => "No registered users found"]);
            }
        }
        break;

    case 'POST':
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['age']) && isset($_POST['birthMonth']) && isset($_POST['birthDate']) && isset($_POST['birthYear']) && isset($_POST['address'])) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $age = intval($_POST['age']);
            $birthMonth = intval($_POST['birthMonth']);
            $birthDate = intval($_POST['birthDate']);
            $birthYear = intval($_POST['birthYear']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);

            if (checkdate($birthMonth, $birthDate, $birthYear)) {
                $birthday = "$birthYear-$birthMonth-$birthDate";
            } else {
                echo json_encode(["message" => "Invalid date"]);
                exit;
            }

            $conn->query("INSERT INTO users (name, email, age, birthMonth, birthDate, birthYear, address) VALUES ('$name','$email', $age, '$birthMonth', '$birthDate', '$birthYear', '$address')");
            echo json_encode(["message" => "User added successfully"]);
        } else {
            echo json_encode(["message" => "Required parameters are missing"]);
        }
        break;

    case 'PUT':
        $input = json_decode(file_get_contents('php://input'), true);
        if (isset($input['id']) && isset($input['name']) && isset($input['email']) && isset($input['age']) && isset($input['birthMonth']) && isset($input['birthDate']) && isset($input['birthYear']) && isset($input['address'])) {
            $id = intval($input['id']);
            $name = mysqli_real_escape_string($conn, $input['name']);
            $email = mysqli_real_escape_string($conn, $input['email']);
            $age = intval($input['age']);
            $birthMonth = intval($input['birthMonth']);
            $birthDate = intval($input['birthDate']);
            $birthYear = intval($input['birthYear']);
            $address = mysqli_real_escape_string($conn, $input['address']);

            $conn->query("UPDATE users SET name='$name', email='$email', age=$age, birthMonth='$birthMonth', birthDate='$birthDate', birthYear='$birthYear', address='$address' WHERE id=$id");
            echo json_encode(["message" => "User updated successfully"]);
        } else {
            echo json_encode(["message" => "Required parameters are missing"]);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $conn->query("DELETE FROM users WHERE id=$id");
            echo json_encode(["message" => "User deleted successfully"]);
        } else {
            echo json_encode(["message" => "ID is required"]);
        }
        break;

    default:
        echo json_encode(["message" => "Invalid request method"]);
        break;
}

$conn->close();
?>
