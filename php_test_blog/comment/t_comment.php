<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>コメント投稿｜Special Blog</title>
    <link rel="stylesheet" href="../blog.css">
  </head>
  <body>
    <form method="post" action="comment.php">
      <div class="post">
        <h2>コメント投稿</h2>
        <p>お名前</p>
        <p><input type="text" name="name" size="40" value="<?php echo $name ?>"></p>
        <p>コメント</p>
        <p><textarea name="content" rows="8" cols="40"><?php echo $content ?></textarea></p>
        <p>
          <!-- 記事一覧画面から「コメント」リンクを押された時に、comment.php によってGETパラメータに渡された親記事番号が入る -->
          <!-- さらに、エラーでフォームに戻ってきた場合も、POSTパラメータで渡された親記事番号が入る -->
          <input type="hidden" name="post_no" value="<?php echo $post_no ?>">
          <input type="submit" name="submit" value="投稿">
        </p>
        <p><?php echo $error ?></p>
      </div>
    </form>
  </body>
</html>