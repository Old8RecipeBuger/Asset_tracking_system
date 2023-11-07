<?php
    //database connection in the other file 
    include_once 'database.php';

    print_r($_POST);

    foreach ($_POST["connection"] as $conn){
        $sqlcommand = "update other set $conn=true where oID = '1';";
        mysqli_query($connection, $sqlcommand);
    }
