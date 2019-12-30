<?php  
require '../conf/common.php';
session_start();
$rows = "";
$_SESSION['admin'] = true;
if($_SESSION['login'] && $_SESSION['admin']) {
  try {
    $pdo = connect();
    $stmt = $pdo->prepare("SELECT * FROM items");
    $stmt->execute();
    $rows = $stmt->fetchAll();
  } catch (PDOException $e) {
    header('Content-Type: text/plain; charset="UTF-8', true, 500);
  }
} else {
  header('Location: ../index.php');
  exit($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>商品一覧｜The SakuMa STORE 管理者用ページ</title>
    <link rel="stylesheet" href="../public/css/style.css">
  </head>
  <body>
    <header>
      <h1>The SakuMa STORE 管理者用ページ</h1>
    </header>
    <main>
      <h2>商品一覧</h2>
      <table>
        <tr>
          <th>商品ID</th><th>商品名</th><th>コメント</th><th>値段</th><th>在庫</th>
        </tr>
        <?php foreach($rows as $row) { ?>
          <tr>
            <td><?php echo h($row['id']) ?></td>
            <td><?php echo h($row['item_name']) ?></td>
            <td><?php echo h($row['comment']) ?></td>
            <td><?php echo h($row['price']) ?></td>
            <td><?php echo h($row['stock']) ?></td>
          </tr>
        <?php } ?>
      </table>
    </main>
  </body>
</html>