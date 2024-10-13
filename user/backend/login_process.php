<?php
session_start();
require_once('../../db.php');

$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("location: ../frontend/login.php?error=email");
    exit();
}

$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE email = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$email]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$row){
    header("location: ../frontend/login.php?error=email");
    exit();
}else{
    if(!password_verify($password, $row['password'])){
        header("location: ../frontend/login.php?error=password");
        exit();
    }else{
        $_SESSION['userid'] = $row['userid'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['birthday'] = $row['birthday'];
        header('location: ../../index.php');
        exit();
    }
}