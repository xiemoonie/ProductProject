<?php
include '../db/connect.php';
function deleteSku($sku)
{
    $enlace = connection();
    $sql = "DELETE FROM dvd WHERE sku='$sku'";
    if ($enlace->query($sql) === true) {
        $sql = "DELETE FROM item WHERE sku='$sku'";
        if ($enlace->query($sql) === true) {
            echo 'Record deleted successfully';
        }
    }

    $sql = "DELETE FROM book WHERE sku='$sku'";
    if ($enlace->query($sql) === true) {
        $sql = "DELETE FROM item WHERE sku='$sku'";
        if ($enlace->query($sql) === true) {
            echo 'Record deleted successfully';
        }
    }

    $sql = "DELETE FROM furniture WHERE sku='$sku'";
    if ($enlace->query($sql) === true) {
        $sql = "DELETE FROM item WHERE sku='$sku'";
        if ($enlace->query($sql) === true) {
            echo 'Record deleted successfully';
        }
    }
}

?>
