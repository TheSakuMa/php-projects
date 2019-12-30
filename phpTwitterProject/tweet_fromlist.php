<?php
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

$filelist = file('list.txt'); // ファイル全体を読み込んで、配列化する
shuffle($filelist); // 配列の要素をシャッフル
$message = $filelist[0];

$header = 'Content-Type: text/plain; charset=utf-8';

try {
  $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

  $statuses = $connection->post('statuses/update', [
    // このままだと、直近数件のものと重複したツイートはエラーとなるので注意
    "status" => $message
  ]);

  header($header, true, 200);

  echo "ツイートしました\n";
  var_dump($statuses);

} catch (Exception $e) {

  header($header, true, $e->getCode() ?: 500);

  echo "ツイート失敗: {$e->getMessage()}\n";
}

?>