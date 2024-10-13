<?php
session_start();
require_once('../../db.php');

$userid = $_SESSION['userid'];

if($_POST['username'] != NULL){
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $sql = "UPDATE user SET username =? WHERE userid =?";
    $result = $db->prepare($sql);
    $result->execute([$username, $userid]);
}

if($_POST['email'] != NULL){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location: ../frontend/user_profile.php?error=invalidemail");
        exit();
    }

    $checksql = "SELECT * FROM user WHERE email = ?";
    $result = $db->prepare($checksql);
    $result->execute([$email]);

    if($result->rowCount() > 0){
        header("location:../frontend/edit_profile.php?error=emailtaken");
        exit();
    } else {
        $sql = "UPDATE user SET email =? WHERE userid =?";
        $result = $db->prepare($sql);
        $result->execute([$email, $userid]);
    }
}


if($_POST['birthday'] != NULL) {
    $birthday = htmlspecialchars($_POST['birthday'], ENT_QUOTES, 'UTF-8');
    $sql = "UPDATE user SET birthday =? WHERE userid =?";
    $result = $db->prepare($sql);
    $result->execute([$birthday, $userid]);
}

if($_POST['password'] != NULL) {
    $password = $_POST['password'];
    $sql = "UPDATE user SET password =? WHERE userid =?";
    $result = $db->prepare($sql);
    $result->execute([password_hash($password, PASSWORD_BCRYPT), $userid]);
}

session_unset();
session_destroy();

$sql = "SELECT * FROM user WHERE userid = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$userid]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

session_start();

$_SESSION['userid'] = $row['userid'];
$_SESSION['username'] = $row['username'];
$_SESSION['email'] = $row['email'];
$_SESSION['birthday'] = $row['birthday'];
header('location: ../frontend/user_profile.php');
exit();

