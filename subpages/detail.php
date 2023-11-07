<?php include '../subpages/header.php'; ?>
<link rel="stylesheet" href="../css/detail.css">
</head>

<body>
    <?php if (isset($_GET["cID"])):?>
    <div class="container">
        <h1>Review and change details here</h1>
        <table class="table">
            <tbody>
            <form action="../includes/changedetail.php" method="POST" id="computerform">
                <?php
                $cIDdetail = $_GET["cID"];
                $result=mysqli_query($connection, "SELECT * FROM computer WHERE cID=$cIDdetail;");
                $row = mysqli_fetch_assoc($result);
                ?>
                <tr>
                    <th>Given ID</th>
                    <td><input type="text" value="<?php echo $row["givenID"]; ?>" name="GivenID" disabled></td>
                </tr>
                <tr>
                    <th>PC Name</th>
                    <td><input type="text" value="<?php echo $row["pcName"]; ?>" name="pcName" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?>></td>
                </tr>
                <tr>
                    <th>Model</th>
                    <td><input type="text" value="<?php echo $row["model"]; ?>" name="Model" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?>></td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td>
                    <select name="Type" value="<?php echo $row["type"]; ?>" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> >
                        <option <?php if($row["type"] == 'PC'){echo "selected";}?> value="PC">PC</option>
                        <option <?php if($row["type"] == 'Laptop'){echo "selected";}?> value="Laptop">Laptop</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <th>Serial Number</th>
                    <td><input type="text" value="<?php echo $row["sNum"]; ?>" name="Serial_Number" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> ></td>
                </tr>
                <tr>
                    <th>CPU</th>
                    <td><input type="text" value="<?php echo $row["cpu"]; ?>" name="Cpu" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> ></td>
                </tr>
                <tr>
                    <th>Memory</th>
                    <td>
                    <select name="Memory" value="<?php echo $row["memory"]; ?>" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> >
                        <option <?php if($row["memory"] == '2GB'){echo "selected";}?> value="2GB">2GB</option>
                        <option <?php if($row["memory"] == '4GB'){echo "selected";}?> value="4GB">4GB</option>
                        <option <?php if($row["memory"] == '8GB'){echo "selected";}?> value="4GB">8GB</option>
                        <option <?php if($row["memory"] == '16GB'){echo "selected";}?> value="16GB">16GB</option>
                        <option <?php if($row["memory"] == '32GB'){echo "selected";}?> value="32GB">32GB</option>
                        <option <?php if($row["memory"] == '64GB and more'){echo "selected";}?> value="64GB and more">64GB and more</option>
                        <option <?php if($row["memory"] == 'Other'){echo "selected";}?> value="Other">Other</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <th>Storage</th>
                    <td>
                    <select name="Storage" value="<?php echo $row["storage"]; ?>" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> >
                        <option <?php if($row["storage"] == '128GB and less'){echo "selected";}?> value="128GB and less">128GB and less</option>
                        <option <?php if($row["storage"] == '256GB'){echo "selected";}?> value="256GB">256GB</option>
                        <option <?php if($row["storage"] == '512GB'){echo "selected";}?> value="512GB">512GB</option>
                        <option <?php if($row["storage"] == '1TB and more'){echo "selected";}?> value="1TB and more">1TB and more</option>
                        <option <?php if($row["storage"] == 'Other'){echo "selected";}?> value="Other">Other</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <th>Screen Size (Inch)</th>
                    <td><input type="text" value="<?php echo $row["screenSize"]; ?>" name="Screen_Size" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> ></td>
                </tr>
                <tr>
                    <th>Resolution</th>
                    <td>
                    <select name="Resolution" value="<?php echo $row["resolution"]; ?>" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> >
                    <option <?php if($row["resolution"] == 'Under 720P (HD)'){echo "selected";}?> value="Under 720P (HD)">Under 720P (HD)</option>
                    <option <?php if($row["resolution"] == '720P (HD)'){echo "selected";}?> value="720P (HD)">720P (HD)</option>
                    <option <?php if($row["resolution"] == '1080P (FHD)'){echo "selected";}?> value="1080P (FHD)">1080P (FHD)</option>
                    <option <?php if($row["resolution"] == '2160P (QHD)'){echo "selected";}?> value="2160P (QHD)">2160P (QHD)</option>
                    <option <?php if($row["resolution"] == 'Over 2160P (QHD)'){echo "selected";}?> value="Over 2160P (QHD)">Over 2160P (QHD)</option>
                    <option <?php if($row["resolution"] == 'Other'){echo "selected";}?> value="Other">Other</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <th>Person</th>
                    <td><input type="text" value="<?php echo $row["person"]; ?>" name="Person" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> ></td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td>
                    <select name="Location" value="<?php echo $row["location"]; ?>" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> >
                        <option <?php if($row["location"] == 'Sydney - Surry Hills'){echo "selected";}?> value="Sydney - Surry Hills">Sydney - Surry Hills</option>
                        <option <?php if($row["location"] == 'Coffs Harbour'){echo "selected";}?> value="Coffs Harbour">Coffs Harbour</option>
                        <option <?php if($row["location"] == 'Wollongong'){echo "selected";}?> value="Wollongong">Wollongong</option>
                        <option <?php if($row["location"] == 'Other'){echo "selected";}?> value="Other">Other</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <th>License</th>
                    <td><input type="text" value="<?php echo $row["license"]; ?>" name="lic" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> ></td>
                </tr>
                <tr>
                    <th>Purchase Date</th>
                    <td><input type="date" value="<?php echo $row["purchaseDate"]; ?>" name="Purchase_Date" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> ></td>
                </tr>
                <tr>
                    <th>Warranty</th>
                    <td><input type="date" value="<?php echo $row["warranty"]; ?>" name="wdate" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> ></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><input type="checkbox" id="fatal" name="fatal" value="fatal" <?php echo ($row["fatal"]) ? "checked" : '' ?> <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?>>
                    <label for="fatal">Fatal</label>
                    <span></span>
                    <input type="checkbox" id="dead" name="dead" value="dead" <?php echo ($row["dead"]) ? "checked" : '' ?> <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?>>
                    <label for="dead">Dead</label>
                    </td>
                </tr>
            </form>
            </tbody>
        </table>

        <div class="bcontainer">
            <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] >= 9)):?>
                <button type="submit" name="computersubmit" value="<?php echo $_GET["cID"];?>" class="btn" form="computerform">Save changes</button>
            <?php endif;?>
        </div>

        <?php if(isset($_SESSION["uID"])): 
            date_default_timezone_set('Australia/Sydney');
            $date = date('d-m-y h:i:s'); ?> 
            <form action="../includes/comment.inc.php" method="POST" id="compcform">
                <div class="form-group">
                    <label for="comment">Post a comment:</label> 
                    <button type="submit" name="compcsubmit" form="compcform" >Post</button>
                    <input type="text" class="form-control" name="comment">
                    <input type="hidden" class="form-control" name="dID" value="<?php echo $cIDdetail?>">
                    <input type="hidden" class="form-control" name="uID" value="<?php echo $uID?>">
                    <input type="hidden" class="form-control" name="date" value="<?php echo $date?>">
                    <input type="hidden" class="form-control" name="deviceType" value="computer">
                </div>
            </form>
        <?php else:?>
            <div><a href="../subpages/login.php">Login</a> to post a comment</div>
        <?php endif;?>

        <table class="table">
        <tbody>
        <form action="../includes/comment.inc.php" method="POST" id="deletecomment">
        <?php $comments=mysqli_query($connection, "SELECT * FROM comment INNER JOIN account ON comment.uID=account.uID WHERE dID=$cIDdetail And deviceType='computer';");
        if ($comments->num_rows !== 0): ?>
                <tr>
                    <td>Comment:</td>
                    <td>Post on:</td>
                    <td>By:</td>
                </tr>
            <?php
            while ($comments_assoc = mysqli_fetch_assoc($comments)):
            ?>
            <tr>
                <td><?php echo $comments_assoc["content"]?></td>
                <td><?php echo $comments_assoc["date"]?></td>
                <td><?php echo $comments_assoc["accountname"]?></td>
                <?php if(isset($_SESSION["uID"])): 
                        if($comments_assoc["uID"] == $_SESSION["uID"]):?>
                            <input type="hidden" class="form-control" name="deviceType" value="computer">
                            <input type="hidden" class="form-control" name="dID" value="<?php echo $cIDdetail?>">
                            <td><button type="submit" name="deletecomment" value="<?php echo $comments_assoc["ctID"];?>">Delete</button></td>
                        <?php else:?>
                            <td><button type="glyphicon glyphicon-remove" disabled hidden>Delete</button></td>
                        <?php endif;?>
                <?php else:?>
                <td></td>    
                <?php endif;?>
            </tr>
            <?php endwhile; ?>
        <?php endif;?>
        </form>
        </tbody>
        </table>
    </div>

    <?php elseif (isset($_GET["tID"])):?>
    <div class="container">
        <h1>Review and change details here</h1>
        <table class="table">
            <tbody>
            <form action="../includes/changedetail.php" method="POST" id="tabform">
                <?php
                    $tIDdetail = $_GET["tID"];
                    $result=mysqli_query($connection, "SELECT * FROM tablet WHERE tablet.tID=$tIDdetail;");
                    $row = mysqli_fetch_assoc($result);
                ?>
                <tr>
                    <th>Given ID</th>
                    <td><input type="text" value="<?php echo $row["givenID"]; ?>" name="GivenID" disabled></td>
                </tr>
                <tr>
                    <th>Model</th>
                    <td><input type="text" value="<?php echo $row["model"]; ?>" name="Model" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> ></td>
                </tr>
                <tr>
                    <th>Serial Number</th>
                    <td><input type="text" value="<?php echo $row["sNum"]; ?>" name="Serial_Number" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> ></td>
                </tr>
                <tr>
                    <th>Storage</th>
                    <td>
                    <select name="Storage" value="<?php echo $row["storage"]; ?>" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> >
                        <option <?php if($row["storage"] == '8GB'){echo "selected";}?> value="8GB">8GB</option>
                        <option <?php if($row["storage"] == '16GB'){echo "selected";}?> value="16GB">16GB</option>
                        <option <?php if($row["storage"] == '32GB'){echo "selected";}?> value="32GB">32GB</option>
                        <option <?php if($row["storage"] == '64GB'){echo "selected";}?> value="64GB">64GB</option>
                        <option <?php if($row["storage"] == '128GB'){echo "selected";}?> value="128GB">128GB</option>
                        <option <?php if($row["storage"] == '256GB'){echo "selected";}?> value="256GB">256GB</option>
                        <option <?php if($row["storage"] == '512GB'){echo "selected";}?> value="512GB">512GB</option>
                        <option <?php if($row["storage"] == '1TB and more'){echo "selected";}?> value="1TB and more">1TB and more</option>
                        <option <?php if($row["storage"] == 'Other'){echo "selected";}?> value="Other">Other</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <th>Screen Size (Inch)</th>
                    <td><input type="text" value="<?php echo $row["screenSize"]; ?>" name="Screen_Size" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> ></td>
                </tr>
                <tr>
                    <th>Capacity</th>
                    <td>
                    <select name="Capacity" id="net" value="<?php echo $row["capacity"]; ?>" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> >
                        <option <?php if($row["capacity"] == '3G'){echo "selected";}?> value="3G">3G</option>
                        <option <?php if($row["capacity"] == '4G'){echo "selected";}?> value="4G">4G</option>
                        <option <?php if($row["capacity"] == '5G'){echo "selected";}?> value="5G">5G</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <th>Purchase Date</th>
                    <td><input type="date" value="<?php echo $row["purchaseDate"]; ?>" name="Purchase_Date" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?>></td>
                </tr>
                <tr>
                    <th>Warranty</th>
                    <td><input type="date" value="<?php echo $row["warranty"]; ?>" name="wdate" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> ></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><input type="checkbox" id="fatal" name="fatal" value="fatal" <?php echo ($row["fatal"]) ? "checked" : '' ?> <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> >
                    <label for="fatal">Fatal</label>
                    <span></span>
                    <input type="checkbox" id="dead" name="dead" value="dead" <?php echo ($row["dead"]) ? "checked" : '' ?> <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?>>
                    <label for="dead">Dead</label>
                    </td>
                </tr>
            </form>
                <tr>
                    <th>Active Number</th>
                    <td>
                    <?php //$result=mysqli_query($connection, "SELECT * FROM tablet inner JOIN sim using (tID) WHERE tablet.tID=$tIDdetail;");
                        $result=mysqli_query($connection, "SELECT * FROM tablet inner JOIN sim ON sim.dID = tablet.tID WHERE tablet.tID=$tIDdetail and sim.deviceType='tablet';");
                        while ($row = mysqli_fetch_assoc($result)){
                            $sid = $row["sID"];
                            $num = $row["number"];
                            echo "<a href='../subpages/detail.php?sID=$sid'>$num</a><br>";
                        }
                    ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="bcontainer">
            <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] >= 9)):?>
                <button type="submit" name="tabsubmit" value="<?php echo $_GET["tID"];?>" class="btn" form="tabform">Save changes</button>
            <?php endif;?>
        </div>
    
        <?php if(isset($_SESSION["uID"])): 
            date_default_timezone_set('Australia/Sydney');
            $date = date('d-m-y h:i:s'); ?> 
            <form action="../includes/comment.inc.php" method="POST" id="tabcform">
                <div class="form-group">
                    <label for="comment">Post a comment:</label> 
                    <button type="submit" name="tabcsubmit" form="tabcform" >Post</button>
                    <input type="text" class="form-control" name="comment">
                    <input type="hidden" class="form-control" name="dID" value="<?php echo $tIDdetail?>">
                    <input type="hidden" class="form-control" name="uID" value="<?php echo $uID?>">
                    <input type="hidden" class="form-control" name="date" value="<?php echo $date?>">
                    <input type="hidden" class="form-control" name="deviceType" value="tablet">
                </div>
            </form>
        <?php else:?>
            <div><a href="../subpages/login.php">Login</a> to post a comment</div>
        <?php endif;?>

        <table class="table">
        <tbody>
        <form action="../includes/comment.inc.php" method="POST" id="deletecomment">
            <?php
            $comments=mysqli_query($connection, "SELECT * FROM comment INNER JOIN account ON comment.uID=account.uID WHERE dID=$tIDdetail And deviceType='tablet';");
            if ($comments->num_rows !== 0): ?>
            <tr>
                <td>Comment:</td>
                <td>Post on:</td>
                <td>By:</td>
            </tr>
            <?php
            while ($comments_assoc = mysqli_fetch_assoc($comments)):
            ?>
            <tr>
                <td><?php echo $comments_assoc["content"]?></td>
                <td><?php echo $comments_assoc["date"]?></td>
                <td><?php echo $comments_assoc["accountname"]?></td>
                <?php if(isset($_SESSION["uID"])): 
                        if($comments_assoc["uID"] == $_SESSION["uID"]):?>
                            <input type="hidden" class="form-control" name="deviceType" value="tablet">
                            <input type="hidden" class="form-control" name="dID" value="<?php echo $tIDdetail?>">
                            <td><button type="submit" name="deletecomment" value="<?php echo $comments_assoc["ctID"];?>">Delete</button></td>
                        <?php else:?>
                            <td><button type="glyphicon glyphicon-remove" disabled hidden>Delete</button></td>
                        <?php endif;?>
                <?php else:?>
                <td></td>    
                <?php endif;?>
            </tr>
            <?php endwhile; ?>
        <?php endif;?>
        </form>
        </tbody>
        </table>
    </div>

    <?php elseif (isset($_GET["sID"])):?>
    <div class="container">
        <h1>Review and change details here</h1>
        <table class="table">
            <tbody>
            <form action="../includes/changedetail.php" method="POST" id="simform">
                <?php
                $sIDdetail = $_GET["sID"];
                $result=mysqli_query($connection, "SELECT * FROM sim WHERE sID=$sIDdetail;");
                $row = mysqli_fetch_assoc($result);
                ?>
                <tr>
                    <th>Given ID</th>
                    <td><input type="text" value="<?php echo $row["givenID"]; ?>" name="GivenID" disabled></td>
                </tr>
                <tr>
                    <th>ICCID</th>
                    <td><input type="text" value="<?php echo $row["iccid"]; ?>" name="ICCID" disabled></td>
                </tr>
                <tr>
                    <th>Provider</th>
                    <td><input type="text" value="<?php echo $row["provider"]; ?>" name="Provider" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> ></td>
                </tr>
                <tr>
                    <th>Number</th>
                    <td><input type="text" value="<?php echo $row["number"]; ?>" name="Number" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> ></td>
                </tr>
                <tr>
                    <th>Cost</th>
                    <td><input type="text" value="<?php echo $row["cost"]; ?>" name="Cost" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> ></td>
                </tr>
                <tr>
                    <th>Data</th>
                    <td><input type="text" value="<?php echo $row["data"]; ?>" name="Data" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> ></td>
                </tr>
                <tr>
                    <th>Network</th>
                    <td>
                    <select name="Network" id="net" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> >
                        <option <?php if($row["network"] == '3G'){echo "selected";}?> value="3G">3G</option>
                        <option <?php if($row["network"] == '4G'){echo "selected";}?> value="4G">4G</option>
                        <option <?php if($row["network"] == '5G'){echo "selected";}?> value="5G">5G</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <th>Expire Date</th>
                    <td><input type="date" value="<?php echo $row["expireDate"]; ?>" name="Expire_Date" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> ></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><input type="checkbox" id="fatal" name="fatal" value="fatal" <?php echo ($row["fatal"]) ? "checked" : '' ?> <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> >
                    <label for="fatal">Fatal</label>
                    <span></span>
                    <input type="checkbox" id="dead" name="dead" value="dead" <?php echo ($row["dead"]) ? "checked" : '' ?> <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?>>
                    <label for="dead">Dead</label>
                    </td>
                </tr>
            </form>
            </tbody>
        </table>

        <div class="bcontainer">
            <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] >= 9)):?>
                <button type="submit" name="simsubmit" value="<?php echo $_GET["sID"];?>" class="btn" form="simform">Save changes</button>
            <?php endif;?>
        </div>

        <?php if(isset($_SESSION["uID"])): 
            date_default_timezone_set('Australia/Sydney');
            $date = date('d-m-y h:i:s'); ?> 
            <form action="../includes/comment.inc.php" method="POST" id="simcform">
                <div class="form-group">
                    <label for="comment">Post a comment:</label> 
                    <button type="submit" name="simcsubmit" form="simcform" >Post</button>
                    <input type="text" class="form-control" name="comment">
                    <input type="hidden" class="form-control" name="dID" value="<?php echo $sIDdetail?>">
                    <input type="hidden" class="form-control" name="uID" value="<?php echo $uID?>">
                    <input type="hidden" class="form-control" name="date" value="<?php echo $date?>">
                    <input type="hidden" class="form-control" name="deviceType" value="sim">
                </div>
            </form>
        <?php else:?>
            <div><a href="../subpages/login.php">Login</a> to post a comment</div>
        <?php endif;?>

        <table class="table">
        <tbody>
        <form action="../includes/comment.inc.php" method="POST" id="deletecomment">
        <?php $comments=mysqli_query($connection, "SELECT * FROM comment INNER JOIN account ON comment.uID=account.uID WHERE dID=$sIDdetail AND deviceType='sim';");
        if ($comments->num_rows !== 0): ?>
            <tr>
                <td>Comment:</td>
                <td>Post on:</td>
                <td>By:</td>
            </tr>
            <?php
            while ($comments_assoc = mysqli_fetch_assoc($comments)):
            ?>
            <tr>
                <td><?php echo $comments_assoc["content"]?></td>
                <td><?php echo $comments_assoc["date"]?></td>
                <td><?php echo $comments_assoc["accountname"]?></td>
                <?php if(isset($_SESSION["uID"])): 
                        if($comments_assoc["uID"] == $_SESSION["uID"]):?>
                            <input type="hidden" class="form-control" name="deviceType" value="sim">
                            <input type="hidden" class="form-control" name="dID" value="<?php echo $sIDdetail?>">
                            <td><button type="submit" name="deletecomment" value="<?php echo $comments_assoc["ctID"];?>">Delete</button></td>
                        <?php else:?>
                            <td><button type="glyphicon glyphicon-remove" disabled hidden>Delete</button></td>
                        <?php endif;?>
                <?php else:?>
                <td></td>    
                <?php endif;?>
            </tr>
            <?php endwhile; ?>
        <?php endif;?>
        </form>
        </tbody>
        </table>

    </div>

    <?php elseif (isset($_GET["oID"])):?>
        <div class="container">
        <h1>Review and change details here</h1>
            <table class="table">
                <tbody>
                <form action="../includes/changedetail.php" method="POST" id="otherform">
                    <?php
                        $oIDdetail = $_GET["oID"];
                        $other_attr = array("Given ID","Model","Type","Connection", "Screen_Size","Resolution","Location","Purchase Date");
                        $result = mysqli_query($connection, "SELECT * FROM other WHERE oID=$oIDdetail;");
                        $row = mysqli_fetch_assoc($result);
                    ?>
                    <tr>
                        <th>Given ID</th>
                        <td><input type="text" value="<?php echo $row["givenID"]; ?>" name="GivenID" disabled></td>
                    </tr>
                    <tr>
                        <th>Model</th>
                        <td><input type="text" value="<?php echo $row["model"]; ?>" name="Model" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> ></td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td><input type="text" value="<?php echo $row["type"]; ?>" name="Type" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> ></td>
                    </tr>
                    <tr>
                        <th>Connection</th>
                        <td><input type="text" value="<?php if($row["cHDMI"]){echo "HDMI, ";} if($row["cDP"]){echo "DP, ";}
                        if($row["cVGA"]){echo "VGA, ";} if($row["cDVI"]){echo "DVI, ";} if($row["cUSBC"]){echo "UBS-C, ";}              
                        ?>" name="Connection" disabled></td>
                    </tr>
                    <tr>
                        <th>Screen Size (Inch)</th>
                        <td><input type="text" value="<?php echo $row["screenSize"]; ?>" name="Screen_Size" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?>></td>
                    </tr>
                    <tr>
                        <th>Resolution</th>
                        <td>
                        <select name="Resolution" value="<?php echo $row["resolution"]; ?>" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> >
                        <option <?php if($row["resolution"] == 'Under 720P (HD)'){echo "selected";}?> value="Under 720P (HD)">Under 720P (HD)</option>
                        <option <?php if($row["resolution"] == '720P (HD)'){echo "selected";}?> value="720P (HD)">720P (HD)</option>
                        <option <?php if($row["resolution"] == '1080P (FHD)'){echo "selected";}?> value="1080P (FHD)">1080P (FHD)</option>
                        <option <?php if($row["resolution"] == '2160P (QHD)'){echo "selected";}?> value="2160P (QHD)">2160P (QHD)</option>
                        <option <?php if($row["resolution"] == 'Over 2160P (QHD)'){echo "selected";}?> value="Over 2160P (QHD)">Over 2160P (QHD)</option>
                        <option <?php if($row["resolution"] == 'Other'){echo "selected";}?> value="Other">Other</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td>
                        <select name="Location" value="<?php echo $row["location"]; ?>" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> >
                            <option <?php if($row["location"] == 'Sydney - Surry Hills'){echo "selected";}?> value="Sydney - Surry Hills">Sydney - Surry Hills</option>
                            <option <?php if($row["location"] == 'Coffs Harbour'){echo "selected";}?> value="Coffs Harbour">Coffs Harbour</option>
                            <option <?php if($row["location"] == 'Wollongong'){echo "selected";}?> value="Wollongong">Wollongong</option>
                            <option <?php if($row["location"] == 'Other'){echo "selected";}?> value="Other">Other</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Purchase Date</th>
                        <td><input type="date" value="<?php echo $row["purchaseDate"]; ?>" name="Purchase_Date" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> ></td>
                    </tr>
                    <tr>
                        <th>Warranty</th>
                        <td><input type="date" value="<?php echo $row["warranty"]; ?>" name="wdate" <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?> ></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><input type="checkbox" id="fatal" name="fatal" value="fatal" <?php echo ($row["fatal"]) ? "checked" : '' ?> <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?>>
                        <label for="fatal">Fatal</label>
                        <span></span>
                        <input type="checkbox" id="dead" name="dead" value="dead" <?php echo ($row["dead"]) ? "checked" : '' ?> <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] < 9)){echo "disabled";} ?>>
                        <label for="dead">Dead</label>
                        </td>
                    </tr>
                </form>
                </tbody>
            </table>

        <div class="bcontainer">
            <?php if(isset($_SESSION["uID"])&&($_SESSION["level"] >= 9)):?>
                <button type="submit" name="othersubmit" value="<?php echo $_GET["oID"];?>" class="btn" form="otherform">Save changes</button>
            <?php endif;?>
        </div>

        <?php if(isset($_SESSION["uID"])): 
            date_default_timezone_set('Australia/Sydney');
            $date = date('d-m-y h:i:s'); ?> 
            <form action="../includes/comment.inc.php" method="POST" id="othercform">
                <div class="form-group">
                    <label for="comment">Post a comment:</label> 
                    <button type="submit" name="othercsubmit" form="othercform" >Post</button>
                    <input type="text" class="form-control" name="comment">
                    <input type="hidden" class="form-control" name="dID" value="<?php echo $oIDdetail?>">
                    <input type="hidden" class="form-control" name="uID" value="<?php echo $uID?>">
                    <input type="hidden" class="form-control" name="date" value="<?php echo $date?>">
                    <input type="hidden" class="form-control" name="deviceType" value="other">
                </div>
            </form>
        <?php else:?>
            <div><a href="../subpages/login.php">Login</a> to post a comment</div>
        <?php endif;?>

        <table class="table">
        <tbody>
        <form action="../includes/comment.inc.php" method="POST" id="deletecomment">
        <?php $comments=mysqli_query($connection, "SELECT * FROM comment INNER JOIN account ON comment.uID=account.uID WHERE dID=$oIDdetail AND deviceType='other';");
        if ($comments->num_rows !== 0): ?>
            <tr>
                <td>Comment:</td>
                <td>Post on:</td>
                <td>By:</td>
            </tr>
            <?php
            while ($comments_assoc = mysqli_fetch_assoc($comments)):
            ?>
            <tr>
                <td><?php echo $comments_assoc["content"]?></td>
                <td><?php echo $comments_assoc["date"]?></td>
                <td><?php echo $comments_assoc["accountname"]?></td>
                <?php if(isset($_SESSION["uID"])): 
                        if($comments_assoc["uID"] == $_SESSION["uID"]):?>
                            <input type="hidden" class="form-control" name="deviceType" value="other">
                            <input type="hidden" class="form-control" name="dID" value="<?php echo $oIDdetail?>">
                            <td><button type="submit" name="deletecomment" value="<?php echo $comments_assoc["ctID"];?>">Delete</button></td>
                        <?php else:?>
                            <td><button type="glyphicon glyphicon-remove" disabled hidden>Delete</button></td>
                        <?php endif;?>
                <?php else:?>
                <td></td>    
                <?php endif;?>
            </tr>
            <?php endwhile; ?>
        <?php endif;?>
        </form>
        </tbody>
        </table>
        </div>
    <?php endif; ?>

</body>
</html>