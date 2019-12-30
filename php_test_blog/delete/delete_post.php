<?php 
require_once '../common.php';
try {
  $pdo = connect();
  $st = $pdo->prepare("DELETE post, comment FROM post JOIN comment ON post.no = comment.post_no WHERE post.title=?");
  $st->execute(array($_GET['title']));
  header('Location: ../index.php');
} catch(PDOException $e) {
  header('Content-Type: text-plain; charset=UTF-8', true, 500);
}

?>

