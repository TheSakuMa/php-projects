<?php 
require_once './conf/dbconf.php';
try {
  $pdo = connect();
  // ユーザ入力を伴わないクエリに関しては単にPDO::queryメソッドを実行すれば良い
  // 返り値は PDOStatement となる
  $stmt = $pdo->query("SELECT * FROM users");
  // 結果を全件取得し、2次元配列にする
  $rows = $stmt->fetchAll();
} catch (PDOException $e) {
  // エラーが発生した場合は「500 Internal Server Error」でテキストとして表示して終了する
  // もし手抜きしたくない場合はHTMLの表示を継続する
  // ここではエラー内容を表示しているが、実際の商用環境ではログファイルに記録して、Webブラウザには出さないほうが望ましい
  header('Content-Type: text/plain; charset=UTF-8', true, 500);
  exit($e->getMessage());
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ユーザデータ一覧</title>
    <link rel="stylesheet" href="css/list_style.css">
  </head>
  <body>
    <table>
      <tr>
        <th>ユーザID</th><th>ユーザ名</th><th>パスワード</th>
      </tr>
      <?php foreach($rows as $row) { ?>
        <tr>
          <td><?php echo $row['user_id'] ?></td>
          <td><?php echo $row['user_name'] ?></td>
          <td><?php echo $row['hash'] ?></td>
        </tr>
      <?php } ?>
    </table>
  </body>
</html>