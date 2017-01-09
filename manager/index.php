
<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// it will never let you open index(login) page if session is set
if ( isset($_SESSION['user'])!="" ) {
    header("Location: home.php");
    exit;
}

$error = false;

if( isset($_POST['btn-login']) ) {

    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    // prevent sql injections / clear user invalid inputs

    if(empty($email)){
        $error = true;
        $emailError = "Please enter your email address.";
    } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }

    if(empty($pass)){
        $error = true;
        $passError = "Please enter your password.";
    }

    // if there's no error, continue to login
    if (!$error) {

        $password = hash('sha256', $pass); // password hashing using SHA256

        $res=mysql_query("SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");
        $row=mysql_fetch_array($res);
        $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row

        if( $count == 1 && $row['userPass']==$password ) {
            $_SESSION['user'] = $row['userId'];
            header("Location: home.php");
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
        }

    }

}
?>
<!DOCTYPE html>
<html>
<head>
<?php include "includes/site_title.php"; ?>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
<?php include "includes/header_files.php"; ?>

</head>

<body>
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">Log in</div>
            <div class="panel-body">
                <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                    <?php
                    if ( isset($errMSG) ) {

                        ?>
                        <div class="form-group">
                            <div class="alert alert-danger">
                                <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" name="email" type="text" autofocus="">
                            <span class="text-danger"><?php echo $emailError; ?></span>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="pass" type="password" value="">
                            <span class="text-danger"><?php echo $passError; ?></span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In</button>
                        </div>

                        <!--							<a href="index.html" class="btn btn-primary">Login</a>-->
                    </fieldset>
                </form>
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->
    <?php include "includes/footer_files.php"; ?>

</body>

</html>

