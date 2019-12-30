<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>Noodle Shop</title>
    <link rel="stylesheet" href="shop.css">
  </head>
  <body>
    <h1>Noodle Shop</h1>
    <table>
    　<!-- index.php で用意された配列$goods（全商品のレコードが入った配列） に対してループ処理を行う-->
      <?php foreach ($goods as $g) { ?>
        <tr>
          <td><?php echo img_tag($g['code']) ?></td>
          <td>
            <p class="goods"><?php echo $g['name'] ?></p>
            <p><?php echo nl2br($g['comment']) ?></p>
          </td>
          <td width="80">
            <p><?php echo $g['price'] ?> 円</p>
            <form method="post" action="cart.php">
              <select name="num">
                <?php 
                  for ($i = 0; $i <= 9; $i++) {
                    echo "<option>$i</option>";
                  }
                ?>
              </select>
              <input type="hidden" name="code" value="<?php echo $g['code'] ?>">
              <input type="submit" name="submit" value="カートへ">
            </form>
          </td>
        </tr>
      <?php  } ?>
    </table>
  </body>
</html>