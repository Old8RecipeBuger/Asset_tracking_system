<?php //include '../subpages/header.php'; 
include_once '../includes/functions.inc.php'; ?>
<link rel="stylesheet" href="../css/login.css"> 

</head>
    <?php if(isset($_GET["verify"])): 
        $v_code = trim(filter_input(INPUT_GET, 'verify', FILTER_SANITIZE_STRING));

        $query = $pdo->prepare("SELECT * FROM account WHERE vCode = :vCode");
        $query->bindParam(':vCode', $v_code, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $query = $pdo->prepare("UPDATE account SET verified = 1, vCode = NULL WHERE uID = :uID");
            $query->bindParam(':uID', $row['uID'], PDO::PARAM_INT);
            $query->execute();
    
            $message = "Your email has been verified. You can log in now.";
        }
        else {
            $message = "Invalid verification code, please try again.";
        }
    ?>
    <div class="container">
        <div class="form-wrapper">
            <div class="flip-container">
                <div class="flipper">
                    <div class="front">
                        <div class="login-form">
                            <p class="text"><?php echo $message; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <?php elseif(isset($_GET["NotyetVerified"])):
        if (isset($_POST['vagain'])){
            $email = trim(filter_input(INPUT_GET, 'NotyetVerified', FILTER_SANITIZE_STRING));
            $verification_code = generate_verification_code();

            $query = $pdo->prepare("UPDATE account SET vCode = :vCode WHERE email = :email");
            $query->bindParam(':vCode', $verification_code, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->execute();

            send_verification_email($email, $verification_code);
        }
        
        ?>
        <div class="container">
        <div class="form-wrapper">
            <div class="flip-container">
                <div class="flipper">
                    <div class="front">
                        <div class="login-form">
                            <p class="text">Your account is not verified yet, please check your email</p>
                            <p class="text">Click the button below to resend a verification email</p>
                            <form method="post">
                                <button type="submit" name="vagain" id="reset-button">Resend a email</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    <?php elseif(isset($_GET["forgetpass"])):
        $error_msg = "";
        if (isset($_POST['forget'])) {
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
       
            $query = $pdo->prepare("SELECT * FROM account WHERE email = :email");
            $query->execute(array(':email' => $email));
            $row = $query->fetch(PDO::FETCH_ASSOC);
        
            if ($row) {
                $password_reset_code = generate_verification_code();
                $query = $pdo->prepare("UPDATE account SET vCode = :vCode WHERE uID = :uID");
                $query->execute(array(':vCode' => $password_reset_code, ':uID' => $row['uID']));
                send_password_reset_email($email, $password_reset_code);
                $error_msg = "If your email matched a record in our database password reset instructions have been sent to your email address.";
            } else {
                $error_msg = "If your email matched a record in our database password reset instructions have been sent to your email address.";
            }
        }
    ?>
        <div class="container">
            <div class="form-wrapper">
                <div class="flip-container">
                    <div class="flipper">
                        <div class="front">
                            <div class="login-form">
                                <h1>Forgot Password</h1>
                                <?php if ($error_msg !== "") { echo '<div class="error">' . $error_msg . '</div>'; } ?>
                                <form method="post">
                                    <div>
                                        <label>Email:</label>
                                        <input type="email" name="email" required>
                                    </div>
                                    <button type="submit" name="forget" id="reset-button">Reset Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    <?php elseif(isset($_GET["resetpass"])):
        $error_msg = "";
        $password_reset_code = filter_var(trim($_GET['resetpass']), FILTER_SANITIZE_STRING);
        if (isset($_POST['reset'])) {
            $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
            $confirm_password = filter_var(trim($_POST['confirm_password']), FILTER_SANITIZE_STRING);

            try {
                $query = $pdo->prepare("SELECT * FROM account WHERE vCode = :password_reset_code");
                $query->bindParam(':password_reset_code', $password_reset_code, PDO::PARAM_STR);
                $query->execute();
                $row = $query->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Error: " . $e->getMessage());
            }
            if ($row) {
                if(passwordMatchRegister($password, $confirm_password) !== false){
                    $error_msg = "Passwords do not match.";
                }
                elseif(invalidatePassword($password) !== false){
                    $error_msg = "Password must be at least 10 characters long and contain at least one special character.";
                }
                else{
                    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                    try {
                        $query = $pdo->prepare("UPDATE account SET password = :password, vCode = NULL WHERE uID = :uID");
                        $query->bindParam(':password', $hashed_password, PDO::PARAM_STR);
                        $query->bindParam(':uID', $row['uID'], PDO::PARAM_INT);
                        $query->execute();
                    } catch (PDOException $e) {
                        error_log("Error: " . $e->getMessage());
                    }
                    $error_msg = "Your password has been reset. Please <a href='../subpages/login.php'>login</a> with your new password.";
                    //header("refresh:5;url=/");
                }
            }else{
                $error_msg = "Invalid verification code.";
            }
        }

    ?>
        <div class="container">
        <div class="form-wrapper">
            <div class="flip-container">
                <div class="flipper">
                    <div class="front">
                        <div class="login-form">
                            <h1>Password Reset</h1>
                            <?php if ($error_msg !== "") { echo '<div class="error">' . $error_msg . '</div>'; } ?>
                            <form method="POST">
                                <div>
                                    <label>New Password:</label>
                                    <input type="password" name="password" required>
                                </div>
                                <div>
                                    <label>Confirm New Password:</label>
                                    <input type="password" name="confirm_password" required>
                                </div>
                                <button type="submit" name="reset">Reset Password</button>
                            </form>
                            <div class="register-link">
                                <a href="../subpages/login.php" id="login-link">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php endif ?>



<body>
</body>
</html>