<?php
require 'common.php';
$pdo = connect();
$code = $_GET['code'];
$st = $pdo->prepare("DELETE FROM goods WHERE code=?");
$st->execute(array($code));
header('Location: index.php');
?>