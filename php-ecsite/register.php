<?php  
require './conf/common.php';
session_start();
$error = $name = $hash = "";
try {
  $pdo = connect();
  $_SESSION['user'] = array();
  if(@$_POST['submit']) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
    if(!$error) {
      $stmt = $pdo->prepare("INSERT INTO users (user_name, email, password) VALUES (?,?,?)");
      $stmt->execute([$name, $email, $hash]);
      header('Location: login.php');
    }
  }
} catch (PDOException $e) {
  header('Content-Type: text/plain; charset=UTF-8', true, 500);
}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>会員登録</title>
    <link rel="stylesheet" href="./public/css/style.css">
  </head>
  <body>
    <header>
      <h1>会員登録</h1>
    </header>
    <main>
      <form action="" method="post">
        <label for="name">ユーザー名: </label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="email">メールアドレス: </label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">パスワード: </label>
        <input type="passsword" name="password" id="password" required>
        <br>
        <input type="submit" name="submit" value="登録">
      </form>
    </main>
  </body>
</html>