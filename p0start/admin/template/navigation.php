<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	
	<div class="container-fluid">
    	<!-- Brand and toggle get grouped for better mobile display -->
    	<div class="navbar-header">
      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
	      	</button>
	    </div>

    	<!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	      	
	        <li><a href="?page=dashboard">Dashboard</a></li>
	        <li><a href="?page=pages">Pages</a></li>
	        <li><a href="?page=navigation">Navigation</a></li>
	        <li><a href="?page=users">Users</a></li>
	        <li><a href="?page=settings">Settings</a></li>
	        <li><a href="?page=clients">Clients</a></li>
	        
	      </ul>
	      
	      <ul class="nav navbar-nav navbar-right">
				<li>
					<?php if($debug == 1) { ?>
						<button type="button" id="btn-debug" class="btn btn-default navbar-btn"><i class="fa fa-bug"></i></button>
					<?php } ?>
				</li>
				
	      		<li class="dropdown">
	      			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $user['fullname'].' '; ?><b class="caret"></b></a>
	      			<ul class="dropdown-menu">
	      				<li><a href="#">Account</a></li>
	      				<li><a href="#">Help</a></li>
	      				<li><a href="#">Contact</a></li>
	      				<li class="divider"></li>
	      				<li><a href="logout.php">Logout</a></li>
	      			</ul>
	      		</li>
	      		
	      </ul>

	    </div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav><!-- END NAVBAR -->
