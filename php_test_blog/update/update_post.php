<?php
$title = htmlspecialchars($_GET['title'], ENT_QUOTES,'UTF-8');
$pdo = new PDO("mysql:dbname=blog", "root", "root");
$st = $pdo->prepare("SELECT * FROM post WHERE title=?");
$st->execute(array($title));
$row = $st->fetch();
$content = htmlspecialchars($row['content'], ENT_QUOTES,'UTF-8');
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>記事修正｜Special Blog</title>
    <link rel="stylesheet" href="../blog.css">
  </head>
  <body>
    <form method="post" action="update_post2.php">
      <div class="post">
        <h2>記事修正</h2>
        <p>題名</p>
        <p><input type="text" name="title" size="40" value="<?php echo $title ?>"></p>
        <p>本文</p>
        <p><textarea name="content" rows="8" cols="40"><?php echo $content ?></textarea></p>
        <p><input type="hidden" name="old_title" value="<?php echo $title ?>"></p>
        <p><input name="submit" type="submit" value="修正"></p>
      </div>
    </form>
  </body>
</html>