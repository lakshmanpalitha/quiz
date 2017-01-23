<?php
session_start();
require_once 'manager/dbconnect.php';

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
                <?php
                    $quiz_select = mysql_query('SELECT * FROM quiz ORDER BY quiz_id DESC');
                    $quiz_result = mysql_num_rows($quiz_select);

                    if($quiz_result > 0){
                    while ( $quiz_row = mysql_fetch_assoc($quiz_select) ) {

                ?>

                <div class="col-md-6 portfolio-item">
                    <h3>
                        <a href="#"><?php echo $quiz_row[quiz_name]; ?></a>
                    </h3>
                    <div class="details">
                        <?php echo html_entity_decode($quiz_row[quiz_details]); ?>
                    </div>
                    <div class="button-group">
                        <a class="btn btn-primary" href="challenge.php?challenge=<?php echo base64_encode($quiz_row[quiz_id]); ?>" role="button">
                            Accept Challenge</a>
                    </div>
                </div>
                <?php } } ?>
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
