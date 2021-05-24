<?php
include 'covidApi.php';

$covid_data = getGeneralData();
$covid_data = array_splice($covid_data,3,-1);
unset($covid_data["continent"]);



?>
<html>
<head>
    <title>Kenya Covid data</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div id="display">
        <div id="top-display">
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
        <div><img src="graph.php"></div>
    </div>
</body>
</html>