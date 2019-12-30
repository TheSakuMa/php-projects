<?php  
session_start();
// セッション変数のクリア
$_SESSION['login'] = "";
// セッションクリア
@session_destroy();
?>