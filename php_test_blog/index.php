<?php
$pdo = new PDO("mysql:dbname=blog", "root", "root");
// 記事一覧を取得するSQL文を発行している
// ORDER BY no DESC により、並びをno カラムの降順（新しいものが上）に指定
$st = $pdo->query("SELECT * FROM post ORDER BY no DESC");
// 該当する全てのレコードを配列として返す
$posts = $st->fetchAll();
for ($i = 0; $i < count($posts); $i++) {
  // それぞれの記事に対するコメント一覧を取得するSQL文をループ文で発行
  $postNo = $posts[$i]['no'];
  $st = $pdo->prepare("SELECT * FROM comment WHERE post_no=? ORDER BY no DESC");
  $st->execute([$postNo]);
  // 記事配列$postに新しい要素 comment を作って、そこにコメント一覧を格納する
  $posts[$i]['comments'] = $st->fetchAll();
}
require 't_index.php';
?>