<?php 
require 'conf/common.php';
session_start();
$items = array();
$total = 0;
try {
  $pdo = connect();
  if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }
  // button タグはだめっぽい・・・
  // isset() 関数: 変数がセットされており、且つそれがNULLではないかをチェックする
  if(isset($_POST['submit'])) {
    $itemId = $_POST['id'];
    @$_SESSION['cart'][$itemId] += $_POST['count'];
  }
  foreach($_SESSION['cart'] as $id => $count) {
    $stmt = $pdo->prepare("SELECT * FROM items WHERE id = ?");
    $stmt->execute([$id]);
    $item = $stmt->fetch();
    $item['count'] = strip_tags($count);
    $total += $count * $item['price'];
    $items[] = $item;
  }
  // 購入確認画面表示及び購入処理のためにセッションに格納して管理
  $_SESSION['items'] = $items;
  $_SESSION['total'] = $total;
  //【表示上のポイント】配列のサイズは、count() メソッドかgetSize() メソッドで取得できる！
} catch(PDOException $e) {
  header('Content-Type: text/plain; charset: utf-8', true, 500);
}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>カート｜The SakuMa STORE</title>
    <link rel="stylesheet" href="./public/css/style.css">
  </head>
  <body>
    <header>
      <h1>The SakuMa STORE</h1>
    </header>
    <main>
    <h2>カート</h2>
    <?php if(count($items)) { ?>
      <form action="buyConfirm.php" method="post">
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
        <div id="buy-wrapper">
          <div id="btn-wrapper">
            <input type="submit" value="購入">
          </div>
        </div> 
      </form>
      <div>
        <div>
          <a href="cart_empty.php">カートを空にする</a>
          <a href="index.php">トップに戻る</a>
        </div>
      </div>
    <?php } else { ?>
      <div class="empty-cart">
        <p>カートが空です。</p>
      </div>
      <div>
        <a href="index.php">トップに戻る</a>
      </div>
    <?php } ?>
    </main>
    <footer>
      <p>&copy; SakuMa STORE</p>
    </footer>
  </body>
</html>