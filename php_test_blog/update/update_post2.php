<?php
$pdo = new PDO("mysql:dbname=blog", "root", "root");
$st = $pdo->prepare("UPDATE post SET title=?, content=? WHERE title=?");
$st->execute(array($_POST['title'], $_POST['content'], $_POST['old_title']));
header('Location: ../master/index_master.php');
?>