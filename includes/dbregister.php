<?php
    //database connection in the other file 
    include_once 'database.php';
    include_once 'functions.inc.php';
 
    if (isset($_POST["regisubmit"])){
        $username = trim(filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_STRING));
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $password = trim(filter_input(INPUT_POST, 'pword', FILTER_SANITIZE_STRING));
        $reenterpossword = trim(filter_input(INPUT_POST, 'rpword', FILTER_SANITIZE_STRING));

        $emVal = true;
        /*
        if (preg_match('/@taverner\.com\.au$/', $email)) {
            $emVal = true;
        }
        */
        //check empty inputs
        if (emptyInputRegister($username, $password, $reenterpossword, $email) !== false){
            header("Location: ../subpages/register.php?error=emptyinput");
            exit();
        }
        //check password matches
        elseif (passwordMatchRegister($password, $reenterpossword) !== false){
            header("Location: ../subpages/register.php?error=passwordsdontmatch");
            exit();
        }
        elseif (uidExists($pdo, $username)){
            header("Location: ../subpages/register.php?error=usernameexist");
            exit();
        }
        //check if taverner email is used
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || !$emVal) {
            header("Location: ../subpages/register.php?error=invalidemail");
            exit();
        }
        //check if this email already registered
        elseif (emailExists($pdo, $email) !== false){
            header("Location: ../subpages/register.php?error=emailexist");
            exit();
        }
        //check if password validate length greater than 10 and have special character
        elseif (invalidatePassword($password) !== false){
            header("Location: ../subpages/register.php?error=poorpassword");
            exit();
        }

        //check verification
        $verification_code = generate_verification_code();

        //create user in the databse
        createUser($connection, $username, $password, $email, $verification_code);
        //send email
        //send_verification_email($email, $verification_code);
        header("Location: ../subpages/register.php?error=none");
        exit();
    } 

    if (isset($_POST["loginsubmit"])){
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $password = trim(filter_input(INPUT_POST, 'pword', FILTER_SANITIZE_STRING));

        if (emptyInputLogin($email, $password) !== false){
            header("Location: ../subpages/login.php?error=emptyinput");
            exit();
        }

        loginUser($connection, $email, $password, $pdo);    
    }
?>