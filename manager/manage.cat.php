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

if (isset($_POST['add-category-btn'])) {
    $catName = $_POST['category-name'];
    $catDetails = $_POST["category-details"];

    if(!empty($catName) && !empty($catName)){
        $db->create( 'categories', array( 'cat_name' => $catName,  'cat_details' => $catDetails ) );
    }
}

if(isset($_GET['edit-cat'])){
    echo "App = ".$_GET['app'];
    var_dump($_GET['edit-cat']);
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
				<h1 class="page-header">Manage Categories</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">Add New Category</div>
					<div class="panel-body">
						<div class="col-md-6">
                            <form role="form" method="post" action="manage.cat.php">
                                <div class="form-group">
                                    <input name="category-name" class="form-control category-name" placeholder="Category Name">
                                </div>

                                <div class="form-group">
                                    <textarea name="category-details" class="form-control category-details" placeholder="Category Details" rows="3"></textarea>
                                </div>

                                <button type="submit" name="add-category-btn" class="btn btn-primary ">Add Category</button>
                        </div>
                        </form>
					</div>
				</div>
			</div><!-- /.col-->

            <div class="col-md-6">
                <div class="panel panel-default category-list">
                    <div class="panel-heading">Category List.</div>
                    <div class="panel-body">
                        <table data-toggle="table">
                            <thead>
                            <tr>
                                <th data-field="id" data-align="right">Item ID</th>
                                <th data-field="name">Name</th>
                                <th data-field="price">Actions</th>
                            </tr>
                            </thead>
                            <?php
                            $select = $db->select( 'categories' );
                            while ( $row = $select->fetch() ) {
                                ?>
                                <tr>
                                    <td><?php echo $row->cat_id; ?></td>
                                    <td><?php echo $row->cat_name; ?></td>
                                    <td>
                                        <div class="pull-right action-buttons">
                                            <a href="?edit-cat=<?php echo $row->cat_id; ?>"><svg class="glyph stroked pencil"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-pencil"></use></svg></a>
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
