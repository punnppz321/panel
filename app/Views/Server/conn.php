<?php

$servername = "localhost";
$username = "ngpcindl_gg";
$password = "26494151";
$dbname = "ngpcindl_gg";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if(!$conn) {

die(" PROBLEM WITH CONNECTION : " . mysqli_connect_error());

}
  
?>