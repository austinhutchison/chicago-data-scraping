<?php
require '../vendor/autoload.php';
use DG\Twitter\Twitter;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// $twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
$twitter = new Twitter($_ENV['TWITTER_CONSUMER_KEY'], $_ENV['TWITTER_CONSUMER_SECRET'], $_ENV['TWITTER_ACCESS_TOKEN'], $_ENV['TWITTER_ACCESS_SECRET']);

$totalDoses 		= 93099;
$totalDosesRequired = 4920343;
$totalDosesPretty   = number_format($totalDoses);

$progress 	    = round($totalDoses / $totalDosesRequired,3);
$progressPretty = $progress * 100;

$barFilled = ceil($progress * 40);

$progressBar = str_repeat("▓", $barFilled) . str_repeat("░", 40 - $barFilled);

$message = "💉 Chicago Vaccination progress: $progressPretty%

$totalDosesPretty doses administered
";

$message .= $progressBar;

$twitter->send($message);

?>