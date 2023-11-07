<?php
    include_once 'database.php';
    include_once 'functions.inc.php';

    if (isset($_POST['verify'])) {
        $v_code = trim(filter_input(INPUT_GET, 'verify', FILTER_SANITIZE_STRING));

        $sqlcommand = "UPDATE account (vertified, vCode) 
        values (?, ?);";

        $stmt = mysqli_stmt_init($connection);
        //Check will sqlcommand cause any errors in the databse
        if (!mysqli_stmt_prepare($stmt, $sqlcommand)){
            header("Location: ../includes/email.ine.php?error=vertifyfailed");
            exit();
        }
        $value = true;
        $verification_code = null;
        //bind sqlcommand with wanted parameters
        mysqli_stmt_bind_param($stmt, "bs", $value, $verification_code);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
    }
    elseif (isset($_POST['forgetpass'])){

    }
    elseif (isset($_POST['resetpass'])){
        
    }