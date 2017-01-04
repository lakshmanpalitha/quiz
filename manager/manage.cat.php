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
                                <th data-field="id" data-align="right">Cat ID</th>
                                <th data-field="name">Name</th>
                                <th data-field="actions">Actions</th>
                            </tr>
                            </thead>
                            <tr>
                                <td>001</td>
                                <td>HTML</td>
                                <td>
                                    <div class="pull-right action-buttons">
                                        <a href="?edit-cat="><svg class="glyph stroked pencil"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-pencil"></use></svg></a>
                                    </div>
                                </td>
								<tr>
                                <td>002</td>
                                <td>PHP</td>
                                <td>
                                    <div class="pull-right action-buttons">
                                        <a href="?edit-cat="><svg class="glyph stroked pencil"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-pencil"></use></svg></a>
                                    </div>
                                </td>
                            </tr>
                            </tr>
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
