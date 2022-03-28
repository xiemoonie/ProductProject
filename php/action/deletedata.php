<?php
header('Content-Type: application/json; charset=utf-8');
include '../action/deleteItem.php';

$json = file_get_contents('php://input');
$data = json_decode($json);
$sku = $data->text;

echo deleteSku($sku);

?>
