<?php
require '../vendor/autoload.php';

use CpChart\Data;
use CpChart\Image;

$data = json_decode(file_get_contents('daily-vaccinations.json'));
$last21 = array_slice($data, 0, 21);
foreach($last21 as $i => $day) {
	$shotData[] = $day->total_doses_cumulative;
	$shotDate[] = date('M j',strtotime($day->date));
}
$shotData = array_reverse($shotData);
$shotDate = array_reverse($shotDate);

/* Create and populate the Data object */
$data = new Data();
$data->addPoints($shotData, "Total Shots");
$data->setAxisName(0, "Shots");

$data->addPoints($shotDate, "Day");

$data->setSerieDescription("Labels", "Browsers");

$data->setAbscissa("Day"); # should match a series in addPoints()
// $data->setAxisPosition(0, AXIS_POSITION_BOTTOM);

/* Create the Image object */
$image = new Image(700, 400, $data);

$image->setFontProperties([
	"FontName" => __DIR__ . "/OpenSans-Regular.ttf", 
	"FontSize" => 8
	]
);

/* Draw the chart scale */
$image->setGraphArea(80, 30, 680, 380);
$image->drawScale([
    "CycleBackground" => true,
    "DrawSubTicks" => false,
    "GridR" => 0,
    "GridG" => 0,
    "GridB" => 0,
    "GridAlpha" => 10,
    "Mode" => SCALE_MODE_START0,
    "LabelSkip" => 1
    // "Pos" => SCALE_POS_TOPBOTTOM
]);

/* Draw the chart */
$image->drawBarChart([
	"DisplayPos" => LABEL_POS_INSIDE,
	"Gradient" => FALSE,
	"DisplayValues" => true, 
	"Rounded" => false, 
	"Surrounding" => 0]
);

/* Write the legend */
// $image->drawLegend(570, 215, ["Style" => LEGEND_NOBORDER, "Mode" => LEGEND_HORIZONTAL]);

/* Render the picture (choose the best way) */
$image->render("image.png");
// $image->autoOutput("example.drawBarChart.vertical.png");
