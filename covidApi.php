<?php

// get history covid data
function getHistoricalData(){

    $history_url = "https://disease.sh/v3/covid-19/historical/kenya?&lastdays=all";

    $covid_history = getData($history_url);

    $covid_history = $covid_history["timeline"];

    return $covid_history;

}

// get general covid data
function getGeneralData(){

    $url = "https://disease.sh/v3/covid-19/countries/kenya";

    $covid_general = getData($url);

    return $covid_general;

}

// get general covid data
function getVaccinationData(){

    $url = "https://disease.sh/v3/covid-19/vaccine/coverage/countries/Kenya?lastdays=1";

    $covid_vaccination = getData($url);
    print_r('afasdfasdf',$covid_vaccination);

    return $covid_vaccination["timeline"];

}

// et data using curl
function getData($url){
    //Initiate curl session in a variable
    $curl_handle = curl_init();

    // Set the curl URL option
    curl_setopt($curl_handle, CURLOPT_URL, $url);

    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

    // Execute curl & store data in a variable
    $curl_data = curl_exec($curl_handle);

    curl_close($curl_handle);

    // Decode JSON into PHP array
    $response_data = json_decode($curl_data,true);

    return $response_data;
}



?>