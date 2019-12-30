<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ログイン画面</title>
  </head>
  <body>
    <?php if($loginError) echo "<p>ユーザ名かパスワードが間違っています。</p>" ?>
    <form method="post" action="login.php">
      <label for="name">名前: </label>
      <input type="text" name="name" id="name" required>
      <br>
      <label for="password">パスワード: </label>
      <input type="password" name="password" id="password" required>
      <br>
      <input type="submit" name="submit" value="ログイン">
    </form>
  </body>
</html>