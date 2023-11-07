<?php include '../subpages/header.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">    
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

<link rel="stylesheet" href="../css/table.css">
<link rel="stylesheet" href="../css/taballoc.css">
</head>

<body>
    <?php if($_GET["value"] === "toissue"): 
    $today = date("Y-m-d")
    ?>
    <div class="container"> 
        <form action="../includes/taballoc.inc.php" method="POST" class="form-horizontal well">
        <fieldset>
            <legend>To allocate a Tablet</legend>  
                <div class="repeater-default">
                <label class="col-sm-3">Available Tablet ID</label>
                <label class="col-sm-3">Person</label>
                <label class="col-sm-3">Project ID</label>
                <label class="col-sm-2">Date issued</label>
                <label class="col-sm-1">Delete</label>
                    <div data-repeater-list="tab">
                        <div data-repeater-item="">
                            <div class="col-sm-3"> 
                                <select class="dropdown" name="tid", id="tid">
                                    <?php $resulttab=mysqli_query($connection, "select * from tablet where tID not in (select tID from taballoc where issued is TRUE);"); 
                                            while ($tabs= mysqli_fetch_assoc($resulttab)): ?>
                                            <option value="<?php echo $tabs["tID"]; ?>"><?php echo $tabs["givenID"]; ?>
                                            </option>
                                            <?php endwhile; 
                                            mysqli_close($connection);?>
                                </select>        
                            </div>
                            <div class="col-sm-3"> <input type="text" name="person" ></div>
                            <div class="col-sm-3"> <input type="text" name="projectID" ></div>
                            <div class="col-sm-2"> <input type="date" name="dateissue" value="<?php echo $today?>"></div>
          
                            <div class="col-sm-1">
                            <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                <span class="glyphicon glyphicon-remove"></span>
                            </span>
                            </div>            
                        </div>

                    </div>

                    <div class="col-sm-offset-0 col-sm-12">
                    <span data-repeater-create="" class="btn btn-info btn-md">
                        <span class="glyphicon glyphicon-plus"></span> Add
                    </span>
                    </div> 
                </div>

            <?php if (isset($_GET["error"]) and $_GET["error"] === "sametab"): ?>
                <div class="col-sm-offset-0 col-sm-12">
                    <div class="alert alert-danger">
                        <strong>Error!</strong> Same Tablets can not be issued at the same time!
                    </div>
                <div>
            <?php elseif (isset($_GET["error"]) and $_GET["error"] === "emptyinputs"): ?>
                <div class="col-sm-offset-0 col-sm-12">
                    <div class="alert alert-warning">
                        <strong>Error!</strong> Please provide all the information required!
                    </div>
                <div>
            <?php endif; ?>   
            
            <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] >= 9)):
                        if(mysqli_num_rows($resulttab) != 0):?>
                            <div class="col-sm-offset-5 col-sm-7">
                                <button class="savebtn" type="submit" name="issuesubmit" >Submit</button>
                            </div> 
                        <?php else: ?>
                            <div class="col-sm-offset-5 col-sm-7">
                                <button class="savebtn" type="submit" name="issuesubmit" disabled>No Available Tablet</button>
                            </div> 
                        <?php endif;?>
            <?php else: ?>
                <div class="col-sm-offset-5 col-sm-7">
                    <p>You do not have authorization to allocate a tablet</p>
                </div> 
            <?php endif;?>

        </fieldset>
        </form> 
    </div>
    
    <?php elseif($_GET["value"] === "toreturn"):
        $today = date("Y-m-d")?>
        <div class="container"> 
        <form action="../includes/taballoc.inc.php" method="POST" class="form-horizontal well" id="returnform" >
            <fieldset>
                <legend>Return Tablets</legend>
                <div class="repeater-default">
                    <label class="col-sm-2">Issued Tablet ID</label>
                    <label class="col-sm-2">Person</label>
                    <label class="col-sm-2">Project ID</label>
                    <label class="col-sm-2">Date returned</label>
                    <label class="col-sm-1">Returned</label>
                    <label class="col-sm-3">Comments</label>

                    <?php $resulttab=mysqli_query($connection, "select * from taballoc inner join tablet on taballoc.tID= tablet.tID where issued = True;"); while ($tabs = mysqli_fetch_assoc($resulttab)): ?>
                        <input type="hidden" name="taID[]" value="<?php echo $tabs['taID']; ?>">
                        <div class="col-sm-2"> <?php echo $tabs["givenID"]; ?></div>
                        <div class="col-sm-2"> <?php echo $tabs["person"]; ?></div>
                        <div class="col-sm-2"> <?php echo $tabs["projectID"]; ?></div>
                        <div class="col-sm-2"> <input type="date" name="datereturn[]" value="<?php echo $today?>" ></div>
                        <div class="col-sm-1"> <input type="checkbox" name="checkbox[<?php echo $tabs['taID']; ?>]"></div>
                        <div class="col-sm-3"> <input type="text" name="comments[]" ></div>
                    <?php endwhile; 
                    mysqli_close($connection);?>
                </div>

                <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] >= 9)):?>
                    <div class="col-sm-offset-5 col-sm-7">
                        <input type="submit" value="Save" name="returnsubmit" class="btn btn-primary btn-lg">
                    </div>
                <?php else:?>
                    <div class="col-sm-offset-5 col-sm-7">
                        <p>You do not have authorization to return a tablet</p>
                    </div> 
                <?php endif;?>

            </fieldset>
        </form>
        </div>

    <?php elseif($_GET["value"] === "history"): ?>
        
        <h1 style="text-align: center;">TABLET ISSUE HISTORY:</h1><br>

        <div class="container"> 
        <table class="table table-hover" id="datatable">
            <thead>
            <tr>
                <th>Tablet ID</th>
                <th>Person</th>          
                <th>Date issued</th>
                <th>Returned</th>
                <th>Date returned</th>
                <th>Project ID</th>
                <th>Comment</th>
            </tr>
            </thead>
            <tbody>
            <?php 
                $result=mysqli_query($connection, "select * from taballoc left join tablet on taballoc.tID=tablet.tID");
                while ($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>" . $row["givenID"] . "</td>";
                    echo "<td>" . $row["person"] . "</td>";
                    echo "<td>" . $row["dateIssue"] . "</td>";
                    if ($row["issued"] == True){
                        echo "<td>No</td>";
                    }
                    else{
                        echo "<td>Yes</td>";
                    }
                    echo "<td>" . $row["dateReturn"] . "</td>";
                    echo "<td>" . $row["projectID"] . "</td>";
                    echo "<td>" . $row["comment"] . "</td>";
                    echo "</tr>";
                }
                mysqli_close($connection);
            ?>
            </tbody>
        </table>
        </div>

    <?php endif; ?>
    
</body>
<script src='../js/jquery.repeater.js'></script>
<script src='../js/jquery.datatable.js'></script>
</html>