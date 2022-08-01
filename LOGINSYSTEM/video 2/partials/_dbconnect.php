<?php
$server = "localhost";
$username ="root";
$password = "";
$database= "users";
$connect = mysqli_connect($server, $username, $password, $database);
if(!$connect){
    die("ERROR" . mysqli_connect_error());
}

?>