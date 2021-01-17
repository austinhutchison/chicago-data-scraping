<?php 
require '../vendor/autoload.php';

use Curl\Curl;

$curl = new Curl();
$curl->get('https://data.cityofchicago.org/resource/2vhs-cf6b.json');

echo "received data\n";

if($curl->error) {
	die("curl error");
}
else {
	$data = json_encode($curl->response, JSON_PRETTY_PRINT);

	file_put_contents('daily-vaccinations.json', $data);

	echo time() . "\t saved data\n";
}

?>