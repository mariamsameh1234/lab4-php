<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL); 
include_once 'business_logic.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    delete_user($pdo, $userId); 

  
    header("Location: display_users.php");
    exit;
}
?>



