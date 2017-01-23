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

require 'includes/Db.php';
require 'includes/db.config.php';
$db = Db::instance();

$q_id = $_GET['edit_q'];

if (isset($_POST['add-question-btn'])) {
    $qName = $_POST['question'];
    $qDetails = $_POST["question-details"];
    $category = $_POST["category"];

    if(!empty($qName) && !empty($category)){
        $db_add = $db->create( 'questions', array('category_id' => $category, 'question' => $qName, 'q_details' => $qDetails ) );

        if($db_add)
        {
            //Select recently added Question to provide Add Answer link in Success message.
            $recent_question = mysql_query('SELECT q_id FROM questions ORDER BY q_id DESC LIMIT 0, 1');
            $questionRow=mysql_fetch_array($recent_question);
            var_dump($questionRow[0]);

            $msg = 'Question Added successfully ';
        }
        else
        {
            $error = 'There was a error please try again';
        }
    }else{
        $error = 'please fill required field';
    }
}

if(isset($q_id))
{

//update table
    if (isset($_POST['edit-question-btn'])) {
        $qName = $_POST['question'];
        $qDetails = htmlentities($_POST["question-details"]);
        $category = $_POST["category"];

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
    $to_edit =mysql_query('SELECT * FROM questions where q_id = '.$q_id.'');
    $editRow=mysql_fetch_array($to_edit);

    //Select Questions table
    $to_cat =mysql_query('SELECT * FROM categories where cat_id = '.$editRow[1].'');
    $cat_row=mysql_fetch_array($to_cat);

}

?>


<!DOCTYPE html>
<html>
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
            echo "<form role='form' method='post' action='add_question.php?edit_q=".$q_id."'>";
        }else{
            echo "<form role='form' method='post' action='add_question.php'>";
        }
        ?>
        <form role="form" method="post" action="add_question.php">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Add question</h1>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
                        Question
                        <a class="btn btn-primary btn-sm" href="manage_question.php" role="button"><svg class="glyph stroked tag"><use xlink:href="#stroked-tag"/></svg> Manage Question</a></div>
                    <?php
                    if(isset($questionRow)){?>
                    <a class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Add Answers" href="add_answer.php?add_a=<?php echo $questionRow[0]; ?>"><svg class="glyph stroked paperclip"><use xlink:href="#stroked-paperclip"/></svg>Add Answer</a>
                    <?php } ?>
                </div>
					<div class="panel-body">
						<div class="col-md-8">
                            <?php include "includes/messages.php"; ?>

                                <div class="form-group">
                                    <select class="form-control" name="category" class="category-list">
                                        <?php
                                        if(isset($q_id))
                                        {
                                        ?>
                                            <option value="<?php echo $cat_row[0]; ?>"><?php echo $cat_row[1]; ?></option>
                                        <?php
                                        } else {
                                            ?>
                                        <option selected>Select Category</option>
                                        <?php
                                        }
                                        ?>

                                        <?php
                                        $select = $db->select( 'categories' );
                                        while ( $row = $select->fetch() ) {
                                        ?>
                                        <option value="<?php echo $row->cat_id; ?>"><?php echo $row->cat_name; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input name="question" class="form-control question" value="<?php echo $editRow[2]; ?>" placeholder="question">
                                </div>
                                <div class="form-group">
                                    <textarea name="question-details" class="form-control question-details editor" placeholder="question Details" rows="3"><?php echo $editRow[3]; ?></textarea>
                                </div>
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
                            <?php
                            if(isset($q_id))
                            {
                            ?>
                            <button type="submit" name="edit-question-btn" class="btn btn-primary edit-question-btn btn-lg"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"/></svg>Edit Question</button>
                            <?php
                            } else {
                            ?>
                            <button type="submit" name="add-question-btn" class="btn btn-primary add-question-btn btn-lg"><svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg>Add Question</button>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>

            </div>
        </form>
        </div>
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
