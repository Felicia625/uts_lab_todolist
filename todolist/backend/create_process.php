<?php
session_start();
require_once('../../db.php');

$userid = $_SESSION['userid'];

$title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
$category = htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8');

if(empty($_POST['description'])){
    $description = NULL;
} else {
    $description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
}

if (empty($_POST['deadline'])){
    $deadline = NULL;
} else {
    $deadline = htmlspecialchars($_POST['deadline'], ENT_QUOTES, 'UTF-8');
}

$status = "Not Done";



$sql = "INSERT INTO list (title, category, description, deadline, userid, status) VALUES (?, ?, ?, ?, ?, ?)";
$result = $db->prepare($sql);
$result->execute([$title, $category, $description, $deadline, $userid, $status]);

header("location: ../../index.php");