<?php
session_start();
include 'config.php';
include 'datebase.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $room_id = $_POST['room_id'];
    $ext = trim($_POST['ext']);

 
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($room_id)) {
        header("Location: add_user.php?error=" . urlencode("All fields are required!"));
        exit();
    }


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: add_user.php?error=" . urlencode("Invalid email format!"));
        exit();
    }

    
    if ($password !== $confirm_password) {
        header("Location: add_user.php?error=" . urlencode("Password and confirmation do not match!"));
        exit();
    }

  
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0) {
        header("Location: add_user.php?error=" . urlencode("Email is already in use!"));
        exit();
    }

 
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, room_id, ext) VALUES (?, ?, ?, ?, ?)");

    try {
        $stmt->execute([$name, $email, $hashed_password, $room_id, $ext]);
        header("Location: add_user.php?success=" . urlencode("User added successfully!"));
    } catch (PDOException $e) {
        header("Location: add_user.php?error=" . urlencode("Error inserting data: " . $e->getMessage()));
    }

    exit();
}

