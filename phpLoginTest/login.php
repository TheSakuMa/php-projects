<?php
require_once './conf/dbconf.php';
$error = $name = $hash = "";
try {
  $pdo = connect();
  $_SESSION['user']['name'] = array();
  if (@$_POST['submit']) {
    $name = htmlspecialchars($_POST['name']);
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_name=?");
    $stmt->execute([$name]);
    $user = $stmt->fetch();
    if(password_verify($_POST['password'], $user['hash'])) {
      // session_regenerate_id(true) は、セッション固定攻撃対策として利用されるっぽい
      // 不安定なネットワークなどではsessionが失われる可能性がある
      session_regenerate_id(true);
      $_SESSION['login'] = true;
      $_SESSION['user']['name'] = $name;
      header('Location: login_completed.php');
    } else {
      $loginError = true;
    }
  }
} catch (PDOException $e) {
  header('Content-Type: text/plain', true, 500);
  exit($e->getMessage());
}

require 't_login.php';
?>
