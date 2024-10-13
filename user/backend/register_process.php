<?php
require_once('../../db.php');

$username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("location: ../frontend/register.php?error=invalidemail");
    exit();
}

$birthday = htmlspecialchars($_POST['birthday'], ENT_QUOTES, 'UTF-8');
$password = $_POST['password'];

$checksql = "SELECT * FROM user WHERE email = ?";
$result = $db->prepare($checksql);
$result->execute([$email]);

if($result->rowCount() > 0){
    header("location: ../frontend/register.php?error=emailtaken");
    exit();
} else {

    $sql = "INSERT INTO user (username, email, birthday, password) VALUES (?, ?, ?, ?)";

    $result = $db->prepare($sql);
    $result->execute([$username, $email, $birthday, password_hash($password, PASSWORD_BCRYPT)]);

    header('location: ../frontend/login.php?success=register');
    exit();
}