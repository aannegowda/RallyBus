<?php

// Database connection settings
$dbServerName = "localhost";
$dbUserName = "root";
$dbPassword = "root";
$dbName = "dbproject";

// Connect to MySQL database
$connection = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

// Check connection
if($connection === false){
    die("ERROR: Could not connect to MySQL. " . mysqli_connect_error());
}


