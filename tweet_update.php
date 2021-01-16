<?php
require '../vendor/autoload.php';
use DG\Twitter\Twitter;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// $twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
$twitter = new Twitter($_ENV['TWITTER_CONSUMER_KEY'], $_ENV['TWITTER_CONSUMER_SECRET'], $_ENV['TWITTER_ACCESS_TOKEN'], $_ENV['TWITTER_ACCESS_SECRET']);

$totalDoses 		= 93099;
$totalDosesRequired = 4920343;

$progress = round($totalDoses / $totalDosesRequired,2);

$barFilled = ceil($progress * 40);

$progress = str_repeat("▓", $barFilled) . str_repeat("░", 40 - $barFilled);

$message = "💉 Chicago Vaccination progress: $progressPretty%
★★★★
";

$message .= $progress;

$twitter->send($message);

?>