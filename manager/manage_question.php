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
            <div class="col-md-12">
                <div class="panel panel-default category-list">
                    <div class="panel-heading">Category List.</div>
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
                                            <a href="add_question.php?edit_q=<?php echo $row->q_id; ?>"><svg class="glyph stroked pencil"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-pencil"></use></svg></a>
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
