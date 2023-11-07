<?php include '../subpages/header.php'; ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">    
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<link rel="stylesheet" href="../css/table.css">
</head>

<body>
    <h1 style="text-align: center;">OTHER DEVICES DETAILS:</h1><br>

    <div class="container"> 
        <table class="table table-hover" id="datatable">
            <thead>
            <tr>
                <th>Info</th>
                <th>GivenID</th>
                <th>Model</th>          
                <th>Type</th>
                <th>Connection</th>
                <th>Screen Size</th>
                <th>Resolution</th>
                <th>Location</th>
                <th>Purchase Date</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $result=mysqli_query($connection, "select * from other;");
                    while ($row = mysqli_fetch_assoc($result)){
                        $oID = $row["oID"];
                        $connection_str = '';
                        if($row["cHDMI"]){$connection_str.="HTML, ";} if($row["cDP"]){$connection_str.="DP, ";}
                        if($row["cVGA"]){$connection_str.="VGA, ";} if($row["cDVI"]){$connection_str.="DVI, ";} 
                        if($row["cUSBC"]){$connection_str.="UBS-C, ";}
                        echo "<tr>";
                        echo "<td><a href=\"../subpages/detail.php?oID=$oID\"><span class='glyphicon glyphicon-search' aria-hidden='true'></span></a></td>";
                        echo "<td>" . $row["givenID"] . "</td>";
                        echo "<td>" . $row["model"] . "</td>";
                        echo "<td>" . $row["type"] . "</td>";
                        echo "<td>"  . $connection_str . "</td>";
                        echo "<td>" . $row["screenSize"] . "\"" . "</td>";
                        echo "<td>" . $row["resolution"] . "</td>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "<td>" . $row["purchaseDate"] . "</td>";
                        echo "</tr>";
                    }
                    mysqli_close($connection);
                ?>
            </tbody>
        </table>
    </div>
    
</body>
<script src='../js/jquery.datatable.js'></script>
</html>