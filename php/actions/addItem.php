<?php
include '../controller/ItemController.php';

$json = $_POST['setD'];
$item = new ItemController();
$item->setDataNew($json);
?>