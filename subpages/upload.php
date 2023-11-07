<?php include '../subpages/header.php'; ?>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<link rel="stylesheet" href="../css/uploadstyle.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <?php if(!isset($_GET["type"])): ?>
        <div class="container">
            <p class="uploadtitle">Please choose a type</p>
            <div class="row">
                <div class="col-sm-6">
                <a href="../subpages/upload.php?type=pc"><button class="upload_block"><span class='fas fa-laptop'></span>  PC/LAPTOP</button></a>
                </div>
                <div class="col-sm-6">
                <a href="../subpages/upload.php?type=tab"><button class="upload_block"><span class='fas fa-tablet-alt'></span>  TABLET</button></a>  
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                <a href="../subpages/upload.php?type=sim"><button class="upload_block"><span class='fas fa-sim-card'></span>  SIM</button></a>
                </div>
                <div class="col-sm-6">
                <a href="../subpages/upload.php?type=other"><button class="upload_block"><span class='fas fa-server'></span>  OTHER DEVICES</button></a>
                </div>
            </div>

    <?php elseif($_GET["type"] === "pc"): ?>
    <div class="container">
        <div style="display: flex; justify-content: space-between; text-align: centre">
            <h2>Upload information of a PC/LAPTOP</h2> 
            <a href="../subpages/upload.php"><button class="cancel-btn">Cancel</button></a>
        </div>
        <?php
            $max_value=0;
            $pc = mysqli_query($connection, "select givenID from computer");
            while($row = mysqli_fetch_assoc($pc)){
                preg_match('/\d+/', $row["givenID"], $matches);
                if($matches){
                    $integer = intval($matches[0]);
                    $max_value = max($integer, $max_value);
                }
            }
            $max_value += 1;
            $formatted_max = sprintf("%03d", $max_value);
        ?>
        <?php
        //GET check visible text and post check invisiable
            if (isset($_GET["error"])){
                if ($_GET["error"] == "emptyinput"){
                    echo "<div class=\"alert alert-warning\">
                        <strong>Error!</strong> All fields are required.
                    </div>";
                }
            }
        ?>
        <form action="../includes/deviceupload.php" method="POST">
        <!--name is used for POST or GET function to deliver the inputs-->
            <div class="form-group">
                <label for="gid">GivenID:</label>
                <input type="text" class="form-control" id="gid" value="<?php echo "PC".$formatted_max; ?>" name="gid">
            </div>
            <div class="form-group">
                <label for="pcName">PC Name:</label>
                <input type="text" class="form-control" id="pcName" placeholder="Enter PC Name" name="pcName">
            </div>
            <div class="form-group">
                <label for="mol">Model:</label>
                <input type="text" class="form-control" id="mol" placeholder="Enter Model" name="mol">
            </div>
            <div class="form-group">
                <label for="typ">Type:</label>
                <select name="typ" id="typ">
                    <option value="Laptop">Laptop</option>
                    <option value="PC">PC</option>
                </select>
            </div>
            <div class="form-group">
                <label for="snum">Serial Number:</label>
                <input type="text" class="form-control" id="snum" placeholder="Enter Serial Number" name="snum">
            </div>
            <div class="form-group">
                <label for="cpu">CPU:</label>
                <input type="text" class="form-control" id="cpu" placeholder="Enter CPU e.g.(Intel Core i5 3.6Ghz)" name="cpu">
            </div>
            <div class="form-group">
                <label for="mem">Memory:</label>
                <select name="mem" id="mem">
                    <option value="2GB">2GB</option>
                    <option value="4GB">4GB</option>
                    <option value="8GB">8GB</option>
                    <option value="16GB">16GB</option>
                    <option value="32GB">32GB</option>
                    <option value="64GB and more">64GB and more</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="stor">Storage:</label>
                <select name="stor" id="stor">
                    <option value="128GB and less">128GB and less</option>
                    <option value="256GB">256GB</option>
                    <option value="512GB">512GB</option>
                    <option value="1TB and more">1TB and more</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ssize">Screen Size (Inch):</label>
                <input type="text" class="form-control" id="ssize" placeholder="Enter Screen Size" name="ssize">
            </div>
            <div class="form-group">
                <label for="res">Resolution:</label>
                <select name="res" id="res">
                    <option value="Under 720P (HD)">Under 720P (HD)</option>
                    <option value="720P (HD)">720P (HD)</option>
                    <option value="1080P (FHD)">1080P (FHD)</option>
                    <option value="2160P (QHD)">2160P (QHD)</option>
                    <option value="Over 2160P (QHD)">Over 2160P (QHD)</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="persn">Person:</label>
                <input type="text" class="form-control" id="persn" placeholder="Enter Person" name="persn">
            </div>
            <div class="form-group">
                <label for="locat">Location:</label>
                <select name="locat" id="locat">
                    <option value="Sydney - Surry hill">Sydney - Surry hill</option>
                    <option value="Coffs Harbour">Coffs Harbour</option>
                    <option value="Wollongong">Wollongong</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="lic">License:</label>
                <input type="text" class="form-control" id="lic" placeholder="Enter License" name="lic">
            </div>
            <div class="form-group">
                <label for="pdate">Purchased Date:</label>
                <input type="date" class="form-control" id="pdate" placeholder="Enter Purchased Date" name="pdate">
            </div>
            <div class="form-group">
                <label for="wdate">Warranty:</label>
                <input type="date" class="form-control" id="wdate" placeholder="Enter Warranty" name="wdate">
            </div>
            <div class="bcontainer">
            <button type="submit" name="pcsubmit" class="btn btn-default">Upload</button>
            </div>
        </form>
    </div>

    <?php elseif($_GET["type"] === "tab"): ?>
    <div class="container">
        <?php
            $max_value=0;
            $tabs = mysqli_query($connection, "select givenID from tablet");
            while($row = mysqli_fetch_assoc($tabs)){
                preg_match('/\d+/', $row["givenID"], $matches);
                if($matches){
                    $integer = intval($matches[0]);
                    $max_value = max($integer, $max_value);
                }
            }
            $max_value += 1;
            $formatted_max = sprintf("%03d", $max_value);
        ?>

        <div style="display: flex; justify-content: space-between; text-align: centre">
            <h2>Upload information of a TABLET</h2> 
            <a href="../subpages/upload.php"><button class="cancel-btn">Cancel</button></a>
        </div>

        <?php
            if (isset($_GET["error"])){
                if ($_GET["error"] == "emptyinput"){
                    echo "<div class=\"alert alert-warning\">
                        <strong>Error!</strong> All fields are required.
                    </div>";
                }
            }
        ?>
        <form action="../includes/deviceupload.php" method="POST">
        <!--name is used for POST or GET function to deliver the inputs-->
            <div class="form-group">
                <label for="gid">GivenID:</label>
                <input type="text" class="form-control" id="gid" value="<?php echo "Tab".$formatted_max; ?>" name="gid">
            </div>
            <div class="form-group">
                <label for="mol">Model:</label>
                <input type="text" class="form-control" id="mol" placeholder="Enter Model" name="mol">
            </div>
            <div class="form-group">
                <label for="snum">Serial Number:</label>
                <input type="text" class="form-control" id="snum" placeholder="Enter Serial Number" name="snum">
            </div>
            <div class="form-group">
                <label for="stor">Storage:</label>
                <select name="stor" id="stor">
                    <option value="8GB">8GB</option>
                    <option value="16GB">16GB</option>
                    <option value="32GB">32GB</option>
                    <option value="64GB">64GB</option>
                    <option value="128GB">128GB</option>
                    <option value="256GB">256GB</option>
                    <option value="512GB">512GB</option>
                    <option value="1TB and more">1TB and more</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ssize">Screen Size (Inch):</label>
                <input type="text" class="form-control" id="ssize" placeholder="Enter Screen Size" name="ssize">
            </div>
            <div class="form-group">
                <label for="cap">Capacity:</label>
                <select name="cap" id="cap">
                    <option value="3G">3G</option>
                    <option value="4G">4G</option>
                    <option value="5G">5G</option>
                </select>
            </div>
            <div class="form-group">
                <label for="pdate">Purchased Date:</label>
                <input type="date" class="form-control" id="pdate" placeholder="Enter Purchased Date" name="pdate">
            </div>
            <div class="form-group">
                <label for="wdate">Warranty:</label>
                <input type="date" class="form-control" id="wdate" placeholder="Enter Warranty" name="wdate">
            </div>
            <div class="bcontainer">
            <button type="submit" name="tabsubmit" class="btn btn-default">Upload</button>
            </div>
        </form>
    </div>

    <?php elseif($_GET["type"] === "sim"): ?>
    <div class="container">

        <div style="display: flex; justify-content: space-between; text-align: centre">
            <h2>Upload information of a SIM CARD</h2> 
            <a href="../subpages/upload.php"><button class="cancel-btn">Cancel</button></a>
        </div>
        <?php
            $max_value=0;
            $sim = mysqli_query($connection, "select givenID from sim");
            while($row = mysqli_fetch_assoc($sim)){
                preg_match('/\d+/', $row["givenID"], $matches);
                if($matches){
                    $integer = intval($matches[0]);
                    $max_value = max($integer, $max_value);
                }
            }
            $max_value += 1;
            $formatted_max = sprintf("%03d", $max_value);
        ?>
        <?php
            if (isset($_GET["error"])){
                if ($_GET["error"] == "emptyinput"){
                    echo "<div class=\"alert alert-warning\">
                        <strong>Error!</strong> All fields are required.
                    </div>";
                }
            }
        ?>
        <form action="../includes/deviceupload.php" method="POST">
        <!--name is used for POST or GET function to deliver the inputs-->
            <div class="form-group">
                <label for="gid">GivenID:</label>
                <input type="text" class="form-control" id="gid" value="<?php echo "SIM".$formatted_max; ?>" name="gid">
            </div>
            <div class="form-group">
                <label for="iccid">ICCID:</label>
                <input type="text" class="form-control" id="iccid" placeholder="Enter ICCID" name="iccid">
            </div>
            <div class="form-group">
                <label for="pro">Provider:</label>
                <input type="text" class="form-control" id="pro" placeholder="Enter Provider" name="pro">
            </div>
            <div class="form-group">
                <label for="num">Number:</label>
                <input type="text" class="form-control" id="num" placeholder="Enter Number" name="num">
            </div>
            <div class="form-group">
                <label for="cos">Cost:</label>
                <input type="text" class="form-control" id="cos" placeholder="Enter Cost" name="cos">
            </div>
            <div class="form-group">
                <label for="dat">Data:</label>
                <input type="input" class="form-control" id="dat" placeholder="Enter Data" name="dat">
            </div>
            <div class="form-group">
                <label for="net">Network:</label>
                <select name="net" id="net">
                    <option value="3G">3G</option>
                    <option value="4G">4G</option>
                    <option value="5G">5G</option>
                </select>
            </div>
            <div class="form-group">
                <label for="edate">Expire Date:</label>
                <input type="date" class="form-control" id="edate" placeholder="Enter Expire Date" name="edate">
            </div>
            <div class="bcontainer">
            <button type="submit" name="simsubmit" class="btn btn-default">Upload</button>
            </div>
        </form>
    </div>

    <?php elseif($_GET["type"] === "other"): ?>
    <div class="container">

        <div style="display: flex; justify-content: space-between; text-align: centre">
            <h2>Upload information of a OTHER DEVICE</h2> 
            <a href="../subpages/upload.php"><button class="cancel-btn">Cancel</button></a>
        </div>

        <?php
            $max_value=0;
            $other = mysqli_query($connection, "select givenID from sim");
            while($row = mysqli_fetch_assoc($other)){
                preg_match('/\d+/', $row["givenID"], $matches);
                if($matches){
                    $integer = intval($matches[0]);
                    $max_value = max($integer, $max_value);
                }
            }
            $max_value += 1;
            $formatted_max = sprintf("%03d", $max_value);
        ?>

        <?php
            if (isset($_GET["error"])){
                if ($_GET["error"] == "emptyinput"){
                    echo "<div class=\"alert alert-warning\">
                        <strong>Error!</strong> All fields are required.
                    </div>";
                }
            }
        ?>

        <form action="../includes/deviceupload.php" method="POST">
        <!--name is used for POST or GET function to deliver the inputs-->
        <div class="form-group">
                <label for="gid">GivenID:</label>
                <input type="text" class="form-control" id="gid" value="<?php echo "HW".$formatted_max; ?>" name="gid">
            </div>
            <div class="form-group">
                <label for="mol">Model:</label>
                <input type="text" class="form-control" id="mol" placeholder="Enter Model" name="mol">
            </div>
            <div class="form-group">
                <label for="typ">Type:</label>
                <input type="text" class="form-control" id="typ" placeholder="Enter Type" name="typ">
            </div>
            <div class="form-group">
                <label for="connection[]">Connection:</label>
                <select name="connection[]" class="multiple-select" multiple>
                        <option value="cHDMI">HDMI</option>
                        <option value="cUSBC">USB-C</option>
                        <option value="cDP">DisplayPort</option>
                        <option value="cDVI">DVI</option>
                        <option value="cVGA">VGA</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ssize">Screen Size (Inch):</label>
                <input type="text" class="form-control" id="ssize" placeholder="Enter Screen Size" name="ssize">
            </div>
            <div class="form-group">
                <label for="res">Resolution:</label>
                <select name="res" id="res">
                    <option value="Under 720P (HD)">Under 720P (HD)</option>
                    <option value="720P (HD)">720P (HD)</option>
                    <option value="1080P (FHD)">1080P (FHD)</option>
                    <option value="2160P (QHD)">2160P (QHD)</option>
                    <option value="Over 2160P (QHD)">Over 2160P (QHD)</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="locat">Location:</label>
                <select name="locat" id="locat">
                    <option value="Sydney - Surry Hills">Sydney - Surry Hills</option>
                    <option value="Coffs Harbour">Coffs Harbour</option>
                    <option value="Wollongong">Wollongong</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="pdate">Purchased Date:</label>
                <input type="date" class="form-control" id="pdate" placeholder="Enter Purchased Date" name="pdate">
            </div>
            <div class="form-group">
                <label for="wdate">Warranty:</label>
                <input type="date" class="form-control" id="wdate" placeholder="Enter Warranty" name="wdate">
            </div>
            <div class="bcontainer">
            <button type="submit" name="othersubmit" class="btn btn-default">Upload</button>
            </div>
        </form>
    </div>
     
    <?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(".multiple-select").select2({
});
</script>
</body>
</html>