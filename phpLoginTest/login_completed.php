<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>ログイン完了</title>
  </head>
  <body>
    <h1>ログイン完了</h1>
    <p><?php echo $_SESSION['user']['name']."さん、こんにちは！" ?></p>
    <div>
      <a href="buy.php">商品購入ページはこちら</a>
      <a href="logout.php">ログアウト</a>
    </div>
  </body>
</html>