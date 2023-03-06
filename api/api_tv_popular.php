<?php
    $ctp = curl_init();
    curl_setopt($ctp, CURLOPT_URL, "http://api.themoviedb.org/3/tv/popular?api_key=" . $apikey  . "&language=pt-BR");
    curl_setopt($ctp, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ctp, CURLOPT_HEADER, FALSE);
    curl_setopt($ctp, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    $response12 = curl_exec($ctp);
    curl_close($ctp);
    $tv_onair = json_decode($response12);
?>