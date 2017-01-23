<?php
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


$edit_quiz= $_GET['edit_quiz'];
$publish_quiz= $_GET['publish_quiz'];
$unpublish_quiz= $_GET['unpublish_quiz'];
$delete_quiz= $_GET['delete_quiz'];

if (isset($_POST['add-quiz-btn'])) {
    $quiz_name = $_POST["quiz_name"];
    $quiz_details = htmlentities($_POST["quiz_details"]);
    $questions = $_POST["questions"];
    if(!empty($quiz_name) && !empty($questions)){

        $add_q = "INSERT INTO quiz (quiz_name, quiz_details, questions, publish)
                  VALUES ('$quiz_name', '$quiz_details', '$questions', 0)";
        $db_add = mysql_query($add_q);

        if($db_add)
        {
            $msg = 'Quiz Added';
        }
        else
        {
            $error = 'There was a error please try again';
        }
    }else{
        $error = 'please fill required field';
    }
}

if(isset($edit_quiz))
{
//update table
    if (isset($_POST['edit-quiz-btn'])) {
        $quiz_name = $_POST["quiz_name"];
        $quiz_details = htmlentities($_POST["quiz_details"]);
        $questions = $_POST["questions"];
        echo $questions;

        if(!empty($quiz_name) && !empty($questions)){
            $update_q = 'UPDATE quiz SET `quiz_name` = "'.$quiz_name.'", `quiz_details` = "'.$quiz_details.'", `questions` = "'.$questions.'"  WHERE quiz_id = '.$edit_quiz.'';
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

    //Select Quiz table to edit
    $to_edit = mysql_query('SELECT * FROM quiz where quiz_id = '.$edit_quiz.'');
    $editRow=mysql_fetch_array($to_edit);
}

//publish Quiz
if(isset($publish_quiz))
{
    $update_q = 'UPDATE quiz SET `publish` = 1 WHERE quiz_id = '.$publish_quiz.'';
    $db_update = mysql_query($update_q);
    if($db_update)
    {
        $msg = 'Quiz published successfully';
    }
    else
    {
        $error = 'There was a error please try again';
    }
}

//Unpublish Quiz
if(isset($unpublish_quiz))
{
    $update_q = 'UPDATE quiz SET `publish` = 0 WHERE quiz_id = '.$unpublish_quiz.'';
    $db_update = mysql_query($update_q);
    if($db_update)
    {
        $msg = 'Quiz Unpublished successfully';
    }
    else
    {
        $error = 'There was a error please try again';
    }
}

//Delete Quiz
if(isset($delete_quiz))
{
    $delete_q = 'DELETE FROM quiz WHERE quiz_id = '.$delete_quiz.'';
    $db_delete = mysql_query($delete_q);
    if($db_delete)
    {
        $msg = 'Quiz Delete successfully';
    }
    else
    {
        $error = 'There was a error please try again';
    }
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

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Quiz</h1>
        </div>
    </div><!--/.row-->

    <div class="row"><?php include "includes/messages.php"; ?>
        <?php
        if(isset($edit_quiz))
        {
            echo "<form role='form' method='post' action='add_quiz.php?edit_quiz=".$edit_quiz."'>";
        }else{
            echo "<form role='form' method='post' action='add_quiz.php'>";

        }
        ?>
        <div class="col-lg-6 quiz-panel">
            <div class="panel panel-default">
                <div class="panel-heading">Quiz</div>
                <div class="panel-body">

                    <div class="col-md-12">
                            <div class="form-group">
                                <input id="quiz_name" value="<?php echo $editRow[1]; ?>" name="quiz_name" class="form-control" placeholder="quiz_name">
                            </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea id="quiz_details" name="quiz_details" class="form-control editor" rows="3"><?php echo $editRow[2]; ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input id="questions" name="questions" value="<?php echo $editRow[3]; ?>" class="form-control" placeholder="questions">
                        </div>
                    </div>

                </div>
            </div><!-- /.col-->

            <div class="col-lg-12 answers-panel">
                <div class="panel-body">
                    <div class="col-md-8 "></div>
                    <div class="col-md-4 ">
                        <?php
                        if(isset($edit_quiz))
                        {
                            ?>
                            <button type="submit" name="edit-quiz-btn" class="btn btn-primary edit-quiz-btn btn-lg"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"/></svg>  Edit Quiz</button>
                        <?php
                        } else {
                            ?>
                            <button type="submit" name="add-quiz-btn" class="btn btn-primary add-quiz-btn btn-lg"><svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg>Add Quiz</button>
                        <?php
                        }
                        ?>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            </form>
        </div>

        <div class="col-lg-6 quiz-panel">
        <div class="panel panel-default">
            <div class="panel-heading">Quiz</div>
            <div class="panel-body">
                <table data-toggle="table">
                    <thead>
                    <tr>
                        <th data-field="id" data-align="right">Quiz ID</th>
                        <th data-field="name">Name</th>
                        <th data-field="price">Actions</th>
                    </tr>
                    </thead>
                    <?php
                    $quiz_select = mysql_query('SELECT * FROM quiz ORDER BY quiz_id DESC');
                    $quiz_result = mysql_num_rows($quiz_select);

                    if($quiz_result > 0){
                    while ( $quiz_row = mysql_fetch_assoc($quiz_select) ) {

                        ?>
                        <tr>
                            <td><?php echo $quiz_row[quiz_id]; ?></td>
                            <td><?php echo $quiz_row[quiz_name]; ?></td>
                            <td>
                                <div class="pull-right action-buttons">
                                    <?php
                                    if($quiz_row[publish] == 0)
                                    {
                                    ?>
                                    <a href="?publish_quiz=<?php echo $quiz_row[quiz_id]; ?>"><svg class="glyph stroked sound on"><use xlink:href="#stroked-sound-on"/></svg></a>
                                     <?php
                                    }else{
                                     ?>
                                        <a href="?unpublish_quiz=<?php echo $quiz_row[quiz_id]; ?>"><svg class="glyph stroked hourglass"><use xlink:href="#stroked-hourglass"/></svg></a>
                                    <?php
                                    }
                                    ?>
                                        <a href="?edit_quiz=<?php echo $quiz_row[quiz_id]; ?>"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"/></svg>

                                        <a class="delete-btn" href="?delete_quiz=<?php echo $quiz_row[quiz_id]; ?>"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"/></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    }
                    ?>
                </table>
            </div>
        </div><!-- /.col-->


    </div>


    </div><!-- /.row -->

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