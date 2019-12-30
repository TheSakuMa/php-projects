<?php
require_once './conf/common.php';
session_start();
$total = 0;
if(isset($_SESSION['login'])) {
  $items = $_SESSION['items'];
  $total = $_SESSION['total'];
} else {
  header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>商品購入確認｜The SakuMa STORE</title>
    <link rel="stylesheet" href="./public/css/style.css">
  </head>
  <body>
    <header>
      <h1>商品購入確認</h1>
    </header>
    <main>
      <h2>下記の内容で購入してもよろしいですか？</h2>
      <table>
        <tr>
          <th>商品名</th><th>単価</th><th>数量</th><th>小計</th>
        </tr>
        <?php foreach($items as $item) { ?>
          <tr>
            <td><?php echo h($item['item_name']) ?></td>
            <td><?php echo h($item['price']) ?></td>
            <td><?php echo h($item['count']) ?></td>
            <td>
              <?php echo h($item['price'] * $item['count']) ?>
            </td>
          </tr>
        <?php } ?>
        <tr>
          <td></td><td></td><td><strong>合計</strong></td><td><?php echo h($total) ?> 円</td>
        </tr>
      </table>
      <div class="buy-btn-wrapper">
        <form action="buyComplete.php" method="post">
          <input type="submit" name ="submit" value="購入" class="buy-btn">
        </form>
        <div>
          <button type="button" onclick="location.href='cart.php'" class="buy-btn">キャンセル</button>
        </div>
      </div>
    </main>
    <footer>
      <p>&copy; SakuMa STORE</p>
    </footer>
  </body>
</html>