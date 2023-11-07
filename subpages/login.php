<?php //include '../subpages/header.php'; ?>
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
        <h2>Login form</h2>
        <form action="../includes/dbregister.php" method="POST">
        <!--name is used for POST or GET function to deliver the inputs-->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <div class="form-group">
                <label for="pword">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pword">
            </div>
            <button type="submit" name="loginsubmit" class="btn btn-default">Login</button>
        </form>
        <div class="register-link">
            Don't have an account? Register <a href="../subpages/register.php">here</a><br>
        </div>
        <div class="register-link">
        Forget your password? Reset <a href="../subpages/email.php?forgetpass">here</a>
        </div>

        <?php
            //GET check visible text and post chech invisiable
            if (isset($_GET["error"])){
                if ($_GET["error"] == "emptyinput"){
                    echo "<div class=\"alert alert-warning\">
                        <strong>Error!</strong> Please fill all the blanks!
                    </div>";
                }
                else if ($_GET["error"] == "usernotexist"){
                    echo "<div class=\"alert alert-danger\">
                        <strong>Error!</strong> User does not exist!
                    </div>";
                }
                else if ($_GET["error"] == "wrongPwd"){
                    echo "<div class=\"alert alert-danger\">
                        <strong>Error!</strong> Password is wrong! Please enter again!
                    </div>";
                }
                else if ($_GET["error"] == "none"){
                    echo "<div class=\"alert alert-success\">
                            <strong>Success!</strong> Register success!
                            </div>";
                }
                else if ($_GET["error"] == "notAU"){
                    echo "<div class=\"alert alert-danger\">
                        <strong>Sorry!</strong> You are only allowed to access this page if you are based in Australia!
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