<?php
header("Content-Type: application/json");

include_once("utils/database.php");

$db = new Database();

$getBooksSql = "SELECT * FROM tbm_books";

$booksData = $db -> select($getBooksSql);

echo json_encode($booksData);

?>