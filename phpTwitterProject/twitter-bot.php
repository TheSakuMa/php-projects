<?php
// OAuthスクリプトの読み込み
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;
require_once 'config.php';

// Consumer key
$consumer_key = API_KEY;
// Consumer secret
$consumer_secret = API_SECRET;
// Access token
$access_token = ACCESS_TOKEN;
// Access token secret
$access_token_secret = ACCESS_SECRET;

// おまじない
$header = 'Content-Type: text/plain; charset=utf-8';

// つぶやく

try {
  // TwistOAuthの新しい接続を生成
  $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
  // ツイートする
  $res = $connection->post('statuses/update', [
    'status' => 'Hello!!!'
  ]);
  // おまじない
  header($header, true, 200);
  // 返却値。成功したら、「ツイートしました。」とブラウザに表示
  echo "ツイートしました";
  var_dump($res);
} catch (Exception $e) {
  // おまじない
  header($header, true, $e->getCode() ?: 500);
  // ツイートに失敗したら、「ツイート失敗」と表示
  echo "ツイート失敗: {$e->getMessage()}\n";
}

?>