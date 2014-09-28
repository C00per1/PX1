<?php 

#Start Session:
session_start();

#Database Connection
include('../config/connection.php');

if($_POST) {
	
	$q = "SELECT * FROM users WHERE email = '$_POST[email]' AND password = SHA1('$_POST[password]')";
	$r = mysqli_query($dbc, $q);
	
	if(mysqli_num_rows($r) == 1) {
		
		$_SESSION['username'] = $_POST['email'];
		header('Location: index.php');
		
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Admin Login</title>
		<meta name="viewport" content="width=device-width, intial-scale=1.0">
		
		<?php include('config/css.php'); ?>
		
		<?php include('config/js.php'); ?>
		
	</head>
	
	<body id="authentication">
		<div id="wrap">
			<?php //include(D_TEMPLATE.'/navigation.php'); // Main Navigation ?>
			
			<div class="container" id="signin">
				
				<div class="row">
				
					<div class="col-md-4 col-md-offset-4">
						<div class="row">
							<div class="col-md-1" style="margin-left: 37%; margin-top: 20%">
								<i class="fa fa-cube fa-5x"></i>
							</div>
						</div>
						<div class="panel panel-default">
						
							<div class="panel-heading login">
								<div class="row">
									<h4><strong>Login</strong></h4>
								</div>			
							</div><!-- END panel-heading -->
								
							<div class="panel-body login">
								
								<form class="form-signin" action="login.php" method="post" role="form">
							
									<input type="email" class="form-control" placeholder="Email" name="email">
									<input type="password" class="form-control" placeholder="Password" name="password">
									
									<button class="btn btn-md btn-submit btn-block" type="submit">Sign in</button>
								
								</form><!-- END form -->
								
							</div><!-- END panel-body -->
								
						</div><!-- End panel -->
						
					</div><!-- END col -->
				
				</div><!-- END row -->
				
			</div><!-- END container -->
			
		</div><!-- END Wrap -->
		
		<?php //include(D_TEMPLATE.'/footer.php'); // Page Footer ?>
		
		<?php //if($debug ==1) { include('widgets/debug.php'); } //Debug Widget ?>
		
	</body>
</html>