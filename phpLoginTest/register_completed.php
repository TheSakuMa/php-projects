<?php
session_start();
$name = $_SESSION['user']['name'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>会員登録完了</title>
  </head>
  <body>
    <h1>会員登録完了</h1>
    <p><?php echo $name ?>さん、登録いただきありがとうございます。</p>
    <p><a href="dbinfo.php">登録情報一覧に戻る</a></p>
  </body>
</html>
