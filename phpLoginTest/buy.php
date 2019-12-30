<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>商品購入ページ</title>
    <link rel="stylesheet" href="./css/list_style.css">
  </head>
  <body>
    <?php if(!isset($_SESSION['login'])) { ?>
      <div class="box">
        <h1>ログインしてください</h1>
        <p>ログインは、<a href="login.php">こちら</a></p>
      </div>
    <?php } ?>

    <?php if(isset($_SESSION['login'])) { ?>
      <table>
        <tr>
          <th>商品名</th>
          <th>価格</th>
        </tr>
        <tr>
          <td>商品A</td>
          <td>100円</td>
        </tr>
      </table>
    <?php } ?>
  </body>
</html>