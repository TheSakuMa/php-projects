<?php
$pdo = new PDO("mysql:dbname=blog", "root", "root");
// 記事一覧を取得するSQL文を発行している
$st = $pdo->query("SELECT * FROM post ORDER BY no DESC");
// 該当する全てのレコードを配列として返す
$posts = $st->fetchAll();
for ($i = 0; $i < count($posts); $i++) {
  // それぞれの記事に対するコメント一覧を取得するSQL文をループ文で発行
  $st = $pdo->query("SELECT * FROM comment WHERE post_no={$posts[$i]['no']} ORDER BY no DESC");
  // 記事配列$postに新しい要素 comment を作って、そこにコメント一覧を格納する
  $posts[$i]['comments'] = $st->fetchAll();
}
require 't_index_master.php';
?>