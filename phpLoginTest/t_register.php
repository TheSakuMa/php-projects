<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>新規会員登録</title>
  </head>
  <body>
    <?php if ($error) echo "<span>$error</span>" ?>
    <form method="post" action="register.php">
      <label for="name">ユーザ名: </label>
      <input type="text" name="name" id="name" size="32" required>
      <br>
      <label for="password">パスワード: </label>
      <input type="password" name="password" id="password" size="32" required>
      <br>
      <!-- name属性を忘れずに！ -->
      <input type="submit" name="submit" value="登録">
    </form>
  </body>
</html>