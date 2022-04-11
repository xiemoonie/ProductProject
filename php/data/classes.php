<?php
abstract class Item
{
    public $sku;
    public $name;
    public $price;
    public $itemType;

    function __construct($jsonData)
    {
        if (isset($jsonData)) {
            $this->sku = $jsonData->sku;
            $this->name = $jsonData->name;
            $this->price = $jsonData->price;
            $this->itemType = $jsonData->itemType;
        }
    }

    function loadFromDb($sku) {
        $en = new DB();
        $enlace = $en->connection();

        $sql = "SELECT sku, nam, price, itemType FROM item WHERE sku='$sku'";

        $result = $enlace->query($sql);

        $row = $result->fetch_assoc();

        $this->sku = $row["sku"];
        $this->name = $row["nam"];
        $this->price = $row["price"];
        $this->itemType = $row["itemType"];

        $this->loadExtraFromDb($enlace);
        
        mysqli_close($enlace);
    }

    function addToDb()
    {
        $en = new DB();
        $enlace = $en->connection();

        $sql = "INSERT INTO item(SKU, NAM, PRICE, ITEMTYPE)
                VALUES
                ('$this->sku', '$this->name', '$this->price', '$this->itemType')";

        $generalSql = mysqli_query($enlace, $sql);

        if (!$generalSql) {
            die("Cannot add");
        }

        $this->addExtraToDb($enlace);

        mysqli_close($enlace);
    }

    function deleteFromDb() 
    {
        $en = new DB();
        $enlace = $en->connection();
        $this->deleteExtraFromDb($enlace);

        $sql = "DELETE FROM item WHERE sku='$this->sku'";
        mysqli_query($enlace, $sql);
        
        mysqli_close($enlace);
    }

    abstract protected function addExtraToDb($enlace);
    abstract protected function deleteExtraFromDb($enlace);
    abstract protected function loadExtraFromDb($enlace);
}

class DVD extends Item
{
    public $size;
    function __construct($jsonData)
    {
        parent::__construct($jsonData);
        if (isset($jsonData)) {
            $this->size = $jsonData->size;
        }
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

    function loadExtraFromDb($enlace) 
    {
        $sql = "SELECT sku, size FROM dvd WHERE sku='$this->sku'";

        $result = $enlace->query($sql);

        $row = $result->fetch_assoc();

        $this->size = $row["size"];
    }

    function deleteExtraFromDb($enlace) 
    {
        $sql = "DELETE FROM dvd WHERE sku='$this->sku'";

        $result = $enlace->query($sql);
    }
}

class Book extends Item
{
    public $weight;
    function __construct($jsonData)
    {
        parent::__construct($jsonData);
        if (isset($jsonData)) {
            $this->weight = $jsonData->weight;
        }
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
    function loadExtraFromDb($enlace) 
    {
        $sql = "SELECT sku, weight FROM book WHERE sku='$this->sku'";

        $result = $enlace->query($sql);

        $row = $result->fetch_assoc();

        $this->weight = $row["weight"];
    }
    
    function deleteExtraFromDb($enlace) 
    {
        $sql = "DELETE FROM book WHERE sku='$this->sku'";

        $result = $enlace->query($sql);
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
        if (isset($jsonData)) {
            $this->width = $jsonData->width;
            $this->height = $jsonData->height;
            $this->lenght = $jsonData->length;
        }
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

    function loadExtraFromDb($enlace) 
    {
        $sql = "SELECT sku, height, width, leng FROM furniture WHERE sku='$this->sku'";

        $result = $enlace->query($sql);

        $row = $result->fetch_assoc();

        $this->width = $row["width"];
        $this->height = $row["height"];
        $this->lenght = $row["leng"];
    }
    
    function deleteExtraFromDb($enlace) 
    {
        $sql = "DELETE FROM furniture WHERE sku='$this->sku'";

        $result = $enlace->query($sql);
    }
}
