
<?php
session_start();
include 'config.php';
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $room_id = $_POST['room_id'];
    $ext = trim($_POST['ext']);

    if (empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($room_id)) {
        $response = ["status" => "error", "message" => " All fields are required!"];
        echo json_encode($response);
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response = ["status" => "error", "message" => " Invalid email format!"];
        echo json_encode($response);
        exit();
    }

    if ($password !== $confirm_password) {
        $response = ["status" => "error", "message" => "Password and confirmation do not match!"];
        echo json_encode($response);
        exit();
    }

   
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0) {
        $response = ["status" => "error", "message" => " Email is already in use!"];
        echo json_encode($response);
        exit();
    }

  
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, room_id, ext) VALUES (?, ?, ?, ?, ?)");

    try {
        $stmt->execute([$name, $email, $hashed_password, $room_id, $ext]);
        $response = ["status" => "success", "message" => " User added successfully!"];
    } catch (PDOException $e) {
        $response = ["status" => "error", "message" => " Error inserting data: " . $e->getMessage()];
    }

    echo json_encode($response);
}
?>
