<?php include '../subpages/header.php'; ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">    
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<link rel="stylesheet" href="../css/table.css">
</head>

<body>
    <h1 style="text-align: center;">SIM CARD DETAILS:</h1><br>

    <div class="container"> 
        <table class="table table-hover", id="datatable">
            <thead>
            <tr>
                <th>Info</th>
                <th>Given ID</th>
                <th>ICCID</th>
                <th>Provider</th>          
                <th>Number</th>
                <th>Cost</th>
                <th>Data</th>
                <th>Network</th>
                <th>Expire Date</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                    $result=mysqli_query($connection, "select * from sim;");
                    while ($row = mysqli_fetch_assoc($result)){
                        $sID = $row["sID"];
                        echo "<tr>";
                        echo "<td><a href=\"../subpages/detail.php?sID=$sID\"><span class='glyphicon glyphicon-search' aria-hidden='true'></span></a></td>";
                        echo "<td>" . $row["givenID"] . "</td>";
                        echo "<td>" . $row["iccid"] . "</td>";
                        echo "<td>" . $row["provider"] . "</td>";
                        echo "<td>" . $row["number"] . "</td>";
                        echo "<td>" . $row["cost"] . "</td>";
                        echo "<td>" . $row["data"] . "</td>";
                        echo "<td>" . $row["network"] . "</td>";
                        echo "<td>" . $row["expireDate"] . "</td>";
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