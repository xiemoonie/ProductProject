<?php
function connection(){
  $enlace = mysqli_connect("127.0.0.1", "root", "lubosito", "mibd");
  if ($enlace->connect_error) {
    die("Connection failed: " . $enlace->connect_error);
   
  }else{
    return $enlace;
  }
  }
?>