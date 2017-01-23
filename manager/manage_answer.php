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

$delete_answer = $_GET['delete_answer'];

//Delete Answer
if(isset($delete_answer))
{
    $delete_q = 'DELETE FROM answers WHERE a_id = '.$delete_answer.'';
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
				<h1 class="page-header">Manage Answers</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
            <div class="col-md-12">
                <div class="panel panel-default category-list">
                    <div class="panel-heading">Category List.</div>
                    <div class="panel-body">
                        <table data-toggle="table">
                            <thead>
                            <tr>
                                <th data-align="right">Answer ID</th>
                                <th>Question ID</th>
                                <th>Question</th>
                                <th>First Answer</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <?php
                            $answers_select = mysql_query('SELECT * FROM answers ORDER BY a_id DESC');
                            $answers_result = mysql_num_rows($answers_select);

                            if($answers_result > 0){
                                while ( $answers_row = mysql_fetch_assoc($answers_select) ) {

                                    ?>
                                    <tr>
                                        <td><?php echo $answers_row[a_id]; ?></td>
                                        <td><?php echo $answers_row[q_id]; ?></td>
                                        <td>
                                            <?php
                                            //Select Questions table
                                            $to_display =mysql_query('SELECT * FROM questions where q_id = '.$answers_row[q_id].'');
                                            $displayRow=mysql_fetch_array($to_display);
                                            echo $displayRow[2];
                                            ?>
                                        </td>
                                        <td><?php echo html_entity_decode($answers_row[answer_1]); ?></td>
                                        <td>
                                            <div class="pull-right action-buttons">

                                                <a data-toggle="tooltip" data-placement="top" title="Edit Answer" href="add_answer.php?edit_a=<?php echo $answers_row[q_id]; ?>"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"/></svg>
                                                <a data-toggle="tooltip" data-placement="top" title="Delete Answer" class="delete-btn" href="?delete_answer=<?php echo $answers_row[a_id]; ?>"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"/></svg></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
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
