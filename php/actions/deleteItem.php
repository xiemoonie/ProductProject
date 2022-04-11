<?php
include '../controller/ItemController.php';

$json = $_POST['eraseD'];
$item = new ItemController();
$item->deleteSku($json);
?>