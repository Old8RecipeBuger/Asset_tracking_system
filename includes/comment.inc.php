<?php
    include_once 'database.php';

    if (isset($_POST["deletecomment"])){
        $commentID_to_be_delete = $_POST["deletecomment"];
        $deviceType=$_POST["deviceType"];

        $sqlcommand = "delete from comment where ctID = '$commentID_to_be_delete';";
        mysqli_query($connection, $sqlcommand); 

        if ($deviceType == "tablet"){
            $tID=$_POST["dID"];
            header("Location: ../subpages/detail.php?tID=$tID");
        }
        elseif ($deviceType == "computer"){
            $cID=$_POST["dID"];
            header("Location: ../subpages/detail.php?cID=$cID");
        }
        elseif ($deviceType == "sim"){
            $sID=$_POST["dID"];
            header("Location: ../subpages/detail.php?sID=$sID");
        }
        elseif ($deviceType == "other"){
            $oID=$_POST["dID"];
            header("Location: ../subpages/detail.php?oID=$oID");
        }
    }


    if (isset($_POST["tabcsubmit"])){
        $content=$_POST["comment"];
        $tID=$_POST["dID"];
        $uID=$_POST["uID"];
        $date=$_POST["date"];
        $deviceType=$_POST["deviceType"];

        if ($_POST["comment"] == NUll){
            header("Location: ../subpages/detail.php?tID=$tID");
            exit();
        }

        $sqlcommand = "insert into comment (dID, uID, content, date, deviceType) 
            values ('$tID', '$uID', '$content','$date', 
                    '$deviceType');";

        mysqli_query($connection, $sqlcommand); 

        //go back to the page
        header("Location: ../subpages/detail.php?tID=$tID");
        exit();
    }
    elseif (isset($_POST["compcsubmit"])){
        $content=$_POST["comment"];
        $cID=$_POST["dID"];
        $uID=$_POST["uID"];
        $date=$_POST["date"];
        $deviceType=$_POST["deviceType"];

        if ($_POST["comment"] == NUll){
            header("Location: ../subpages/detail.php?cID=$cID");
            exit();
        }
    
        $sqlcommand = "insert into comment (dID, uID, content, date, deviceType) 
            values ('$cID', '$uID', '$content','$date', 
                    '$deviceType');";
    
        mysqli_query($connection, $sqlcommand); 
    
        header("Location: ../subpages/detail.php?cID=$cID");
        exit();
    }
    elseif (isset($_POST["simcsubmit"])){
        $content=$_POST["comment"];
        $sID=$_POST["dID"];
        $uID=$_POST["uID"];
        $date=$_POST["date"];
        $deviceType=$_POST["deviceType"];

        if ($_POST["comment"] == NUll){
            header("Location: ../subpages/detail.php?sID=$sID");
            exit();
        }
    
        $sqlcommand = "insert into comment (dID, uID, content, date, deviceType) 
            values ('$sID', '$uID', '$content','$date', 
                    '$deviceType');";
    
        mysqli_query($connection, $sqlcommand); 
    
        //go back to the page
        header("Location: ../subpages/detail.php?sID=$sID");
        exit();
    }
    elseif (isset($_POST["othercsubmit"])){
        $content=$_POST["comment"];
        $oID=$_POST["dID"];
        $uID=$_POST["uID"];
        $date=$_POST["date"];
        $deviceType=$_POST["deviceType"];

        if ($_POST["comment"] == NUll){
            header("Location: ../subpages/detail.php?oID=$oID");
            exit();
        }
    
        $sqlcommand = "insert into comment (dID, uID, content, date, deviceType) 
            values ('$oID', '$uID', '$content','$date', 
                    '$deviceType');";
    
        mysqli_query($connection, $sqlcommand); 
    
        header("Location: ../subpages/detail.php?oID=$oID");
        exit();
    }

