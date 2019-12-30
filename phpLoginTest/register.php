<?php
require_once './conf/dbconf.php';

$error = $name = $hash = "";
try {
  $pdo = connect();
  $_SESSION['user'] = array();
  if(@$_POST['submit']) {
    $name = htmlspecialchars($_POST['name']);
    $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
    if (!$error) {
      $stmt = $pdo->prepare("INSERT INTO users(user_name, hash) VALUES(?,?)");
      $stmt->execute([$name, $hash]);
      $_SESSION['user']['name'] = $name;
      header('Location: register_completed.php');
    }
  }
} catch (PDOException $e) {
  header('Content-Type: text/plain; charset: UTF-8', true, 500);
  exit($e->getMessage());
}

require 't_register.php';
?>