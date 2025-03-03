
<header>
    <link rel="stylesheet" href="style.css">
</header>

<?php
session_start();
include_once 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']); 
    $password = trim($_POST['password']);

    $stored_email = "mariam@gmail.com";  
    $stored_password = "123456";  

    if ($email === $stored_email && $password === $stored_password) {
        $_SESSION['email'] = $email;
        header("Location: add_user.php"); 
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<div class="container">
    <h1>Cafeteria</h1>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

    <form action="login.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
         <br>

        <label for="password">Password:</label>
        <input type="password" name="password" required>
         <br>
        <button type="submit">Login</button>
    </form>
       <br>
    <a href="forgot_password.php">Forgot Password?</a>
</div>

<?php include_once 'footer.php'; ?>
