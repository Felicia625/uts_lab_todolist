<?php
session_start();
require_once('../../db.php');

$email = $_SESSION['email'];
$password = $_POST['password'];

$sql = "UPDATE user SET password = ? WHERE email = ?";
$result = $db->prepare($sql);
$result->execute([password_hash($password, PASSWORD_BCRYPT), $email]);

session_unset();
session_destroy();

header("location: ../frontend/login.php?success=renewpassword");
exit();