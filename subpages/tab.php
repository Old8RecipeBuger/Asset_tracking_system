<?php include '../subpages/header.php'; ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">    
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<link rel="stylesheet" href="../css/table.css">
</head>

<body>
    <h1 style="text-align: center;">TABLET DETAILS:</h1><br>

    <div class="container"> 
        <table class="table table-hover" id="datatable">
            <thead>
            <tr>
                <th>Info</th>
                <th>GivenID</th>
                <th>Model</th>          
                <th>Storage</th>
                <th>Screen Size</th>
                <th>Capacity</th>
                <th>Purchase Date</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $result=mysqli_query($connection, "select * from tablet;");
                    while ($row = mysqli_fetch_assoc($result)){
                        $tID = $row["tID"];
                        echo "<tr>";
                        echo "<td><a href=\"../subpages/detail.php?tID=$tID\"><span class='glyphicon glyphicon-search' aria-hidden='true'></span></a></td>";
                        echo "<td>" . $row["givenID"] . "</td>";
                        echo "<td>" . $row["model"] . "</td>";
                        echo "<td>" . $row["storage"] . "</td>";
                        echo "<td>" . $row["screenSize"] . "\"" . "</td>";
                        echo "<td>" . $row["capacity"] . "</td>";
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