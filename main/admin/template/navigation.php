<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	
	<div class="container-fluid" style="background-color: #507795">
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
	    <div class="collapse navbar-collapse">
	      <ul class="nav navbar-nav">
	      	<li><a href="?page=dashboard"><i class="fa fa-yelp fa-2x"  style="color: #ffffff"></i></a></li>
	      </ul>
	      
	      <ul class="nav navbar-nav navbar-right">
				<li>
					<?php if($debug == 1) { ?>
						<button type="button" id="btn-debug" class="btn btn-default navbar-btn"><i class="fa fa-bug"></i></button>
					<?php } ?>
				</li>
				
	      		<li class="dropdown">
	      			<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #ffffff"><?php echo $user['fullname'].' '; ?><b class="caret"></b></a>
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

