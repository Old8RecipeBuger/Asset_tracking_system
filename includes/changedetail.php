<?php
    //database connection in the other file 
    include_once 'database.php';

    //change time 
    if (isset($_POST["computersubmit"])){
        $fatal = False;
        $dead = False;
        if (array_key_exists("fatal", $_POST)){
            $fatal = True;
        }
        if (array_key_exists("dead", $_POST)){
            $dead = True;
        }
        $cID = $_POST["computersubmit"];
        $givenid = $_POST["GivenID"];
        $pcname= $_POST["pcName"];
        $model = $_POST["Model"];
        $type = $_POST["Type"];
        $serialNumber = $_POST["Serial_Number"];
        $cpu = $_POST["Cpu"];
        $memory = $_POST["Memory"];
        $storage = $_POST["Storage"];
        $screensize = $_POST["Screen_Size"];
        $resolution = $_POST["Resolution"];
        $person = $_POST["Person"];
        $location = $_POST["Location"];
        $license = $_POST["lic"];
        $purchasedate = $_POST["Purchase_Date"];
        $warranty= $_POST["wdate"];


        $sqlcommand = "update computer set givenID='$givenid', pcName='$pcname', model= '$model', type= '$type', sNum= '$serialNumber', 
            cpu='$cpu', memory= '$memory', storage= '$storage', screenSize= '$screensize', resolution= '$resolution', 
            person= '$person', location= '$location', license='$license', purchaseDate= '$purchasedate', warranty='$warranty',
            fatal= '$fatal', dead='$dead'
            where cID = '$cID';";
    
        mysqli_query($connection, $sqlcommand);
        header("Location: ../subpages/detail.php?cID=$cID");

    }
    elseif (isset($_POST["tabsubmit"])){

        $fatal = False;
        $dead = False;
        if (array_key_exists("fatal", $_POST)){
            $fatal = True;
        }
        if (array_key_exists("dead", $_POST)){
            $dead = True;
        }
        $tID = $_POST["tabsubmit"];
        $givenid = $_POST["GivenID"];
        $model = $_POST["Model"];
        $serialNumber = $_POST["Serial_Number"];
        $storage = $_POST["Storage"];
        $screensize = $_POST["Screen_Size"];
        $cap = $_POST["Capacity"];
        $purchasedate = $_POST["Purchase_Date"];
        $warranty= $_POST["wdate"];

        $sqlcommand = "update tablet set givenID='$givenid', model ='$model', sNum = '$serialNumber', 
            storage= '$storage', screenSize= '$screensize', capacity= '$cap', purchaseDate= '$purchasedate', warranty='$warranty',
            fatal= '$fatal', dead='$dead'
            where tID = '$tID';";
    
        mysqli_query($connection, $sqlcommand);
        header("Location: ../subpages/detail.php?tID=$tID");

    }
    elseif (isset($_POST["simsubmit"])){

        $fatal = False;
        $dead = False;
        if (array_key_exists("fatal", $_POST)){
            $fatal = True;
        }
        if (array_key_exists("dead", $_POST)){
            $dead = True;
        }
        $sID = $_POST["simsubmit"];
        $givenid = $_POST["GivenID"];
        $iccid = $_POST["ICCID"];
        $provider = $_POST["Provider"];
        $number = $_POST["Number"];
        $cost = $_POST["Cost"];
        $data = $_POST["Data"];
        $net = $_POST["Network"];
        $expiredate = $_POST["Expire_Date"];

        $sqlcommand = "update sim set givenID='$givenid', iccid='$iccid', provider ='$provider', number = '$number', 
            cost= '$cost', data= '$data', network= '$net', expireDate= '$expiredate',
            fatal= '$fatal', dead='$dead'
            where sID = '$sID';";
    
        mysqli_query($connection, $sqlcommand);
        header("Location: ../subpages/detail.php?sID=$sID");
    }
    elseif (isset($_POST["othersubmit"])){

        $fatal = False;
        $dead = False;
        if (array_key_exists("fatal", $_POST)){
            $fatal = True;
        }
        if (array_key_exists("dead", $_POST)){
            $dead = True;
        }
        $other_attr = array("GivenID","Model","Type","Connection", "Screen_Size","Resolution","Location","Purchase Date");
        $oID = $_POST["othersubmit"];
        $givenid = $_POST["GivenID"];
        $model = $_POST["Model"];
        $type = $_POST["Type"];
        $screensize = $_POST["Screen_Size"];
        $resolution = $_POST["Resolution"];
        $location = $_POST["Location"];
        $purchasedate = $_POST["Purchase_Date"];
        $warranty= $_POST["wdate"];

        $sqlcommand = "update other set givenID='$givenid', model= '$model', type= '$type', screenSize= '$screensize', 
            resolution= '$resolution', location= '$location', purchaseDate= '$purchasedate', warranty='$warranty',
            fatal= '$fatal', dead='$dead'
            where oID = '$oID';";

        mysqli_query($connection, $sqlcommand);
        header("Location: ../subpages/detail.php?oID=$oID");
    }