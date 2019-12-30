<?php  
require 'common.php';
$error = "";
$pdo = connect();
if (@$_POST['submit']) { // フォームから商品を修正して「更新」ボタンを押したときの処理
  $code = $_POST['code'];
  $name = $_POST['name'];
  $comment = $_POST['comment'];
  $price = $_POST['price'];
  if (!$name) $error .= '商品名がありません。<br>';
  if (!$comment) $error .= '商品説明がありません。<br>';
  if (!$price) $error .= '価格がありません。<br>';
  if (preg_match('/\D/', $price)) $error .= '価格が不正です。<br>';
  if (!$error) {
    // つまずいたポイント。文字列として挿入する必要があるものは、クォーテーションを忘れずに。
    $st = $pdo->prepare("UPDATE goods SET name='$name', comment='$comment', price=$price WHERE code=?");
    $st->execute(array($code));
    header('Location: index.php');
    exit();
  }
} else {
  // 一覧ページから「修正」リンクが押されたときは、GETパラメータに商品コードが付加されているので、
  // それを基に商品データを変数に格納し、フォームに表示する
  $code = $_GET['code'];
  $st = $pdo->query("SELECT * FROM goods WHERE code=$code");
  $row = $st->fetch();
  $name = $row['name'];
  $comment = $row['comment'];
  $price = $row['price'];
}
require 't_edit.php';
?>