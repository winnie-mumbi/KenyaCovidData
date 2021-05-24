<?php
include 'covidApi.php';

require_once ('jpgraph-4.3.4/src/jpgraph.php');
require_once ('jpgraph-4.3.4/src/jpgraph_line.php');
require_once ('jpgraph-4.3.4/src/jpgraph_utils.inc.php');

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
$dateUtils = new DateScaleUtils();
list($tickPositions,$minTickPositions) = array_filter(array_map('array_filter',$dateUtils->getTicks($x_timestamps)));

// creating the graph
$graph = new Graph(1000,600);
$graph->SetScale("intlin");
$graph->xaxis->SetTickPositions($tickPositions,$minTickPositions);
$graph->xaxis->SetLabelFormatString('My',true);


$graph->title->Set('Kenya Covid Data');
// $graph->SetBox(false);

$graph->SetMargin(100,20,36,130);

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
//$graph->xgrid->SetLineStyle("solid");
$graph->xgrid->SetColor('#E3E3E3');

// Create the line for total cases
$p1 = new LinePlot($y_cases,$x_timestamps);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend('New cases');

$p1 = new LinePlot($y_deaths,$x_timestamps);
$graph->Add($p1);
$p1->SetColor("#FF0000");
$p1->SetLegend('Deaths');

$p1 = new LinePlot($y_recovered,$x_timestamps);
$graph->Add($p1);
$p1->SetColor("#FFA500");
$p1->SetLegend('Recovered');



$graph->legend->SetFrameWeight(1);

$graph->Stroke();


?>