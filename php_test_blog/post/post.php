<?php
require_once '../common.php';
// 変数の初期化
$error = $title = $content = "";
if(@$_POST['submit']) { // 投稿ボタンが押されたかをチェックしている
  $title = $_POST['title'];
  $content = $_POST['content'];
  // .= (ドットイコール)は、文字列演算子の1つで、結合代入演算子という
  // 結合代入演算子は、右側の引数に左側の引数を追加する
  if (!$title) $error .= 'タイトルがありません。<br>';
  if (mb_strlen($title) > 80) $error .= 'タイトルが長すぎます。<br>';
  if (!$content) $error .= '本文がありません。<br>';
  if (!$error) { // 今回は管理者のみが記事投稿をできるという前提なので、セキュリティを考慮していないことに注意
    $pdo = connect();
    $st = $pdo->query("INSERT INTO post(title, content) VALUES('$title', '$content')");
    // 記事の書き込みに成功したら index.php に遷移する
    // header 関数はクライアントにデータを送る際のHTTPヘッダーを設定するもの
    // HTTPの機能として 'Location: [URL]' と書くと、ブラウザがヘッダを判断して指定されたURLに遷移する 
    header('Location: ../index.php');
    exit();
  }
}
require 't_post.php';
// 通常、記事投稿プログラムは他の人がアクセスできない場所に置く必要がある。パスワードを掛けるのが一般的である
?>