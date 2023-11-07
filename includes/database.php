<?php

$dbServername = "Localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "tavernerintern";

$dsn = 'mysql:host='.$dbServername.';dbname='.$dbName;
$connection = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);

try {
    $pdo = new PDO($dsn, $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

if(!$connection){
    die("Connection Failed : " . mysqli_connect_error());
}

?>