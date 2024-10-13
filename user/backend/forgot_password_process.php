<?php
require_once('../../db.php');

$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("location:../frontend/forgot_password.php?error=email");
    exit();
}

$username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
$birthday = htmlspecialchars($_POST['birthday'], ENT_QUOTES, 'UTF-8');

$sql = "SELECT * FROM user WHERE email = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$email]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$row){
    header("location: ../frontend/forgot_password.php?error=email");
} else {
    if($username != $row['username']){
        header("location: ../frontend/forgot_password.php?error=username");
        exit();
    } else {
        if($birthday != $row['birthday']){
            header("location: ../frontend/forgot_password.php?error=birthday");
            exit();
        } else {
            session_start();
            $_SESSION['email'] = $email;
            header("location: ../frontend/reset_password.php");
            exit();
        }
    }
}