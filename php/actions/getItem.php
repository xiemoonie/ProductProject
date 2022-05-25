<?php
include '../controller/ItemController.php';
error_reporting(E_ALL ^ (E_WARNING | E_NOTICE));
(new ItemController())->getData();
?>