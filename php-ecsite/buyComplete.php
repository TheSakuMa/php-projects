<?php
require_once 'conf/common.php';
session_start();
$items = $_SESSION['items'];
if(isset($_SESSION['login']) && isset($_POST['submit']) && count($items) > 0) {
  try {
    $pdo = connect();
    // 在庫確認のため items テーブルから stock を取得
    $stmt1 = $pdo->prepare("SELECT stock FROM items WHERE id = ?");
    // 取引を記録するテーブルにINSERTする
    $stmt2 = $pdo->prepare("INSERT INTO item_transactions (item_id, user_id, total_count, insert_date) VALUES (?,?,?,?)");
    // INSERT の際に、該当商品の在庫を減らす
    $stmt3 = $pdo->prepare("UPDATE items SET stock = (stock - ?) WHERE id = ?");
    
    foreach($items as $item) {
      $stmt1->execute([$item['id']]);
      $row = $stmt1->fetch();
      if($row['stock'] >= $item['count']) {
        $datetime = date("Y-m-d H:i:s");
        $res1 = $stmt2->execute([$item['id'], $_SESSION['user']['id'], $item['count'], $datetime]);
        if(!$res1) {
          header('Location: buyConfirm.php');
          exit('購入に失敗しました。再度試みても失敗するようでしたら、お手数ではございますが、管理者にご連絡ください。');
          break;
        }
        $res2 = $stmt3->execute([$item['count'], $item['id']]);
        if(!$res2) {
          header('Location: buyConfirm.php');
          exit('購入に失敗しました。再度試みても失敗するようでしたら、お手数ではございますが、管理者にご連絡ください。');
          break;
        }
      } else {
        exit('在庫が不足している商品があります。お手数ではございますが、一旦カートを空にしてください。');
        break;
      }
    }
    $_SESSION['cart'] = null;
    $_SESSION['items'] = null;
    $_SESSION['total'] = null;
  } catch(PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
  }
} else {
  header('Location: index.php');
}
?>
<html lang="ja">
  <head>
    <mata charset="utf-8">
    <title>購入完了｜The SakuMa STORE</title>
    <link rel="stylesheet" href="./public/css/style.css">
  </head>
  <body>
    <header>
      <h1>The SakuMa STORE</h1>
    </header>
    <main>
      <h2>購入完了</h2>
      <p>ご購入いただきまして、誠にありがとうございます。</p>
      <div>
        <a href="index.php">トップに戻る</a>
      </div>
    </main>
    <footer>
      <p>&copy; SakuMa STORE</p>
    </footer>
  </body>
</html>