<?php  
require_once 'conf/common.php';
session_start();
if($_SESSION['login']) {
  try {
    $pdo = connect();
    $stmt = $pdo->prepare("SELECT items.id, items.item_name, items.price, it.total_count FROM item_transactions it INNER JOIN items ON it.item_id = items.id WHERE user_id = ? ORDER BY it.insert_date DESC");
    $stmt->execute([$_SESSION['user']['id']]);
    $rows = $stmt->fetchAll();
  } catch (PDOException $e) {
    header('Content-Type: index.php; charset=UTF-8', true, 500);
    exit($e->getMessage());
  }
} else {
  header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>マイページ｜The SakuMa STORE</title>
    <link rel="stylesheet" href="./public/css/style.css">
  </head>
  <body>
    <header>
      <h1>The SakuMa STORE</h1>
    </header>
    <main>
      <h2>マイページ</h2>
      <div class="buy-history">
        <h3>購入履歴</h3>
        <?php if(count($rows) > 0) { ?>
          <table>
            <tr>
              <th>商品ID</th><th>商品名</th><th>値段</th><th>個数</th><th>小計</th>
            </tr>
            <?php foreach($rows as $row) { ?>
              <tr>
                <td><?php echo h($row['id']) ?></td>
                <td><?php echo h($row['item_name']) ?></td>
                <td><?php echo h($row['price']) ?></td>
                <td><?php echo h($row['total_count']) ?></td>
                <td><?php echo h($row['price']) * h($row['total_count']) ?></td>
              </tr>
            <?php } ?>
          </table>
        <?php } else { ?>
          <p>購入履歴はありません。</p>
        <?php } ?>
      </div>
    </main>
  </body>
</html>