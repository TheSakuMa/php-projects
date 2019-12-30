<?php  
function connect(){
  return new PDO(
    'mysql:dbname=shop;host=localhost;charset=utf8mb4',
    'root',
    'root',
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH,
    ]
  );
}

date_default_timezone_set('Asia/Tokyo');

function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>