<?php include '../subpages/header.php'; ?>
<?php //include_once '../includes/database.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.3.2/css/fixedHeader.dataTables.min.css">
</head>

<body>
<?php 
/*$resulttab=mysqli_query($connection, "SELECT computer.cID AS ID, computer.givenID AS givenID, NULL AS capacity, 'laptop' AS type FROM computer WHERE computer.type = 'laptop' 
UNION SELECT tablet.tID AS ID, tablet.givenID AS givenID, tablet.capacity AS capacity,'tablet' AS type FROM tablet;");
//$resulttab=mysqli_query($connection,"select * from tablet");

while ($devices = mysqli_fetch_assoc($resulttab)){
    print_r($devices);
    echo "             ";
}
*/

if (isset($_POST['setlevel'])){
    $uID = $_SESSION["uID"];
    $level = $_POST['level'];

    $query = $pdo->prepare("UPDATE account SET level = :level WHERE uID = :uID");
    $query->bindParam(':level', $level, PDO::PARAM_STR);
    $query->bindParam(':uID', $uID, PDO::PARAM_STR);
    $query->execute();
}

?>

<p>click here to set up this account level</p>
<div class="container">
    <form method="post">
        <div>
            <label>Reset level:</label>
            <input type="level" name="level">
        </div>
        <button type="submit" name="setlevel" id="reset-button">Re-set level</button>
    </form>
</div>

<?php //echo "guid equals to" ?>
<?php //echo $_SESSION["guid"]; ?>
<?php echo $_SESSION["email"]; ?>
<?php echo $_SESSION["level"]; ?>




</body>
<script src='../js/jquery.datatable.js'></script>
</html>