<?php

    function getUserIP_again() {
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $user_ip = trim($ips[0]);
        } elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $user_ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $user_ip = $_SERVER['REMOTE_ADDR'];
        }
        return $user_ip;
    }

    $user_ip = getUserIP_again();

    if (!isset($_SESSION['loggedin'])) {
        $_SESSION['loggedin']=FALSE;
    }

    if ($_SESSION['loggedin']==FALSE){
        //do we have a cookie?
        if(isset($_COOKIE["asst"])) {
            $sessCookie = $_COOKIE["asst"];
        } else {
            $sessCookie = null;
        }
        
        try {
            //$user = $pdo->prepare("SELECT uID, accountname, level, email FROM account WHERE uID IN (SELECT mid FROM session WHERE identifier = :ident AND expiry > now())");
            $user = $pdo->prepare("SELECT uID, accountname, level, email FROM account WHERE uID IN (SELECT mid FROM session WHERE expiry > now())");
            //$user->bindParam(':ident', $sessCookie, PDO::PARAM_STR);
            $user->execute();
            $userdata = $user->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) {
            error_log("Error: " . $e->getMessage());
        }
        $rows = $user->rowCount();
        
        if($rows == 1) {
            //add user details to session
            $_SESSION["uID"] = $userdata["uID"];
            $_SESSION["accountname"] = $userdata["accountname"];
            $_SESSION["level"] = $userdata["level"];
            $_SESSION["email"] = $userdata["email"];
            $_SESSION["loggedin"] = TRUE;
            
            //update cookie
            $expiry = time() + (86400 * 30);
            setcookie(
                "asst",
                $sessCookie,
                [
                    'expires' => $expiry,
                    'path' => '/',
                    'domain' => 'assets.trgs.ws',
                    'secure' => true,
                    'httponly' => true,
                    'samesite' => 'Strict',
                ]
            );

        } 
        else { //no cookie / user not found
            header('Location: /subpages/login.php');
            exit();
        }
    }
    else{
        //user is logged in, check for session hijacking (note, not perfect as can be faked, but, worth as a check)
        if(isset($_COOKIE["asst"])) {
            $sessCookie = $_COOKIE["asst"];
        } else {
            $sessCookie = null;
        }

        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $user_agent_truncated = substr($user_agent, 0, 255);
        
        try {
            $check = $pdo->prepare("SELECT ip_address, user_agent FROM session WHERE identifier = :ident AND expiry > now()");
            $check->bindParam(':ident', $sessCookie, PDO::PARAM_STR);
            $check->execute();
            $checkdata = $check->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) {
            error_log("Error: " . $e->getMessage());
        }
        
        //$stored_ip = $checkdata['ip_address'];
        //$stored_user_agent = $checkdata['user_agent'];
        
        /* to check if IP is correct
        if ($user_ip !== $stored_ip || $user_agent_truncated !== $stored_user_agent) {
            header('Location: /subpages/login.php');
            exit();
        }
        */
    }
?>
