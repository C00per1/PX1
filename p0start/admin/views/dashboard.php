<body class="animated fadeIn">
	<section class="section">
		<div class="content">
			<div class="row margin-top">
				<div class="col-md-12 content-header">
						<h2 class="content-title">Welcome to the Dashboard</h2>
				</div><!-- END content-header -->
			</div>
			<div class="row">
				<div class="col-md-12 content-body" style="padding-right: 25px; padding-left: 25px">
				    <div class="row margin-top">
						<div id="system-stats">
								
								<?php include('widgets/datapanel.php') ; ?>
							
								<?php include('widgets/weather.php') ; ?>
								
								<?php// include('widgets/screenleap.php') ; ?>
								
						</div><!--/#system-stats-->
					</div><!-- END row -->
				</div><!-- END content-body -->
			</div>
		</div><!-- END content -->
	</section><!-- END section -->
</body><!-- END body -->
