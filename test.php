<?php
    $servername = "localhost";
    $username = "taverner2_assets_updater";
    $password = "6R&XQT_etzQff%KyUN}5z#)I_R}h96cZGWJ5";
    $dbname = "taverner2_assets";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
?>