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
				<h1 class="page-header">Manage question</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Question</div>
					<div class="panel-body">
						<div class="panel-body">
							<table data-toggle="table" >
								<thead>
									<tr>
										<th data-field="id" data-align="right">Question ID</th>
										<th data-field="catagory">Catagory</th>
										<th data-field="question">Question</th>
										<th data-field="actions">Actions</th>
									</tr>
								</thead>

								<tbody>
									<tr>
										<td>0001</td>
										<td>PHP</td>
										<td>What is php ?</td>
										<td>
											<div class="pull-right action-buttons">
												<a href="#"><svg class="glyph stroked pencil"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-pencil"></use></svg></a>
												
												<a href="#"><svg class="glyph stroked paperclip"><use xlink:href="#stroked-paperclip"/></svg></a>

												<a href="#"><svg class="glyph stroked trash"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-trash"></use></svg></a>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
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
