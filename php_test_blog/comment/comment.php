<?php 
$post_no =  $error = $name = $content = "";
if (@$_POST['submit']) {
  // strip_tags は文字列からHTML及びPHPタグを除去する関数である
  // コメントは不特定多数の一から書かれるものなので、セキュリティ対策をしなければならない
  $post_no = strip_tags($_POST['post_no']);
  $name = strip_tags($_POST['name']);
  $content = strip_tags($_POST['content']);
  if (!$name) $error .= "名前がありません。<br>";
  if (!content) $error .= "コメントがありません。<br>";
  if (!$error) {
    $pdo = new PDO("mysql:dbname=blog", "root", "root");
    $st = $pdo->prepare("INSERT INTO comment(post_no, name, content) VALUES (?,?,?)");
    $st->execute(array($post_no, $name, $content));
    header('Location: ../index.php');
    exit();
  }
} else { // コメントリンクに付与された親記事番号を受け取って $post_no に代入している
  $post_no = strip_tags($_GET['no']);
}
require 't_comment.php';
?>