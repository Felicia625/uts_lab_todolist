<?php
define('DSN', 'mysql:host=localhost;dbname=todolist');
define('DBUSER', 'root');
define('DBPASS', '');

$db = new PDO(DSN, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);