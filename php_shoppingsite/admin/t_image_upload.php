<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>商品画像アップロード</title>
    <link rel="stylesheet" href="admin.css">
  </head>
  <body>
    <div class="base">
      <?php if($error) echo "<span class=\"error\">$error</span>" ?>
      <!-- 画像アップロードなので「enctype="multipart/form-data"」の属性が付加されている -->
      <!--  -->
      <form method="post" action="image_upload.php" enctype="multipart/form-data">
        <p>
          商品画像（JPEGのみ）<br>
          <!-- input要素のname属性の値が $_FILES 配列のキーになる -->
          <input type="file" name="pic">
        </p>
        <p>
          <input type="hidden" name="code" value="<?php echo $code ?>">
          <input type="submit" name="submit" value="追加">
        </p>
      </form>
    </div>
    <div class="base">
      <a href="index.php">一覧に戻る</a>
    </div>
  </body>
</html>