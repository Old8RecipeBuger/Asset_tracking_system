<?php
    //database connection in the other file 
    include_once 'database.php';
    include_once 'functions.inc.php';

    //user want to upload a pc/lap
    if (isset($_POST["pcsubmit"])){
        $givenid = $_POST["gid"];
        $pcname= $_POST["pcName"];
        $model = $_POST["mol"];
        $type = $_POST["typ"];
        $serialNumber = $_POST["snum"];
        $cpu = $_POST["cpu"];
        $memory = $_POST["mem"];
        $storage = $_POST["stor"];
        $screensize = $_POST["ssize"];
        $resolution = $_POST["res"];
        $person = $_POST["persn"];
        $location = $_POST["locat"];
        $license = $_POST["lic"];
        $purchasedate = $_POST["pdate"];
        $warranty= $_POST["wdate"];

        if (emptyInputpcsubmit($givenid, $pcname, $model, $serialNumber, $cpu, $screensize,
            $person,$license, $purchasedate, $warranty) !== false){
            header("Location: ../subpages/upload.php?type=pc&error=emptyinput");
            exit();
        }
        
        $sqlcommand = "insert into computer (givenID, pcName, model, type,
                        sNum, cpu, memory, storage, screenSize, resolution, 
                        person, location, license, purchaseDate, warranty) 
        values ('$givenid', '$pcname', '$model', '$type','$serialNumber', '$cpu', 
        '$memory', '$storage', '$screensize', '$resolution', '$person',
        '$location','$license', '$purchasedate', '$warranty');";

        mysqli_query($connection, $sqlcommand); 

        //go back to the page
        header("Location: ../subpages/pc.php");
    }

    //user want to upload a tablet
    elseif (isset($_POST["tabsubmit"])){

        $givenid = $_POST["gid"];
        $model = $_POST["mol"];
        $serialNumber = $_POST["snum"];
        $storage = $_POST["stor"];
        $screensize = $_POST["ssize"];
        $cap = $_POST["cap"];
        $purchasedate = $_POST["pdate"];
        $warranty= $_POST["wdate"];

        if (emptyInputtabsubmit($givenid, $model, $serialNumber, $screensize, $purchasedate, $warranty) !== false){
            header("Location: ../subpages/upload.php?type=tab&error=emptyinput");
            exit();
        }
        
        $sqlcommand = "insert into tablet (givenID, model,
                        sNum, storage, screenSize, capacity, purchaseDate, warranty) 
        values ('$givenid', '$model', '$serialNumber', '$storage', 
        '$screensize', '$cap', '$purchasedate', '$warranty');";
    
        mysqli_query($connection, $sqlcommand); 
    
        //go back to the page
        header("Location: ../subpages/tab.php");
    }

    //user want to upload a sim
    elseif (isset($_POST["simsubmit"])){

        $givenid = $_POST["gid"];
        $iccid = $_POST["iccid"];
        $provider = $_POST["pro"];
        $number = $_POST["num"];
        $cost = $_POST["cos"];
        $data = $_POST["dat"];
        $net = $_POST["net"];
        $expiredate = $_POST["edate"];

        if (emptyInputsimsubmit($givenid, $iccid, $provider, $number, $cost, $data, $expiredate) !== false){
            header("Location: ../subpages/upload.php?type=sim&error=emptyinput");
            exit();
        }
        
        $sqlcommand = "insert into sim (givenID, iccid, provider,
                        number, cost, data, network, expireDate) 
        values ('$givenid', '$iccid', '$provider', '$number', 
        '$cost', '$data', '$net','$expiredate');";
    
        mysqli_query($connection, $sqlcommand); 
    
        //go back to the page
        header("Location: ../subpages/sim.php");
    }

    //user want to upload a pc/lap
    elseif (isset($_POST["othersubmit"])){
        $givenid = $_POST["gid"];
        $model = $_POST["mol"];
        $type = $_POST["typ"];
        $screensize = $_POST["ssize"];
        $resolution = $_POST["res"];
        $location = $_POST["locat"];
        $purchasedate = $_POST["pdate"];
        if (!isset($_POST["connection"])){
            header("Location: ../subpages/upload.php?type=other&error=emptyinput");
                exit();
        }
        $connection_list = $_POST["connection"];
        $cHDMI = False;
        $cDP = False;
        $cVGA = False;
        $cDVI = False;
        $cUSBC = False;
        $warranty= $_POST["wdate"];

        foreach ($connection_list as $conn){
            if($conn == "cHDMI"){
                $cHDMI = True;
            }
            elseif($conn == "cVGA"){
                $cVGA = True;
            }
            elseif($conn == "cDP"){
                $cDP = True;
            }
            elseif($conn == "cDVI"){
                $cDVI = True;
            }
            elseif($conn == "cUSBC"){
                $cUSBC = True;
            }
        }

        if (emptyInputothersubmit($givenid, $model, $type, $connection_list, $screensize, $purchasedate, $warranty) !== false){
            header("Location: ../subpages/upload.php?type=other&error=emptyinput");
            exit();
        }

        $sqlcommand = "insert into other (givenID, model, type, cHDMI, cVGA, cDP, cDVI, cUSBC, screenSize, resolution, 
                        location, purchaseDate, warranty) 
        values ('$givenid', '$model', '$type', '$cHDMI', '$cVGA', '$cDP', '$cDVI', '$cUSBC',
                '$screensize', '$resolution','$location','$purchasedate', '$warranty');";

        mysqli_query($connection, $sqlcommand); 

        //go back to the page
        header("Location: ../subpages/other.php");
    }
?>