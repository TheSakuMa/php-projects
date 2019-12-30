<?php
/* for($count = 0; $count < 10; $count++) {
  $arr = ['cart' => ['id' => $count]];
  echo $arr['cart']['id'];
} */

$count = 1;

function session($count) {
  $arr = ['cart' => ['id' => $count]];
  echo $arr['cart']['id'];
  return $arr['cart']['id'] += $count;
}
session(1);
session(2);
session(3);
session(5);
?>