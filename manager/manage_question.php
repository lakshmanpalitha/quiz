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


$delete_q = $_GET['delete_question'];

//Delete Quiz
if(isset($delete_q))
{
    $delete_question = 'DELETE FROM questions WHERE q_id = '.$delete_q.'';
    $db_delete = mysql_query($delete_question);
    if($db_delete)
    {
        $msg = 'Question Delete successfully';
    }
    else
    {
        $error = 'There was a error please try again';
    }
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
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Manage Questions</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
            <?php include "includes/messages.php"; ?>
            <div class="col-md-12">
                <div class="panel panel-default category-list">
                    <div class="panel-heading">
                        Questions List.
                        <a class="btn btn-primary btn-sm" href="add_question.php" role="button"><svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg> Add New Question</a></div>
                    <div class="panel-body">
                        <table data-toggle="table">
                            <thead>
                            <tr>
                                <th data-field="id" data-align="right">Item ID</th>
                                <th data-field="category">Category</th>
                                <th data-field="question">Question</th>
                                <th data-field="actions">Actions</th>
                            </tr>
                            </thead>
                            <?php
                            $select = $db->select( 'questions' );
                            while ( $row = $select->fetch() ) {
                                ?>
                                <tr>
                                    <td><?php echo $row->q_id; ?></td>
                                    <td><?php echo $row->category_id; ?></td>
                                    <td><?php echo $row->question; ?></td>

                                    <td>
                                        <div class="pull-right action-buttons">
                                            <a data-toggle="tooltip" data-placement="left" title="Edit Question" href="add_question.php?edit_q=<?php echo $row->q_id; ?>"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a>
                                            <?php
                                            $answers_select = mysql_query('SELECT * FROM answers WHERE q_id = '.$row->q_id.'');
                                            $answers_result = mysql_num_rows($answers_select);
                                            if($answers_result > 0){
                                            ?>
                                            <a data-toggle="tooltip" data-placement="left" title="Edit Answers" href="add_answer.php?edit_a=<?php echo $row->q_id; ?>"><svg class="glyph stroked pen tip"><use xlink:href="#stroked-pen-tip"/></svg></a>
                                            <?php
                                            }else{
                                            ?>
                                                <a data-toggle="tooltip" data-placement="left" title="Add Answers" href="add_answer.php?add_a=<?php echo $row->q_id; ?>"><svg class="glyph stroked paperclip"><use xlink:href="#stroked-paperclip"/></svg></a>
                                            <?php
                                            }
                                            ?>
                                            <a data-toggle="tooltip" data-placement="left" class="delete-btn" title="Delete Question" href="manage_question.php?delete_question=<?php echo $row->q_id; ?>"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"/></svg></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
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
