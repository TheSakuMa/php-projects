<?php 
// このファイルは、共通処理・関数を定義したもので全てのページから読み込まれる
session_start();
function connect() {
  return new PDO("mysql:dbname=shop", "root", "root");
}
// 商品画像を表示するタグの文字列を生成して返す
// file_exists 関数で画像の存在をチェックし、商品に対応する画像がない場合は noimage.jpg を表示するようにしている
function img_tag($code) {
  if (file_exists("images/$code.jpg")) $name = $code;
  else $name = 'noimage';
  return '<img src="images/' . $name . '.jpg" alt="">';
}
?>