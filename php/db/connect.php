<?php

  class DB {
    function connection()
    {
       $enlace = mysqli_connect('localhost','id18577008_localhost','_b_P_IY13WH_d0_E');
        if ($enlace->connect_error) {
            die('Connection failed: ' . $enlace->connect_error);
        } else {
            $this->createDB($enlace);
            $this->prepareTables($enlace);
            return $enlace;
        }
    }
    
    function createDB($enlace)
    {
        $sql = 'create database if not exists id18577008_lubosito';
        if ($enlace->query($sql) === true) {
            error_log('created');
        } else {
            error_log('not created. Error');
        }
        $enlace->select_db('id18577008_lubosito');
    }
    
    function prepareTables($en)
    {
        $sql =
            'create table if not exists item(sku varchar(30) primary key, nam varchar(30), price varchar(30), itemType varchar(30))';
    
        if ($en->query($sql) === true) {
            error_log ('successful0');
        } else {
            error_log('error0 '.$en->error );
        }
    
        $sql =
            'create table if not exists book(weight varchar(30), sku varchar(30), foreign key (sku) references item(sku))';
    
        if ($en->query($sql) === true) {
            error_log ('successful1');
        } else {
            error_log('error1'.$en->error);
        }
    
        $sql =
            'create table if not exists dvd(size int, sku varchar(30), foreign key (sku) references item(sku))';
    
        if ($en->query($sql) === true) {
            error_log ('successful2');
        } else {
            error_log('error2'.$en->error);
        }
    
        $sql =
            'create table if not exists furniture(height varchar(30), leng varchar(30), width varchar(30), sku varchar(30), foreign key (sku) references item(sku))';
    
        if ($en->query($sql) === true) {
            error_log ('successful3');
        } else {
            error_log('error3'.$en->error);
        }
    }
    
    
}
  
?>
