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
				<h1 class="page-header">Add question</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Question</div>
					<div class="panel-body">
						<div class="col-md-8">
							<form role="form" method="post" action="">
								<div class="form-group">
									<label>Question Type</label>
									<select class="form-control">
										<option>Option 1</option>
										<option>Option 2</option>
										<option>Option 3</option>
										<option>Option 4</option>
									</select>
								</div>
                                <div class="form-group">
                                    <textarea name="category-details" class="form-control category-details editor" placeholder="Category Details" rows="3"></textarea>
                                </div>
							</div>
						</form>
					</div>
				</div>
			</div><!-- /.col-->

		</div><!-- /.row -->
		
	<div class="row">
		<div class="col-lg-12 answerers-panel">
			<div class="panel panel-default">
				<div class="panel-heading">Answerers</div>
				<div class="panel-body">
				<div class="col-md-12 answerers">
					<div class="answerer-1">
						<div class="form-group col-md-6">
							<textarea id="answerer-1" name="answerer-1" class="form-control editor" placeholder="Answerers" rows="3"></textarea>
						</div>
						<div class="form-group col-md-3">
							<input id="mark-1" name="mark-1" class="form-control" placeholder="Marks">
						</div>
						<div class="form-group col-md-3">
							
						</div>
					</div>
				</div>
					<button type="submit" name="add-category-btn" class="btn btn-primary add-answer">Add Answerer</button>
				</div>
			</div><!-- /.col-->
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
