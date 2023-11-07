<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css"> 

</head>

<body>
    <div class="container">
    <div class="form-wrapper">
    <div class="flip-container">
    <div class="flipper">
    <div class="front">
    <div class="login-form">
    
        <h2>Register form</h2>
        <form action="../includes/dbregister.php" method="POST">
        <!--name is used for POST or GET function to deliver the inputs-->
            <div class="form-group">
                <label for="uname">Username:</label>
                <input type="text" class="form-control" id="email" placeholder="Enter username" name="uname">
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="text" class="form-control" id="email" placeholder="Enter E-mail" name="email">
            </div>
            <div class="form-group">
                <label for="pword">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pword">
            </div>
            <div class="form-group">
                <label for="rpword">Re-enter Password:</label>
                <input type="password" class="form-control" id="repwd" placeholder="Re-enter password" name="rpword">
            </div>
            <button type="submit" name="regisubmit" class="btn btn-default">Register</button>
            <div class="register-link">
                Already have an account? Login <a href="../subpages/login.php">here</a>
            </div>
        </form>
        <?php
            //GET check visible text and post chech invisiable
            if (isset($_GET["error"])){
                if ($_GET["error"] == "emptyinput"){
                    echo "<div class=\"alert alert-warning\">
                        <strong>Warning!</strong> Please fill all the blanks!
                    </div>";
                }
                else if ($_GET["error"] == "passwordsdontmatch"){
                    echo "<div class=\"alert alert-danger\">
                        <strong>Error!</strong> Passwords don't match!
                    </div>";
                }
                else if ($_GET["error"] == "usernameexist"){
                    echo "<div class=\"alert alert-warning\">
                        <strong>Error!</strong> Username used, please try another one!
                    </div>";
                }
                else if ($_GET["error"] == "invalidemail"){
                    echo "<div class=\"alert alert-danger\">
                        <strong>Error!</strong> Please use your Taverner Email.
                    </div>";
                }
                else if ($_GET["error"] == "emailexist"){
                    echo "<div class=\"alert alert-danger\">
                        <strong>Error!</strong> Email already registered!
                    </div>";
                }
                else if ($_GET["error"] == "poorpassword"){
                    echo "
                    <div class=\"alert alert-warning\">
                        <strong>Warning!</strong> Poor password! Password must be at least 10 characters long and contain at least one special character! 
                    </div>";
                }
                else if ($_GET["error"] == "none"){
                    echo "<div class=\"alert alert-success\">
                        <strong>Success!</strong> Please check your email for verification.
                    </div>";
                }
            }
        ?>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

</body>
</html>