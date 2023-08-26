<?php
header('Content-type: application/json; charset=utf-8');

if (!isset($_GET["code"])) {
    exit();
}

$code = $_GET["code"];

$apiUrl = "https://openlibrary.org/isbn/" . $code . ".json";



$curl = curl_init($apiUrl);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

$response = curl_exec($curl);


if (!$response){
    echo json_encode(array("error" => "error"));
    exit();
}

curl_close($curl);

$bookInfo = json_decode($response);

?>