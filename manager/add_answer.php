<?php
ob_start();
session_start();
require_once 'dbconnect.php';


// if session is not set this will redirect to login page
if( !isset($_SESSION['user']) ) {
    header("Location: index.php");
    exit;
}
// select loggedin users detail
$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);


$q_id = $_GET['edit_a'];

if (isset($_POST['add-answer-btn'])) {
    $answer1 = htmlentities($_POST["answer-1"]);
    $answer2 = htmlentities($_POST["answer-2"]);
    $answer3 = htmlentities($_POST["answer-3"]);
    $answer4 = htmlentities($_POST["answer-4"]);
    $answer5 = htmlentities($_POST["answer-5"]);
    $mark1 = $_POST["mark-1"];
    $mark2 = $_POST["mark-2"];
    $mark3 = $_POST["mark-3"];
    $mark4 = $_POST["mark-4"];
    $mark5 = $_POST["mark-5"];
    if(!empty($answer1) && !empty($mark1)){

        $add_q = "INSERT INTO answers (q_id, answer_1, answer_2, answer_3, answer_4, answer_5, mark_1, mark_2, mark_3, mark_4, mark_5)
                  VALUES ('.$q_id.', '.$answer1.', '.$answer2.', '.$answer3.', '.$answer4.', '.$answer5.', '.$mark1.', '.$mark2.', '.$mark3.', '.$mark4.', '.$mark5.' )";
        $db_add = mysql_query($add_q);

        if($db_add)
        {
            $msg = 'Answer Added';
        }
        else
        {
            $error = 'There was a error please try again';
        }
    }else{
        $error = 'please fill required field';
    }
}

if(isset($q_idg))
{
//update table
    if (isset($_POST['edit-question-btn'])) {
        $answer1 = htmlentities($_POST["answer-1"]);
        $answer2 = htmlentities($_POST["answer-1"]);
        $answer3 = htmlentities($_POST["answer-1"]);
        $answer4 = htmlentities($_POST["answer-1"]);
        $answer5 = htmlentities($_POST["answer-1"]);
        $mark1 = $_POST["mark-1"];
        $mark2 = $_POST["mark-2"];
        $mark3 = $_POST["mark-3"];
        $mark4 = $_POST["mark-4"];
        $mark4 = $_POST["mark-5"];


        if(!empty($qName) && !empty($category)){

            $update_q = 'UPDATE questions SET `category_id` = '.$category.',  `question` = "'.$qName.'", `q_details` = "'.$qDetails.'" WHERE q_id = '.$q_id.'';
            $db_update = mysql_query($update_q);
            if($db_update)
            {
                $msg = 'Record updated successfully';
            }
            else
            {
                $error = 'There was a error please try again';
            }
        }else{
            $error = 'please fill required field';
        }
    }

    //Select Questions table
    //$to_edit =mysql_query('SELECT * FROM questions where q_id = '.$q_id.'');
   // $editRow=mysql_fetch_array($to_edit);

    //Select Questions table
   // $to_cat =mysql_query('SELECT * FROM categories where cat_id = '.$editRow[1].'');
   // $cat_row=mysql_fetch_array($to_cat);

}

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <?php include "includes/site_title.php"; ?>
    <?php include "includes/header_files.php"; ?>
</head>
<body>
<?php include "includes/site_header.php"; ?>
<?php include "includes/side_bar.php"; ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <?php
    if(isset($q_id))
    {
        echo "<form role='form' method='post' action='add_answer.php?edit_a=".$q_id."'>";
    }else{
        //echo "<form role='form' method='post' action='add_answer.php'>";
        echo "<form role='form' method='post' action='add_answer.php?edit_a=".$q_id."'>";
    }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Answers</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12 answers-panel">
            <div class="panel panel-default">
                <div class="panel-heading">answers</div>
                <div class="panel-body">
                    <?php include "includes/messages.php"; ?>
                    <div class="col-md-12 answers">
                        <div class="answer-1">
                            <div class="form-group col-md-6">
                                <textarea id="answer-1" name="answer-1" class="form-control editor" placeholder="answers" rows="3">lakshman</textarea>
                            </div>
                            <div class="form-group col-md-3">
                                <input id="mark-1" name="mark-1" class="form-control" placeholder="Marks">
                            </div>
                            <div class="form-group col-md-3"> </div>
                        </div>
                    </div>
                    <div class="col-md-12 answers">
                        <div class="answer-2">
                            <div class="form-group col-md-6">
                                <textarea id="answer-2" name="answer-2" class="form-control editor" placeholder="answers" rows="3">lakshman</textarea>
                            </div>
                            <div class="form-group col-md-3">
                                <input id="mark-2" name="mark-2" class="form-control" placeholder="Marks">
                            </div>
                            <div class="form-group col-md-3"> </div>
                        </div>
                    </div>
                    <div class="col-md-12 answers">
                        <div class="answer-3">
                            <div class="form-group col-md-6">
                                <textarea id="answer-3" name="answer-3" class="form-control editor" placeholder="answers" rows="3">lakshman</textarea>
                            </div>
                            <div class="form-group col-md-3">
                                <input id="mark-3" name="mark-3" class="form-control" placeholder="Marks">
                            </div>
                            <div class="form-group col-md-3"> </div>
                        </div>
                    </div>
                    <div class="col-md-12 answers">
                        <div class="answer-4">
                            <div class="form-group col-md-6">
                                <textarea id="answer-4" name="answer-4" class="form-control editor" placeholder="answers" rows="3">lakshman</textarea>
                            </div>
                            <div class="form-group col-md-3">
                                <input id="mark-4" name="mark-4" class="form-control" placeholder="Marks">
                            </div>
                            <div class="form-group col-md-3"> </div>
                        </div>
                    </div>
                    <div class="col-md-12 answers">
                        <div class="answer-1">
                            <div class="form-group col-md-6">
                                <textarea id="answer-5" name="answer-5" class="form-control editor" placeholder="answers" rows="3">lakshman</textarea>
                            </div>
                            <div class="form-group col-md-3">
                                <input id="mark-5" name="mark-5" class="form-control" placeholder="Marks">
                            </div>
                            <div class="form-group col-md-3"> </div>
                        </div>
                    </div>


                </div>
            </div><!-- /.col-->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-lg-12 answers-panel">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-8 "></div>
                        <div class="col-md-4 ">
                            <button type="submit" name="add-answer-btn" class="btn btn-primary add-answer-btn btn-lg"><svg class="glyph stroked plus sign"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-plus-sign"></use></svg>Add Answer</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>

            </div>
        </div>
        </form>
    </div><!--/.main-->


    <?php include "includes/footer_files.php"; ?>

    <script>
        !function ($) {
            $(document).on("click","ul.nav li.parent > a > span.icon", function(){
                $(this).find('em:first').toggleClass("glyphicon-minus");
            });
            $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
        }(window.jQuery);

        $(window).on('resize', function () {
            if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
        })
        $(window).on('resize', function () {
            if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
        })
    </script>
</body>

</html>