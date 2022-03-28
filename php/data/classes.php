<?php

include("../db/connect.php");

abstract class Item
{
    public $sku;
    public $name;
    public $price;

    function __construct($jsonData)
    {
        $this->sku = $jsonData->sku;
        $this->name = $jsonData->name;
        $this->price = $jsonData->price;
    }

    function addToDb()
    {

        $enlace = connection();

        $sql = "INSERT INTO item(SKU, NAM, PRICE)
                VALUES
                ('$this->sku', '$this->name',' $this->price')";

        $generalSql = mysqli_query($enlace, $sql);

        if (!$generalSql) {
            die("Cannot add");
        }

        $this->addExtraToDb($enlace);

        mysqli_close($enlace);
    }

    abstract protected function addExtraToDb($enlace);
}

class DVD extends Item
{
    public $size;
    function __construct($jsonData)
    {
        parent::__construct($jsonData);
        $this->size = $jsonData->size;
    }
    function get_size()
    {
        return $this->size;
    }
    function get_price()
    {
        return $this->price;
    }
    function get_nam()
    {
        return $this->name;
    }
    function addExtraToDb($enlace)
    {
        $sql = "INSERT INTO dvd(SKU, SIZE)
                VALUES
                ('$this->sku', '$this->size')";

        if (!mysqli_query($enlace, $sql)) {
            echo "Error dvd";
        }
    }
}

class Book extends Item
{
    public $weight;
    function __construct($jsonData)
    {
        parent::__construct($jsonData);
        $this->weight = $jsonData->weight;
    }
    function addExtraToDb($enlace)
    {
        $sql = "INSERT INTO book(SKU, WEIGHT)
                VALUES
                ('$this->sku', '$this->weight')";

        if (!mysqli_query($enlace, $sql)) {
            echo "Error book";
        }
    }
}
class Furniture extends Item
{
    public $width;
    public $height;
    public $lenght;
    function __construct($jsonData)
    {
        parent::__construct($jsonData);

        $this->width = $jsonData->width;
        $this->height = $jsonData->height;
        $this->lenght = $jsonData->length;
    }
    function addExtraToDb($enlace)
    {
        $sql = "INSERT INTO furniture(SKU, HEIGHT, WIDTH, LENG)
                VALUES
                ('$this->sku', '$this->height','$this->width','$this->lenght')";

        if (!mysqli_query($enlace, $sql)) {
            echo "Error furniture";
        }
    }
}
