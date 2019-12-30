<?php  
session_start();
$_SESSION['cart'] = null;
$_SESSION['items'] = null;
$_SESSION['total'] = null; 
header('Location: cart.php');
?>