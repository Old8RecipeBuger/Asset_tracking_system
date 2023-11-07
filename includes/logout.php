<?php
    include_once 'database.php';

    session_start();
    $uid = $_SESSION["uID"];

    try {
        $uadd = $pdo->prepare("DELETE FROM `session` WHERE `mid` = :mid");
        $uadd->bindParam(':mid', $uid, PDO::PARAM_INT);
        $uadd->execute();
    }
    catch(PDOException $e) {
         error_log("Error: " . $e->getMessage());
    }

    $expirationTimestamp = time() - 3600;
    setcookie(
        'asst',
        '',
        [
            'expires' => $expirationTimestamp,
            'path' => '/',
            'domain' => 'assets.trgs.ws',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict',
        ]
    );
    setcookie(session_name(), '', $expirationTimestamp);
    
    session_unset();
    session_destroy();

    header("Location: ../index.php");
    exit();
?>