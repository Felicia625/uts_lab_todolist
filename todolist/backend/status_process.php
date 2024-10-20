<?php

$id = $_GET['id'];
$process = $_GET['status'];
require_once('../../db.php');

$sql = "SELECT * FROM list WHERE listid = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

date_default_timezone_set('Asia/Jakarta');

if($process == 'undone'){
    $status = 'Not Done';
} else {
    if(time() > strtotime($row['deadline']) && $row['deadline'] != NULL){
        $status = "Done Late";
    } else {
        $status = "Done";
    }
}

$sql = "UPDATE list SET status = ? WHERE listid = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$status, $id]);

header("location: ../frontend/view.php?id=".$id);
exit();