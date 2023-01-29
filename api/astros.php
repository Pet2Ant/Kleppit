<?php

//Created for the index widgets by nikos

//http Fetch astronauhts from http://api.open-notify.org/astros.json

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://api.open-notify.org/astros.json',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);

//output in json format
echo $response;

?>
