<?php
    $api_key = '55a23f27021b93378b1b779f1ee257da';
    $api_id = 'a17b53ed';

    $ricettaValue = urlencode($_GET["q"]);
    $url = "https://api.edamam.com/search?q=".$ricettaValue."&app_id=".$api_id."&app_key=".$api_key;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($curl);
    echo $res;
    curl_close($curl);

?>