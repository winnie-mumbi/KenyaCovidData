<?php
include 'server.php';
require_once ('jpgraph-4.3.4/src/jpgraph.php');
require_once ('jpgraph-4.3.4/src/jpgraph_line.php');
require_once ('jpgraph-4.3.4/src/themes/UniversalTheme.class.php');

$covid_data = getGeneralData();
$covid_data = array_splice($covid_data,3,-1);

$covid_history = getHistoricalData();


$datay1 = array(20,15,23,15);

//Setup the graph
$graph = new Graph(300,250);
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Filled Y-grid');
$graph->SetBox(false);

$graph->SetMargin(40,20,36,63);

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels(array('A','B','C','D'));
$graph->xgrid->SetColor('#E3E3E3');

// Create the first line
$p1 = new LinePlot($datay1);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend('Line 1');

// Create the second line
$p2 = new LinePlot($datay2);
$graph->Add($p2);
$p2->SetColor("#B22222");
$p2->SetLegend('Line 2');

// Create the third line
$p3 = new LinePlot($datay3);
$graph->Add($p3);
$p3->SetColor("#FF1493");
$p3->SetLegend('Line 3');

$graph->legend->SetFrameWeight(1);

// Output line
$graph->Stroke();

?>
<html>
<head>
    <title>Kenya Covid data</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div id="display">
        <div>
            <table id="general">
                <tr>
                    <th>Total Confirmed cases</th>
                    <th>Deaths</th>
                    <th>Total Recovered</th>
                </tr>
                <tr>
                    <td class="view"><?= number_format($covid_data['cases']) ?></td>
                    <td class="view"><?= number_format($covid_data['deaths'])?></td>
                    <td class="view"><?= number_format($covid_data['recovered'])?></td>
                </tr>
            </table>
        </div>
        <div>
            <table id="detailed-table">
                <tr>
                    <th>Type</th>
                    <th>Number of cases</th>
                </tr>
                <?php foreach($covid_data as $data => $item){
                    echo '
                        <tr>
                            <td>'.ucfirst($data).'</td>
                            <td id="item">'.number_format($item).'</td>
                        </tr>

                    ';
                }
                ?>
        </table>
        </div>
    </div>
</body>
</html>