<?php  
require 'common.php';
$rows = array();
$sum = 0;
$pdo = connect();
// カート用のセッション変数を用意している
// $_SESSION['cart']要素に配列として、キーが商品コード、値が数量のカート情報が入る
// isset は変数がセットされていること、そして NULL でないことを検査する
if(!isset($_SESSION['cart'])) $_SESSION['cart'] = array();
if (@$_POST['submit']) {
  // $_SESSION['cart][商品コード]に、その商品の数量を入れている
  // += を使っているので、既に商品の数量が入っていれば、それに足される
  @$_SESSION['cart'][$_POST['code']] += $_POST['num'];
}
foreach($_SESSION['cart'] as $code => $num) {
  $st = $pdo->prepare("SELECT * FROM goods WHERE code=?");
  $st->execute(array($code));
  $row = $st->fetch();
  // 再びSQL文を発行できるように、closeCursor文でサーバへの接続を解放する
  $st->closeCursor();
  $row['num'] = strip_tags($num);
  // 商品の価格と数量をかけたものを合計に加えている
  $sum += $num * $row['price'];
  // 商品データの入った配列を$rows配列に追加している
  $rows[] = $row;
}
require 't_cart.php';
?>