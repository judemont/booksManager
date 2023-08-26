<?php
include_once("utils/database.php");

if (!isset($_GET["code"])) {
    exit();
}

$db = new Database;

$code = $db->escapeStrings(htmlspecialchars($_GET["code"]));

$apiUrl = "https://www.openlibrary.org/isbn/" . $code . ".json";



$curl = curl_init($apiUrl);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HEADER, true); 

$response = curl_exec($curl);
$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

if (!$response){
    $message = "An error occurred";
    header("location: ../index.php?p=new&message=" . htmlspecialchars($message));
    exit();
}

if($httpcode != 200){
    if($httpcode == 404){
        $message = "Invalid book code.";
        header("location: ../index.php?p=new&message=" . htmlspecialchars($message));
        exit();
    }else{
        $message = "An error occurred";
        header("location: ../index.php?p=new&message=" . htmlspecialchars($message));
        exit();
    }
}

curl_close($curl);

$bookInfo = json_decode($response, true);

$title = $db->escapeStrings(htmlspecialchars($bookInfo['title']));

$insertNewBookSql = "INSERT INTO tbm_books (title, code)
SELECT '$title', '$code'
WHERE NOT EXISTS (SELECT 1 FROM tbm_books WHERE code = '$code');
";

$db -> query($insertNewBookSql);

$message = "The new book was successfully added";
header("location: ../index.php?message=" . htmlspecialchars($message));
?>