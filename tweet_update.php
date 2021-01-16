<?php
require '../vendor/autoload.php';
use DG\Twitter\Twitter;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// $twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
$twitter = new Twitter($_ENV['TWITTER_CONSUMER_KEY'], $_ENV['TWITTER_CONSUMER_SECRET'], $_ENV['TWITTER_ACCESS_TOKEN'], $_ENV['TWITTER_ACCESS_SECRET']);

print_r($_ENV);

$progress = "▓░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░";

$message = "💉
★★★★
";

$message .= $progress;

$twitter->send($message);

?>