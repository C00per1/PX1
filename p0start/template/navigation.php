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
	      	<?php nav_main($dbc, $path) ?>
	      	
	      	
	        <!--<li><a href="#">FAQ</a></li>
	        <li><a href="#">Contact</a></li>-->
	      </ul>
	      
	      <?php if($debug == 1) { ?>
	      <ul class="navbar-right">
	      	<button class="btn btn-info btn-xs" id="btn-debug"><i class="fa fa-bug"></i></button>
	      </ul>
	      <?php } ?>
	    </div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav><!-- END NAVBAR -->