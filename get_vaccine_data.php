<?php 
require '../vendor/autoload.php';

use Curl\Curl;

$curl = new Curl();
$curl->get('https://data.cityofchicago.org/resource/2vhs-cf6b.json');

echo "received data\n";

$data = json_encode($curl->response, JSON_PRETTY_PRINT);

file_put_contents('daily-vaccinations.json', $data);

echo "saved data\n";

?>