<!DOCTYPE html>
<html>
<head>
<?php include "includes/site_title.php"; ?>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
<?php include "includes/header_files.php"; ?>

</head>

<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
				<div class="panel-body">
					<form role="form" method="post" action="" autocomplete="off">
                        <fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Your Email" value="" name="email" type="email" autofocus="">
                                <span class="text-danger"></span>
                            </div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="pass" type="password" value="">
                                <span class="text-danger"></span>
							</div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In</button>
                            </div>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
    <?php include "includes/footer_files.php"; ?>

</body>

</html>

