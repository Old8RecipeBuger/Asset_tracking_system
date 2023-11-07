<?php include "subpages/header.php"; ?>
<link rel="stylesheet" href="css/index.css">
</head>

<body>
    
    <h1 style="text-align: center;">Summary:</h1><br>
    
    <?php 
        //computer information
        $computers = mysqli_query($connection, "select count(cID) as cID from computer");
        $cresult=mysqli_fetch_assoc($computers);
        $total_computer =$cresult['cID']; 

        $computers_sydney = mysqli_query($connection, "select count(cID) as cIDs from computer where location = 'Sydney - Surry Hills' ");
        $cresult=mysqli_fetch_assoc($computers_sydney);
        $total_computer_sydney =$cresult['cIDs']; 

        $computers_wol = mysqli_query($connection, "select count(cID) as cIDw from computer where location = 'Wollongong' ");
        $cresult=mysqli_fetch_assoc($computers_wol);
        $total_computer_wol =$cresult['cIDw']; 

        $computers_co = mysqli_query($connection, "select count(cID) as cIDc from computer where location = 'Coffs Harbour' ");
        $cresult=mysqli_fetch_assoc($computers_co);
        $total_computer_co =$cresult['cIDc']; 

        $computers_other = mysqli_query($connection, "select count(cID) as cIDo from computer where location = 'Other' ");
        $cresult=mysqli_fetch_assoc($computers_other);
        $total_computer_other =$cresult['cIDo']; 

        //tablet information
        $tablets = mysqli_query($connection, "select count(tID) as tID from tablet");
        $tresult=mysqli_fetch_assoc($tablets);
        $total_tablets =$tresult['tID']; 

        $tablets_issue = mysqli_query($connection, "select count(tID) as tIDa from taballoc where issued = '1' ");
        $tresult=mysqli_fetch_assoc($tablets_issue);
        $total_tablets_issue =$tresult['tIDa']; 

        //sim information
        $sims = mysqli_query($connection, "select count(sID) as sID from sim");
        $sresult=mysqli_fetch_assoc($sims);
        $total_sims =$sresult['sID']; 

        $sims_avai = mysqli_query($connection, "select count(sID) as sIDa from sim where dID != 'Null' ");
        $sresult=mysqli_fetch_assoc($sims_avai);
        $total_sims_avai =$sresult['sIDa']; 

        $sims_unavai = mysqli_query($connection, "select count(sID) as sIDua from sim where dID = 'Null' ");
        $sresult=mysqli_fetch_assoc($sims_unavai);
        $total_sims_unavai =$sresult['sIDua']; 

        $cost = mysqli_query($connection, "select sum(cost) as cost from sim");
        $costs=mysqli_fetch_assoc($cost);
        $total_cost=$costs['cost'];


        //other information
        $other = mysqli_query($connection, "select count(oID) as oID from other");
        $oresult=mysqli_fetch_assoc($other);
        $total_others =$oresult['oID']; 

        
        $other_type = mysqli_query($connection, "select type, count(*) from other group by type ORDER BY COUNT(*) DESC LIMIT 5;");
    ?>

    <div class="container"> 
        <div class="row">
            <div class="col-sm-6">
            <h1>PC/LAPTOP:</h1>
            <p>There is a total of <?php echo $total_computer?> computers.</p>
            <h5><?php echo $total_computer_sydney?> located in Sydney - Surry Hills</h5>
            <h5><?php echo $total_computer_wol?> located in Wollongong</h5>
            <h5><?php echo $total_computer_co?> located in Coffs Harbour</h5>
            <h5><?php echo $total_computer_other?> located in Other</h5>
            </div>
            <div class="col-sm-6">
            <h1>OTHER DEVICES:</h1>
            <p>There is a total of <?php echo $total_others?> other devices.</p>
            <?php
            while($oresult_t=mysqli_fetch_assoc($other_type)){
                echo "<h5>" . $oresult_t['count(*)'].' '.$oresult_t['type'] . "</h5>";
            }
            ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
            <h1>TABLET:</h1>
            <p>There is a total of <?php echo $total_tablets?> tablets.</p>
            <h5><?php echo $total_tablets_issue?> tablets are issued</h5>
            <h5><?php echo $total_tablets -$total_tablets_issue?> tablets are available at the moment</h5>
            </div>
            <div class="col-sm-6">
            <h1>SIM:</h1>
            <p>There is a total of <?php echo $total_sims?> sim cards.</p>
            <h5><?php echo $total_sims_avai?> sims are issued</h5>
            <h5><?php echo $total_sims_unavai?> sims are available at the moment</h5>
            <h5>$<?php echo $total_cost?> are spend on sim cards in total</h5>
            </div>
        </div>
    </div>

</body>
</html>