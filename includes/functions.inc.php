<?php
include_once 'database.php';

function emptyInputRegister($username, $password, $reenterpossword, $email) {
    $result;
    if (empty($username) || empty($password) || empty($reenterpossword) || empty($email)){ 
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function passwordMatchRegister($password, $reenterpossword) {
    $result;
    if ($password !== $reenterpossword){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function createUser($connection, $username, $password, $email, $verification_code){
    $sqlcommand = "insert into account (accountname, password, email, vCode) 
        values (?, ?, ?, ?);";

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
    //security purpose
    $stmt = mysqli_stmt_init($connection);
    //Check will sqlcommand cause any errors in the databse
    if (!mysqli_stmt_prepare($stmt, $sqlcommand)){
        header("Location: ../subpages/register.php?error=registerfailedcreateuser");
        exit();
    }
    
    // 'ss'means two strings
    //bind sqlcommand with wanted parameters
    mysqli_stmt_bind_param($stmt, "ssss", $username, $hashed_password, $email, $verification_code);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
 
}

function emailExists($pdo, $email){
    try {
        $emChk = $pdo->prepare("SELECT * FROM account WHERE email = :email");
        $emChk->bindParam(':email', $email, PDO::PARAM_STR);
        $emChk->execute();
        $emChk_data = $emChk->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        header("Location: ../subpages/login.php?error=registerfailedemailexist");
        exit();
    }
    if (!$emChk_data){
        return false;
    }
    else{
        return $emChk_data;
    }
    mysqli_stmt_close($emChk);
    /*
    //version 5.1 and above
    $sqlcommand = "SELECT * FROM account WHERE email = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $sqlcommand)){
        header("Location: ../subpages/login.php?error=registerfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    
    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
    */
}

// Validate password meets security requirements
function invalidatePassword($password) {
    // Password must be at least 10 characters long and contain at least one special character
    if (strlen($password) < 10) {
        return true;
    }
    if (!preg_match('/[\'^£$%&*()!}{@#~?><>,|=_+¬-]/', $password)) {
        return true;
    }
    return false;
}



function emptyInputLogin($email, $password) {
    $result;
    if (empty($email) || empty($password)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function uidExists($pdo, $username){
    try {
        $emChk = $pdo->prepare("SELECT * FROM account WHERE accountname = :accountname");
        $emChk->bindParam(':accountname', $username, PDO::PARAM_STR);
        $emChk->execute();
        $emChk_data = $emChk->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        header("Location: ../subpages/login.php?error=loginfailed");
        exit();
    }
    if ($emChk_data){
        return $emChk_data;
    }
    else{
        return false;
    }
    mysqli_stmt_close($emChk);

}

function loginUser($connection, $email, $password, $pdo){
    $uidExisted = emailExists($pdo, $email);

    if ($uidExisted === false){
        header("Location: ../subpages/login.php?error=usernotexist");
        exit();
    }

    $hashed_password = $uidExisted["password"];
    if (password_verify($password, $hashed_password)){
        $checkpassw = true;
    }
    else{
        header("Location: ../subpages/login.php?error=wrongPwd");
        exit();
    }
    $email=$uidExisted["email"];

    //check if this account has been verified
    /*if ($uidExisted["verified"] != 1){
        header("Location: ../subpages/email.php?NotyetVerified=$email");
        exit();
    }
    */

    $user_ip = getUserIP();
    $country_code = getCountryCodeFromIP($user_ip);
    /*
    if ($country_code !== 'AU') {
        header("Location: ../subpages/login.php?error=notAU");
        exit();
    }
    */

    //session_start();
    $_SESSION["uID"] = $uidExisted["uID"];
    $_SESSION["accountname"] = $uidExisted["accountname"];
    $_SESSION["level"] = $uidExisted["level"];
    $_SESSION["email"] = $uidExisted["email"];
    $_SESSION["loggedin"] = TRUE;
    //generate guid for cookie
    $guid = GUIDv4();
    $_SESSION["guid"] = $guid;
    $expiry = time() + (86400 * 30);
    $dbexpire = date('Y-m-d H:i:s',$expiry);
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    //write to db:
    try {
        $uadd = $pdo->prepare("INSERT INTO session (identifier, mid, expiry, ip_address, user_agent) VALUES (:guid, :mid, :expiry, :ip, :ua)");
        $uadd->bindParam(':guid', $guid, PDO::PARAM_STR);
        $uadd->bindParam(':mid', $uidExisted["uID"], PDO::PARAM_INT);
        $uadd->bindParam(':expiry', $dbexpire, PDO::PARAM_STR);
        $uadd->bindParam(':ip', $user_ip, PDO::PARAM_STR);
        $uadd->bindParam(':ua', $user_agent, PDO::PARAM_STR);
        $uadd->execute();
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
    }

    //add user details to cookie
    setcookie(
        "asst",
        $guid,
        [
            'expires' => $expiry,
            'path' => '/',
            'domain' => 'assets.trgs.ws',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict',
        ]
    );

    //whilst we're here, clear the old sessions:
    try {
        $del = $pdo->prepare("DELETE FROM `session` WHERE `expiry` < NOW()");
        $del->execute();
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
    }

    header("Location: ../index.php");
    exit();
}

// Generate a unique verification code
function generate_verification_code() {
    return md5(uniqid(rand(), true));
}

// Send verification email to user
/*
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';


// Send verification email to user
function send_verification_email($email, $verification_code) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->CharSet    = 'UTF-8';
        $mail->Host       = 'cpanel-560-syd.hostingww.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'asset@trgs.ws';
        $mail->Password   = 's8j^[-VxN,_}^^CI@qixxzwxJ5YJunTN00?!%HvPNLC{?A{eRjk-fs,ub=ZZ,h';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        
        $mail->setFrom('asset@trgs.ws', 'Taverner assets');
        $mail->addAddress($email);
        $mail->addReplyTo('asset@trgs.ws', 'Taverner assets');
        
        $mail->isHTML(true);
        $mail->Subject = 'Account verification';
        $mail->Body    = "	<p>Hello,</p>
                            <p>Please click on the link below to verify your account:</p>
                            <p><a href=\"https://assets.trgs.ws/subpages/email.php?verify=" . $verification_code . "\">assets.trgs.ws/subpages/email.php?verify=" . $verification_code . "</a></p>
                            <br />
                            <p>Thanks<br />
                               Taverner assets</p>";
                          
        $mail->AltBody = "Hi,\n\nPlease click on the link below to verify your account:\n\nhttps://assets.trgs.ws/subpages/email.php?verify=" . $verification_code . "\n\nThanks,\nTaverner assets";
        $mail->send();
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }
}

function send_password_reset_email($email, $password_reset_code) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->CharSet    = 'UTF-8';
        $mail->Host       = 'cpanel-560-syd.hostingww.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'asset@trgs.ws';
        $mail->Password   = 's8j^[-VxN,_}^^CI@qixxzwxJ5YJunTN00?!%HvPNLC{?A{eRjk-fs,ub=ZZ,h';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        
        $mail->setFrom('asset@trgs.ws', 'Taverner assets');
        $mail->addAddress($email);
        $mail->addReplyTo('asset@trgs.ws', 'Taverner assets');
        
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Request';
        $mail->Body    = "	<p>Hello,</p>
                            <p>We received a request to reset the password for your account.</p>
                            <p>To reset your password, please click on the following link:</p>
                            <p><a href=\"https://assets.trgs.ws/subpages/email.php?resetpass=" . urlencode($password_reset_code) . "\">assets.trgs.ws/subpages/email.php?resetpass=" . urlencode($password_reset_code) . "</a></p>
                            <p>If you did not make this request, please ignore this email.</p>
                            <br />
                            <p>Thanks<br />
                               Taverner Timesheets</p>";
                          
        $mail->AltBody = "Hi,\n\nWe received a request to reset the password for your account.\n\nTo reset your password, please click on the following link:\n\nhttps://assets.trgs.ws/subpages/email.php?resetpass=" . urlencode($password_reset_code) . "\n\nIf you did not make this request, please ignore this email.\n\nThanks,\nTaverner Timesheets";
        $mail->send();
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }
}
*/
// get user IP address
function getUserIP() {
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

function getCountryCodeFromIP($ip) {
    $url = "http://ip-api.com/json/{$ip}?fields=status,countryCode";
    $response = @file_get_contents($url);
    
    if ($response) {
        $data = json_decode($response, true);
        if ($data['status'] === 'success') {
            return $data['countryCode'];
        }
    }
    return null;
}

/**
 *
 * @param bool $trim
 * @return string
 */
function GUIDv4 ($trim = true)
{
    // Windows
    if (function_exists('com_create_guid') === true) {
        if ($trim === true)
            return trim(com_create_guid(), '{}');
        else
            return com_create_guid();
    }

    // OSX/Linux
    if (function_exists('openssl_random_pseudo_bytes') === true) {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    // Fallback (PHP 4.2+)
    mt_srand((double)microtime() * 10000);
    $charid = strtolower(md5(uniqid(rand(), true)));
    $hyphen = chr(45);                  // "-"
    $lbrace = $trim ? "" : chr(123);    // "{"
    $rbrace = $trim ? "" : chr(125);    // "}"
    $guidv4 = $lbrace.
              substr($charid,  0,  8).$hyphen.
              substr($charid,  8,  4).$hyphen.
              substr($charid, 12,  4).$hyphen.
              substr($charid, 16,  4).$hyphen.
              substr($charid, 20, 12).
              $rbrace;
    return $guidv4;
}

function emptyInputpcsubmit($givenid, $pcname, $model, $serialNumber, $cpu, $screensize,
    $person,$license, $purchasedate, $warranty) {
    $result;
    if (empty($givenid) || empty($pcname) || empty($model) || empty($serialNumber) || empty($cpu)|| empty($screensize)
    || empty($person) || empty($license) || empty($purchasedate) || empty($warranty)){ 
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function emptyInputtabsubmit($givenid, $model, $serialNumber, $screensize, $purchasedate, $warranty) {
    $result;
    if (empty($givenid) || empty($model) || empty($serialNumber) || empty($screensize) || empty($purchasedate)|| empty($warranty)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function emptyInputsimsubmit($givenid, $iccid, $provider, $number, $cost, $data, $expiredate) {
    $result;
    if (empty($givenid) || empty($iccid) || empty($provider) || empty($number) || empty($cost)|| empty($data)|| empty($expiredate)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function emptyInputothersubmit($givenid, $model, $type, $connection_list, $screensize, $purchasedate, $warranty) {
    $result;
    if (empty($givenid) || empty($model) || empty($type) || empty($connection_list) || empty($screensize)|| empty($purchasedate)|| empty($warranty)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

?>