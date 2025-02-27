<?php
include 'db.php';

// Set header for JSON response
// this condition is to check if api.php is being run directly. however, if run through other files such as register.php, this condition will be false
// this is for POSTMAN usage, while not displaying on the actual site.
if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
    header("Content-Type: application/json");
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']); // Ensure ID is an integer
            $result = $conn->query("SELECT * FROM users WHERE id=$id");

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                //echo json_encode($user);
            } else {
                //echo json_encode(["message" => "User not found"]);
            }
        } else {
            $result = $conn->query("SELECT * FROM users");
            $users = [];

            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }

            // Ensure valid JSON response
            if (!empty($users)) {
                //echo json_encode($users);
            } else {
                //echo json_encode(["message" => "No registered users found"]);
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
            // Get the raw JSON input and decode it
            $input = json_decode(file_get_contents('php://input'), true);
        
            if (isset($input['id']) && isset($input['name']) && isset($input['email']) && isset($input['age']) 
                && isset($input['birthMonth']) && isset($input['birthDate']) && isset($input['birthYear']) 
                && isset($input['address'])) {
        
                $id = intval($input['id']);
                $name = mysqli_real_escape_string($conn, $input['name']);
                $email = mysqli_real_escape_string($conn, $input['email']);
                $age = intval($input['age']);
                $birthMonth = intval($input['birthMonth']);
                $birthDate = intval($input['birthDate']);
                $birthYear = intval($input['birthYear']);
                $address = mysqli_real_escape_string($conn, $input['address']);
        
                // Prepare an SQL statement to prevent SQL injection
                $sql = "UPDATE users SET name=?, email=?, age=?, birthMonth=?, birthDate=?, birthYear=?, address=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiiissi", $name, $email, $age, $birthMonth, $birthDate, $birthYear, $address, $id);
        
                if ($stmt->execute()) {
                    echo json_encode(["message" => "User updated successfully"]);
                } else {
                    echo json_encode(["message" => "Error updating user: " . $stmt->error]);
                }
        
                $stmt->close();
            } else {
                echo json_encode(["message" => "Required parameters are missing"]);
            }
            break;        

        case 'DELETE':
            parse_str(file_get_contents("php://input"), $_DELETE); 
            if (isset($_DELETE['id'])) {
                $id = intval($_DELETE['id']);
        
                $sql = "DELETE FROM users WHERE id=?";
                $stmt = $conn->prepare($sql);
        
                if ($stmt) {
                    $stmt->bind_param("i", $id);
                    if ($stmt->execute()) {
                        echo json_encode(["message" => "User deleted successfully"]);
                    } else {
                        echo json_encode(["message" => "Error deleting user: " . $stmt->error]);
                    }
                    $stmt->close();
                } else {
                    echo json_encode(["message" => "Failed to prepare statement"]);
                }
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
