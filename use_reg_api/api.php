<?php
include 'db.php';

// this condition is to check if api.php is being run directly. however, if run through other files such as register.php, this condition will be false
// this is for POSTMAN usage, while not displaying on the actual site.
if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
    header("Content-Type: application/json");
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $result = $conn->query("SELECT * FROM users WHERE id=$id");
            $data = $result->fetch_assoc();
            echo json_encode($data);
        } else {
            $result = $conn->query("SELECT * FROM users");
            $users = [];
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            echo "<pre style='color: white;'>" . json_encode($users) . "</pre>";
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
                echo "<pre style='color: white;'>" . json_encode(["message" => "Invalid date"]) . "</pre>";
            }
            
            $conn->query("INSERT INTO users (name, email, age, birthday, address) VALUES ('$name','$email', $age, '$birthday', '$address')");
            echo "<pre style='color: white;'>" . json_encode(["message" => "User added successfully"]) . "</pre>";
        } else {
            echo json_encode(["message" => "Required parameters are missing"]);
        }
        break;

    case 'PUT':
        $input = json_decode(file_get_contents('php://input'), true);
        if (isset($input['id']) && isset($input['name']) && isset($input['email']) && isset($input['age']) && isset($input['birthday']) && isset($input['address'])) {
            $id = $input['id'];
            $name = mysqli_real_escape_string($conn, $input['name']);
            $email = mysqli_real_escape_string($conn, $input['email']);
            $age = mysqli_real_escape_string($conn, $input['age']);
            $birthday = mysqli_real_escape_string($conn, $input['birthday']);
            $address = mysqli_real_escape_string($conn, $input['address']);
            
            $conn->query("UPDATE users SET name='$name', email='$email', age=$age, birthday='$birthday', address='$address' WHERE id=$id");
            echo "<pre style='color: white;'>" . json_encode(["message" => "User updated successfully"]) . "</pre>";
        } else {
            echo "<pre style='color: white;'>" . json_encode(["message" => "Required parameters are missing"]) . "</pre>";
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $conn->query("DELETE FROM users WHERE id=$id");
            echo "<pre style='color: white;'>" . json_encode(["message" => "User deleted successfully"]) . "</pre>";
        } else {
            echo "<pre style='color: white;'>" . json_encode(["message" => "ID is required"]) . "</pre>";
        }
        break;

    default:
        echo "<pre style='color: white;'>" . json_encode(["message" => "Invalid request method"]) . "</pre>";
        break;
}

$conn->close();
?>