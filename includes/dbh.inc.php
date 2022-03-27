<?php

$serverName = "localhost";
$dBusername = "root";
$dBpassword = ""; 
$dBname = "loginsystem"; 

$connection = mysqli_connect($serverName, $dBusername, $dBpassword, $dBname); 

if(!$connection) { 
    die("Connection to database failed" . mysqli_connect_error()); 
}