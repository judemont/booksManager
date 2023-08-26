<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("utils/database.php");

if (!isset($_GET["code"])) {
    exit();
}

$db = new Database;

$code = $db->escapeStrings($_GET["code"]);

$apiUrl = "https://www.openlibrary.org/isbn/" . $code . ".json";



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

$bookInfo = json_decode($response, true);

$title = $db->escapeStrings($bookInfo['title']);

$insertNewBookSql = "INSERT INTO booksManager (title, code) VALUES ('$title', '$code')";

$db -> query($insertNewBookSql);

$message = "The new book was successfully added";
header("location: index.php?message=" . htmlspecialchars($message));
?>