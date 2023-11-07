<?php session_start();?>
<?php $root = $_SERVER['DOCUMENT_ROOT']; include_once "$root/includes/database.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taverner asset tracking</title>
    <link rel="stylesheet" href="../css/headerstyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/session.inc.php');?>
    
    <nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <img class="img-logo" src="../logo.png">
    </div>
        <ul class="nav navbar-nav">
            <li><a href="../index.php">HOME</a></li>
            <li><a href="../subpages/pc.php">PC/LAPTOP</a></li>
            <li><a href="../subpages/tab.php">TABLET</a></li>
            <li><a href="../subpages/sim.php">SIM</a></li>
            <li><a href="../subpages/other.php">OTHER</a></li>
            <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] >= 9)):?>
                <li><a href="../subpages/simalloc.php">SIM ALLOC</a></li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">TAB ALLOC<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <li><a href="../subpages/taballoc.php?value=toissue">ALLOCATE A TABLET</a></li>
                    <li><a href="../subpages/taballoc.php?value=toreturn">RETURN A TABLET</a></li>
                    <li><a href="../subpages/taballoc.php?value=history">ALLOCATION HISTORY</a></li>
                    </ul>
                </li>
            <?php endif; ?>
            <!--<li><a href="../subpages/test.php">Test</a></li>-->
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php
                if(isset($_SESSION["uID"])){
                    $uID = $_SESSION["uID"];
                    $name = $_SESSION["accountname"];
                    if($_SESSION["level"] >= 9){
                        echo "<li><a href='../subpages/upload.php'><span class='glyphicon glyphicon-upload'></span> Upload New</a></li>";
                    }
                    echo "<li><a><span class='glyphicon glyphicon-user'></span> $name</a></li>";
                    echo "<li><a href='../includes/logout.php'><span class='glyphicon glyphicon-log-in'></span> Logout</a></li>";
                }
                else{
                    echo "<li><a href='../subpages/register.php'><span class='glyphicon glyphicon-user'></span> Register</a></li>";
                    echo "<li><a href='../subpages/login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
                }
            ?>
        </ul>
    </div>
    </nav> 