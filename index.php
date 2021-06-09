<?php
include 'covidApi.php';

$covid_data = getGeneralData();
$covid_data = array_splice($covid_data,3,-1);
unset($covid_data["continent"]);

$covid_vaccination = getVaccinationData();
$covid_vaccination = array_values($covid_vaccination);

?>
<html>

<head>
    <title>Kenya Covid data</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div id="display">
        <div id="top-display">
            <div id="top-dock">
                <div class="dock-element" style="color: #bdbdbd">
                    <div>Last updated at</div>
                    <div id="update-date"><?= date("Y/m/d") ?></div>
                </div>
                <div class="dock-element">
                    <div class="dock-title">Cases</div>
                    <div class="text" style="color: red"><?= number_format($covid_data['cases']) ?></div>
                </div>
                <div class="dock-element">
                    <div class="dock-title">Deaths</div>
                    <div class="text" style="color: white"><?= number_format($covid_data['deaths']) ?></div>
                </div>
                <div class="dock-element">
                    <div class="dock-title">Deaths</div>
                    <div class="text" style="color: orange"><?= number_format($covid_data['recovered']) ?></div>
                </div>
                <div class="dock-element">
                    <div class="dock-title">Vaccinations</div>
                    <div class="text" style="color: green"><?= number_format($covid_vaccination[0]) ?></div>
                </div>
            </div>

        </div>
        <div id="detailed-col">
            <div id="detailed-table">
                <?php foreach($covid_data as $data => $item){
                        echo '
                            <div class="list-items">
                                <p>
                                <span>
                                    <span style="color:red">'.ucfirst($data).'</span>
                                    <span style="color:#e60000">&nbsp;</span>
                                    |
                                    <span style="color:#e60000">&nbsp;</span>
                                    <span>'.number_format($item).'</span>
                                </span>
                                </p>
                            </div>
                        ';
                    }
                ?>
            </div>
            <div id=graph><img src="graph.php"></div>
        <div>
    </div>
</body>

</html>