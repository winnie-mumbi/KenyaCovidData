<?php
include 'server.php';

require_once ('jpgraph-4.3.4/src/jpgraph.php');
require_once ('jpgraph-4.3.4/src/jpgraph_line.php');
require_once ('jpgraph-4.3.4/src/themes/UniversalTheme.class.php');

$covid_history = getHistoricalData();

$covid_deaths = $covid_history['deaths'];
$covid_recovered = $covid_history['recovered'];

$x_deaths = array_keys($covid_deaths);
$y_deaths = array_values($covid_deaths);

$x_recovered = array_keys($covid_recovered);
$y_recovered = array_values($covid_recovered);

$x_cases = array_keys($covid_deaths);
$y_cases = array_values($covid_deaths);
//print_r($x_data);

//Setup the graph
$graph = new Graph(1000,600);
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Kenya Covid Data');
$graph->SetBox(false);

//$graph->SetMargin(40,20,36,63);

$months = array(
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July ',
    'August',
    'September',
    'October',
    'November',
    'December',
);

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
//$graph->xaxis->SetScale('datlin',0,100);
$graph->xaxis->SetTickLabels($months);
$graph->xgrid->SetColor('#E3E3E3');

// Create the first line
$p1 = new LinePlot($y_deaths);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend('Line 1');

$p1 = new LinePlot($y_recovered);
$graph->Add($p1);
$p1->SetColor("#B22222");
$p1->SetLegend('Line 1');

// $p1 = new LinePlot($y_data);
// $graph->Add($p1);
// $p1->SetColor("#6495ED");
// $p1->SetLegend('Line 1');

$graph->legend->SetFrameWeight(1);

$graph->Stroke();


?>