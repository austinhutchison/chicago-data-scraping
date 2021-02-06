<?php
require '../vendor/autoload.php';
use DG\Twitter\Twitter;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// $twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
$twitter = new Twitter($_ENV['TWITTER_CONSUMER_KEY'], $_ENV['TWITTER_CONSUMER_SECRET'], $_ENV['TWITTER_ACCESS_TOKEN'], $_ENV['TWITTER_ACCESS_SECRET']);

$data = json_decode(file_get_contents('daily-vaccinations.json'));

$totalDoses			= $data[0]->total_doses_cumulative;
$totalDosesRequired	= 4920343;
$totalDosesPretty	= number_format($totalDoses);

//trailing average
$days = 7;
$trailingTotal = 0;
foreach($data as $i => $day) {
	$trailingTotal += $data[$i]->total_doses_daily;
	if($i == $days - 1) {
		break;
	}
}
$trailingAvg = number_format(round($trailingTotal / $days));

$progress		= round($totalDoses / $totalDosesRequired,3);
$progressPretty = $progress * 100;

$barFilled = ceil($progress * 40);
$progressBar = str_repeat("▓", $barFilled) . str_repeat("░", 40 - $barFilled);

$message = "💉 Chicago Vaccination progress: $progressPretty%

$totalDosesPretty doses administered
$trailingAvg per day (7 day average)

$progressBar

#COVID #CovidVaccine";

echo $message . "\n";

$twitter->send($message);

?>