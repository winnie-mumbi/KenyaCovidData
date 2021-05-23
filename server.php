<?php

function getHistoricalData(){

    $history_url = "https://disease.sh/v3/covid-19/historical/all?country=Kenya";

    $covid_history = getData($history_url);

    return $covid_history;

}

function getGeneralData(){

    $url = "https://disease.sh/v3/covid-19/countries/kenya";

    $covid_general = getData($url);

    return $covid_general;

}

function getData($url){
    //Initiate curl session in a variable
    $curl_handle = curl_init();

    // Set the curl URL option
    curl_setopt($curl_handle, CURLOPT_URL, $url);

    // This option will return data as a string instead of direct output
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

    // Execute curl & store data in a variable
    $curl_data = curl_exec($curl_handle);

    curl_close($curl_handle);

    // // Decode JSON into PHP array
    $response_data = json_decode($curl_data,true);

    return $response_data;
}

?>