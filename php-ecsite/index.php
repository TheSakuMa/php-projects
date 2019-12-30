<?php
session_start();
require_once './conf/common.php';
try {
  $pdo = connect();
  $stmt = $pdo->query("SELECT * FROM items");
  $items = $stmt->fetchAll();
} catch(PDOException $e) {
  header('Content-Type: text/plain; charset=UTF-8', true, 500);
  exit($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>TOP | The SakuMa STORE</title>
    <link rel="stylesheet" href="./public/css/style.css">
  </head>
  <body>
    <header>
      <h1>The SakuMa STORE</h1>
    </header>
    <main>
      <div class="welcome">
        <?php if(isset($_SESSION['login'])) {?>
          <h3><?php echo $_SESSION['user']['name'] ?>さん、ようこそ！</h3>
        <?php  } else { ?>
          <a href="login.php">ログイン</a><br>
          <a href="register.php">新規会員登録</a>
        <?php  } ?>
      </div>
      <h2>商品一覧</h2>
      <table>
        <tr>
          <th>商品名</th><th>コメント</th><th>値段</th><th>個数</th>
        </tr>
        <?php foreach($items as $item) { ?>
          <tr>
            <td><?php echo h($item['item_name']) ?></td>
            <td><?php echo nl2br(h($item['comment'])) ?></td>
            <td><?php echo h($item['price']) ?></td>
            <td>
              <form action="cart.php" method="post">
                <select name="count">
                  <?php
                    for($i = 1; $i <= 10; $i++) {
                      echo "<option>$i</option>";
                    }
                  ?>
                </select>
                <br>
                <input type="hidden" name="id" value="<?php echo h($item['id']) ?>">
                <input type="submit" name="submit" class="submit" value="カートに入れる">
              </form>
            </td>
          </tr>
        <?php } ?>
      </table>
      <?php
        if(isset($_SESSION['login'])) {
          echo '<div>';
          echo '<a href="logout.php">ログアウト</a>';
          echo '</div>';
        }
      ?>
      <div>
        <a href="cart.php">カートを見る</a>
      </div>
    </main>
    <footer>
      <p>&copy; SakuMa STORE</p>
    </footer>
  </body>
</html>