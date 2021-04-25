<?php 
require '../vendor/autoload.php';

use Curl\Curl;

$curl = new Curl();
$curl->get('https://data.cityofchicago.org/resource/2vhs-cf6b.json');

echo "received data\n";

if($curl->error) {
	# socrata servers go down, chicago data portal goes down https://status.socrata.com/
	die("curl error\n");
}
else {
	$response = $curl->response;

	usort($response, 'dateSort'); 

	$data = json_encode($response, JSON_PRETTY_PRINT);

	file_put_contents('daily-vaccinations.json', $data);

	echo time() . "\t saved data\n";
}

function dateSort($a, $b) {
	return  strtotime($a->date) - strtotime($b->date);
}

?>