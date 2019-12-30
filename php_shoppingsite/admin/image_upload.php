<?php  
require 'common.php';
$error = "";
if (@$_POST['submit']) {
  // フォームから画像を選択してアップロードしたときに、この部分が実行される
  // 隠しフィールドから商品コードを取得し、move_upload_file関数でimagesファルダにアップロードされた画像をコピーする
  $code = $_POST['code'];
  // move_uploaded_file 関数は、アップロードされたファイルを新しい位置に移動する関数
  // 第一引数にはアップロードしたファイルのファイル名を、第二引数にはファイルの移動先を指定する
  // $_FILES における ['tmp_name'] は、アップロードされたファイルがサーバ上で保存されているテンポラリファイルの名前
  if (move_uploaded_file($_FILES['pic']['tmp_name'], "../images/$code.jpg")) {
    $file = "../images/$code.jpg";
    // 加工前の画像の情報を取得
    list($width, $height, $type) = getimagesize($file);
    // 加工前のファイルをフォーマット別に読み出す
    switch ($type) {
      case IMAGETYPE_JPEG:
        $original_image = imagecreatefromjpeg($file);
        break;
      default:
        throw new RuntimeException('対応していないファイル形式です。', $type);
    }

    // 指定した大きさの黒い画像を表す画像IDを返す
    $canvas = imagecreatetruecolor(100, 100);

    // 画像のコピーと伸縮
    imagecopyresampled($canvas, $original_image, 0, 0, 0, 0, 100, 100, $width, $height);

    // コピーした画像を出力する
    imagejpeg($canvas, "../images/$code.jpg");
        
    // 不要になった画像を削除（メモリを解放）
    imagedestroy($original_image);
    imagedestroy($canvas);
    header('Location: index.php');
    exit();
  } else {
    $error .= 'ファイルを選択してください。<br>';
  } 
} else {
  // 一覧ページから「画像」リンクを押された時に実行される部分
  // GETパラメータに付加された商品コードを変数に入れている
  $code = $_GET['code'];
}
require 't_image_upload.php';
?>