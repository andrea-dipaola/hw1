<?php
    $client_id = '66567d180ce74cd9b1d720c2f7c34046';
    $client_secret = '8561788831824448ac25595e3456f550';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    $headers = array("Authorization: Basic ".base64_encode($client_id.":".$client_secret));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($curl);
    curl_close($curl);

    $token = json_decode($res) -> access_token; 
    $podcastValue = urlencode($_GET["q"]);
    $url = "https://api.spotify.com/v1/search?q=".$podcastValue."&type=episode&limit=30&offset=0&market=IT";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $headers = array('Authorization: Bearer '.$token);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $res = curl_exec($curl);
    echo $res;
    curl_close($curl);

?>