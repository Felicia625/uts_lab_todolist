<?php
require_once('../../db.php');

$listid = $_GET['id'];

if($_POST['title'] != NULL){
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
    $sql = "UPDATE list SET title = ? WHERE list = ?";
    $result = $db->prepare($sql);
    $result->execute([$title, $listid]);
}

if($_POST['category'] != NULL){
    $category = filter_var($_POST['category'], FILTER_SANITIZE_EMAIL);
    $sql = "UPDATE list SET category =  ? WHERE listid = ?";
    $result = $db->prepare($sql);
    $result->execute([$category, $listid]);
}


if($_POST['deadline'] != NULL) {
    $deadline = htmlspecialchars($_POST['deadline'], ENT_QUOTES, 'UTF-8');
    $sql = "UPDATE list SET deadline = ? WHERE listid = ?";
    $result = $db->prepare($sql);
    $result->execute([$deadline, $listid]);
}

if($_POST['description'] != NULL) {
    $description = $_POST['description'];
    $sql = "UPDATE list SET description = ? WHERE listid = ?";
    $result = $db->prepare($sql);
    $result->execute([$description, $listid]);
}

header('location: ../frontend/view.php?id=' . $listid);
exit();

