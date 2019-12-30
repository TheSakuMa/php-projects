<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Special Blog</title>
    <link rel="stylesheet" href="../blog.css">
  </head>
  <body>
    <h1>Special Blog</h1>
    <?php foreach($posts as $post) { ?>
      <div class="post">
        <h2><?php echo $post['title'] ?></h2>
        <!-- 記事本文は、複数行入る可能性があるため、nl2br関数で改行をbrタグに変換 -->
        <p><?php echo nl2br($post['content']) ?></p> 
        <?php foreach($post['comments'] as $comment) { ?>
          <div class="comment">
            <h3><?php echo $comment['name'] ?></h3>
            <p><?php echo nl2br($comment['content']) ?></p>
          </div>
        <?php } ?>
        <p class="comment_link">
          投稿日:<?php echo $post['time'] ?>
          <a href="../comment/comment.php?no=<?php echo $post['no'] ?>">コメント</a>
          <a href="../update/update_post.php?title=<?php echo $post['title'] ?>">修正</a>
          <a href="../delete/delete_post.php?title=<?php echo $post['title'] ?>" onclick="return confirm('削除してもよろしいですか？')">削除</a>
        </p>
      </div>
    <?php } ?>
  </body>
</html>