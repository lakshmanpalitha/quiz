<?php
session_start();
$session = session_id();

require_once 'manager/dbconnect.php';
$challenge_id = base64_decode($_GET['challenge']);

//Select Questions table
$select_challenge =mysql_query('SELECT * FROM quiz where quiz_id = '.$challenge_id.'');
$challenge_row = mysql_fetch_array($select_challenge);

$question_list = explode(",", $challenge_row[3]);


//session work
$_SESSION["next_question"] = 1;
$currant_question = $_SESSION["next_question"] - 1;


//Select Currant question
$select_question =mysql_query('SELECT * FROM questions where q_id = '.$question_list[$currant_question].'');
$question_row = mysql_fetch_array($select_question);


//answers for current question
$select_answer =mysql_query('SELECT * FROM answers where q_id = '.$question_list[$currant_question].'');
$answer_row = mysql_fetch_array($select_answer);


var_dump($question_list);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WEB Site</title>
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
                    <small id="seconds"></small>
                    <?php echo $session; ?>
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
                    <div class="question">
                        <?php echo $question_row[2]; ?>
                    </div>
                    <div class="answers-block">
                        <?php if(!empty($answer_row[2])){ ?>
                        <div class="answer"  ><span><input type="checkbox" value="7"> </span><span><?php echo html_entity_decode ($answer_row[2]); ?></span></div>
                        <?php } ?>
                        <?php if(!empty($answer_row[3])){ ?>
                        <div class="answer"  ><span><input type="checkbox" value="8"></span><span><?php echo html_entity_decode ($answer_row[3]); ?></span></div>
                        <?php } ?>
                        <?php if(!empty($answer_row[4])){ ?>
                        <div class="answer"  ><span><input type="checkbox" value="9"></span><span><?php echo html_entity_decode ($answer_row[4]); ?></span></div>
                        <?php } ?>
                        <?php if(!empty($answer_row[5])){ ?>
                        <div class="answer"  ><span><input type="checkbox" value="10"></span><span><?php echo html_entity_decode ($answer_row[5]); ?></span></div>
                        <?php } ?>
                        <?php if(!empty($answer_row[6])){ ?>
                        <div class="answer"  ><span><input type="checkbox" value="11"></span><span><?php echo html_entity_decode ($answer_row[6]); ?></span></div>
                        <?php } ?>
                    </div>
                    <div class="button-group">
                        <a id="btn_next" class="btn btn-next" href="quiz.php?challenge=<?php echo base64_encode("$challenge_row[0]"); ?>" role="button">
                            Next > </a>
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
    <?php include "includes/footer_files.php"; ?>
<input type="hidden" id="time-counter">

</body>

<script>

    $(document).ready(function () {

        $('#btn_next').click(function(e) {
            e.preventDefault();
            var quiz_id = '<?php echo $_GET['challenge']; ?>',
                question_id = '<?php echo $question_list[$currant_question]; ?>',
                //question_number = '<?php echo $question_list[$currant_question]; ?>',
                answer ='',
                time = $('#time-counter').val();

            console.log(question_id);

//            $.ajax({
//                url: "demo_test.txt",
//                type: 'post',
//                data: {'action': 'follow', 'userid': '11239528343'},
//                success: function(result){
//                    $("#div1").html(result);
//                },
//                error: function(xhr, desc, err) {
//                    console.log(xhr);
//                    console.log("Details: " + desc + "\nError:" + err);
//                }
//            });
        });

    });



</script>

</html>
