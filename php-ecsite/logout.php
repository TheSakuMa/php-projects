<?php  
require './conf/common.php';
session_start();
$_SESSION['login'] = null;
@session_destroy();
header('Location: index.php');
?>