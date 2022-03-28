<?php

include '../db/connect.php';
$enlace = connection();

$sql = 'SELECT sku, nam, price FROM item';

$result = $enlace->query($sql);
$results = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }
}

$sql = 'SELECT sku, size FROM dvd';

$result = $enlace->query($sql);
$resultsDVD = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resultsDVD[] = $row;
    }
}

$sql = 'SELECT sku, weight FROM book';

$result = $enlace->query($sql);
$resultsBook = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resultsBook[] = $row;
    }
}

$sql = 'SELECT sku, leng, width, height FROM furniture';

$result = $enlace->query($sql);
$resultsFurniture = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resultsFurniture[] = $row;
    }
}

$obj = new stdClass();
$obj->item = $results;
$obj->dvd = $resultsDVD;
$obj->book = $resultsBook;
$obj->furniture = $resultsFurniture;

$objToSend = json_encode($obj);

echo $objToSend;

?>
