<?php include '../subpages/header.php'; ?>
<link rel="stylesheet" href="../css/simalloc.css">
<link rel="stylesheet" href="../css/table.css">

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">    
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>


</head>

<body>

    <h1 style="text-align: center;">SIM CARD ALLOCATION DETAILS:</h1><br>

    <div class="container">
    <form action="../includes/simalloc.inc.php" method="POST" id="simform">
        <table class="table table-hover" id="datatable">
            <thead>
            <tr>
                <th>Given ID</th>  
                <th>Provider</th>          
                <th>Number</th>
                <th>Network</th>
                <th>To allocate a Tablet</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                    $result=mysqli_query($connection, "select * from sim;");
                    while ($sims = mysqli_fetch_assoc($result)): ?>
                        <tr>
                        <td><?php echo $sims["givenID"] ?></td>
                        <td><?php echo $sims["provider"] ?></td>
                        <td><a href="../subpages/detail.php?sID=<?php echo $sims["sID"] ?>"><?php echo $sims["number"] ?></a></td>
                        <td><?php echo $sims["network"] ?></td>
                        <td>
                        <select class="dropdown_sim" name="<?php echo $sims["sID"]?>" id = "<?php echo $sims["sID"]?>" ">
                            <option value="Null">
                            <?php $resulttab=mysqli_query($connection, "SELECT computer.cID AS ID, computer.givenID AS givenID, NULL AS capacity, 'laptop' AS type FROM computer WHERE computer.type = 'laptop' 
                                                                        UNION SELECT tablet.tID AS ID, tablet.givenID AS givenID, tablet.capacity AS capacity,'tablet' AS type FROM tablet;"
                            ); while ($devices = mysqli_fetch_assoc($resulttab)): ?>
                            <?php 
                            $isSelected = "{$sims["dID"]} {$sims["deviceType"]}" == "{$devices["ID"]} {$devices["type"]}";
                            $value = "{$devices["ID"]} {$devices["type"]}";
                            if ($devices["type"] == "tablet") {
                                $display = "{$devices["givenID"]} Capacity: {$devices["capacity"]}";    
                            } else if ($devices["type"] == "laptop") {        
                                $display = $devices["givenID"];
                            } else {  
                                continue;     
                            }
                            ?>    
                            <option <?php echo $isSelected ? 'selected' : ''; ?> value="<?php echo $value; ?>">       
                                <?php echo $display; ?>
                            </option>
                        <?php endwhile; ?>
                        </select>
                        </td>
                        </tr>
                    <?php endwhile; 
                    mysqli_close($connection);?>
            </tbody>
        </table>
        <div class="bcontainer">
            <button class="btn btn-sim" type="submit" name="page" form="simform">Save all</button>
        </div>
        </form>
    </div>
    
</body>
<script src='../js/jquery.datatable.js'></script>
</html>