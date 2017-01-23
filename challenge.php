<?php
session_start();
$session = session_id();
var_dump($session);
require_once 'manager/dbconnect.php';

$challenge_id = base64_decode($_GET['challenge']);

//Select Questions table
$select_challenge =mysql_query('SELECT * FROM quiz where quiz_id = '.$challenge_id.'');
$challenge_row = mysql_fetch_array($select_challenge);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>3 Col Portfolio - Start Bootstrap Template</title>
    <?php include "includes/header_files.php"; ?>

</head>

<body>
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Page Heading
                    <small>Secondary Text</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row col-md-12">
            <div class="left-col col-md-8">
                <div class="col-md-6 portfolio-item">
                    <h3>
                    <?php echo $challenge_row[1]; ?>
                    </h3>
                    <div class="details">
                        <?php echo html_entity_decode($challenge_row[2]); ?>
                    </div>
                    <div class="button-group">
                        <a class="btn btn-primary" href="quiz.php?challenge=<?php echo base64_encode("$challenge_row[0]"); ?>" role="button">
                            Start Challenge</a>
                    </div>
                </div>
            </div>
            <div class="right-col col-md-4">
                <?php include "includes/side_bar.php"; ?>
            </div>
        </div>
        <!-- /.row -->



        <!-- Footer -->
        <?php include "includes/footer.php"; ?>

    </div>
    <!-- /.container -->
    <?php include "includes/header_files.php"; ?>


</body>

</html>
