<?php 
require '../conf/common.php';
session_start();
if(isset($_SESSION['login'])) {
  $_SESSION['login'] = null;
}
$name = "";
$password = "";
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  $name = $_POST['name'];
  $password = $_POST['password'];
  try {
    $pdo = connect();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_name = ?");
    $stmt->execute([$name]);
    $row = $stmt->fetch();
    if($row['admin_flg'] === '1' && password_verify($password, $row['password'])) {
      // 認証が成功したとき
      // セッションIDの追跡を防ぐ
      session_regenerate_id(true);
      $_SESSION['name'] = $name;
      $_SESSION['admin_flg'] = $row['admin_flg'];
      // 管理者TOPに遷移
      header('Location: admin_index.php');
    } else {
      // header() で再度 admin_login.php に遷移させると
      // 変数初期化処理がされるので、エラーメッセージが表示されないので注意
      http_response_code(403);
    }
  } catch(PDOException $e) {
    header('Content-Type: text/plain; charset=utf-8', true, 500);
    exit($e->getMessage());
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>管理者ログイン</title>
    <link rel="stylesheet" href="../public/css/style.css">
  </head>
  <body>
    <header>
      <h1>管理者ログイン</h1>
    </header>
    <main>
      <?php if(http_response_code() === 403): ?>
        <p>ユーザーIDまたはパスワードが正しくありません。</p>
      <?php endif; ?>
      <form action="admin_login.php" method="post">
        <label>ユーザーID: <input type="text" name="name" size="40" required></label>
        <br>
        <label>パスワード: <input type="password" name="password" size="40" required></label>
        <br>
        <input type="submit" name="submit" value="ログイン">
      </form>
    </main>
  </body>
</html>