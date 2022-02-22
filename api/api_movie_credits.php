<?php
    $cz = curl_init();
    curl_setopt($cz, CURLOPT_URL, "http://api.themoviedb.org/3/movie/".$id_movie."/credits?api_key=" . $apikey . "&language=pt-BR");
    curl_setopt($cz, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($cz, CURLOPT_HEADER, FALSE);
    curl_setopt($cz, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    $response99 = curl_exec($cz);
    curl_close($cz);
    $movie_credits_id = json_decode($response99);
?>