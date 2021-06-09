<?php
require_once './vendor/amenadiel/jpgraph/src/config.inc.php';
include 'covidApi.php';


use Amenadiel\JpGraph\Graph\Graph;
use Amenadiel\JpGraph\Plot;
use Amenadiel\JpGraph\Util;

$covid_history = getHistoricalData();

// retrieve respective options array i.e totalcases, total deaths and total recovered
$covid_deaths = $covid_history['deaths'];
$covid_recovered = $covid_history['recovered'];
$covid_cases = $covid_history['cases'];

// get values for each i.e totalcases, total deaths and total recovered; y represents the y-axis
$y_cases = array_values($covid_cases);
$y_recovered = array_values($covid_recovered);
$y_deaths = array_values($covid_deaths);

// get dates for the covid data; x is for x-axis
$timestamps = array_keys($covid_deaths);

$x_timestamps = array();

// convert the dates to timestamps
foreach($timestamps as $time){
    array_push($x_timestamps, strtotime($time));
}

// create tick positions for the dates 
$dateUtils = new Util\DateScaleUtils();

// using array filter and map to remove empty arrays created
list($tickPositions,$minTickPositions) = array_filter(array_map('array_filter',$dateUtils->getTicks($x_timestamps)));

// // creating the graph
$graph = new Graph(800,600);

$graph->SetScale("intlin");
$graph->SetMarginColor('#222');
$graph->SetFrame(true,'#222');
$graph->SetColor('white');

$graph->xaxis->SetTickPositions($tickPositions,$minTickPositions);
$graph->xaxis->SetLabelFormatString('My',true);
$graph->xaxis->SetColor('white');


$graph->title->Set('Kenya Covid Data');
$graph->title->SetColor('white');
$graph->SetColor('black');

$graph->SetMargin(60,20,60,120);

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);
$graph->yaxis->SetColor('white');
$graph->ygrid->Show(false, false);


$graph->xgrid->Show();
//$graph->xgrid->SetLineStyle("solid");
$graph->xgrid->SetColor('black');

// Create the line for total cases
$p1 = new PLot\LinePlot($y_cases,$x_timestamps);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend('New cases');


$p1 = new PLot\LinePlot($y_deaths,$x_timestamps);
$graph->Add($p1);
$p1->SetColor("#FF0000");
$p1->SetLegend('Deaths');

$p1 = new Plot\LinePlot($y_recovered,$x_timestamps);
$graph->Add($p1);
$p1->SetColor("#FFA500");
$p1->SetLegend('Recovered');



$graph->legend->SetFrameWeight(1);

$graph->Stroke();


?>