<?php
    //database connection in the other file 
    include_once 'database.php';

    $sql_array = array();
    $page = $_POST["page"];


    foreach($_POST as $key => $value){
        if (is_numeric($key)){
            $array = explode(" ", $value);
            $sql_array += [$key => $array];
        }
    }
    print_r($sql_array);
    
    foreach($sql_array as $key => $value){
        $dID = $value[0];
        $length = count($value);
        if($length==2){
            $type = $value[1];
        }
        else{
            $type = NULL;
        }

        $sql_command = "update sim set dID = '$dID', deviceType='$type' where sID = '$key'; ";
        if(mysqli_query($connection,$sql_command)){
            header("Location: ../subpages/simalloc.php");
        }
    }

  