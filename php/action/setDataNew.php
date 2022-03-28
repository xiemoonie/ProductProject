<?php
header('Content-Type: application/json; charset=UTF-8');
include '../data/classes.php';

$json = file_get_contents('php://input');
$data = json_decode($json);

$className = $data->itemType;

$itemObj = new $className($data); // Create class by name in itemType ... just like there would be new DVD()

$itemObj->addToDb();

if (!isset($jsonResponse)) {
    $jsonResponse = new stdClass();
} // I have no idea why this needs to be here, but otherwise I get warning and it screw up response

$jsonResponse->status = 'OK';

echo json_encode($jsonResponse);
?>
