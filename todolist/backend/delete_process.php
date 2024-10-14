<?php

$id = $_GET['id'];
require_once('../../db.php');

$sql = "DELETE FROM list WHERE listid = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$id]);

header("location: ../../index.php");
exit();