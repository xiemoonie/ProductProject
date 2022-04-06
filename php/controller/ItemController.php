<?php
header('Content-Type: application/json; charset=utf-8');
include '../db/connect.php';
include '../data/classes.php';

class ItemController
{
    function deleteSku($json)
    {
        $data = json_decode($json);

        $className = $data->itemType;
        $sku = $data->text;

        $itemObj = new $className($data);

        $itemObj->loadFromDb($sku);

        $itemObj->deleteFromDb();

        if (!isset($jsonResponse)) {
            $jsonResponse = new stdClass();
        }

        $jsonResponse->status = 'OK';   
    }
    function getData()
    {
        $enlace = connection();

        $sql = 'SELECT sku, itemType FROM item';

        $result = $enlace->query($sql);
        $results = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $className = $row["itemType"];
                $ob = new $className();
                $ob->loadFromDb($row["sku"]);
                $results[] = $ob;
            }
        }

        $obj = new stdClass();
        $obj->items = $results;

        $objToSend = json_encode($obj);

        echo $objToSend;
    }
    function setDataNew($json)
    {
        // $json = file_get_contents('php://input');
        $data = json_decode($json);

        $className = $data->itemType;

        $itemObj = new $className($data);

        $itemObj->addToDb();

        if (!isset($jsonResponse)) {
            $jsonResponse = new stdClass();
        }

        $jsonResponse->status = 'OK';

        //echo json_encode($jsonResponse);
    }
}
?>
