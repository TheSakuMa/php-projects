<?php 
require './conf/common.php';
session_start();
$error = '';
$name = '';
$password = '';
try {
  $pdo = connect();
  $_SESSION['user']['id'] = array();
  if(@$_POST['submit']) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_name=?");
    $stmt->execute([$name]);
    $user = $stmt->fetch();
    if(password_verify($_POST['password'], $user['password'])) {
      session_regenerate_id(true);
      $_SESSION['login'] = true;
      $_SESSION['user']['name'] = $name;
      $_SESSION['user']['id'] = $user['id'];
      if(count($_SESSION['cart']) > 0) {
        header('Location: cart.php');
      } else {
        header('Location: index.php');
      }
    } else {
      $loginError = true;
    }
  }
} catch (PDOException $e) {
  header('Content-Type: text/plain; charset=UTF-8', true, 500);
  exit($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>ログインページ</title>
  </head> 
  <body>
    <header>
      <h1>ログイン</h1>
    </header>
    <main>
      <?php if($loginError) echo '<p>ユーザー名かパスワードが間違っています</p>' ?>
      <form action="" method="post">
        <label for="name">ユーザー名: </label>
        <input type="text" name="name" id="name" required>
        <label for="password">パスワード</label>
        <input type="password" name="password" id="password" required>
        <input type="submit" name="submit" value="ログイン">
      </form>
    </main>
  </body> 
</html>