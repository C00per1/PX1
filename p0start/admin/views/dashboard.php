
<section class="section">
	<div class="row" style="margin-top: 50px">
	
		<?php include('template/sidebar.php'); ?>
		
		<div id="fixedContent" class="margin-top col-xs-10 col-sm-10">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 content-header">
						<h1 class="content-title">Welcome to the Dashboard</h1>
					</div><!-- END content-header -->
				</div>
			</div>
			<div class="container-fluid" style="margin-top: 2%">
				<div class="row">
					<div class="col-md-12 content-body" style="padding-right: 25px; padding-left: 25px">
					    <div class="row margin-top">
							<div id="system-stats">
									
									<?php include('widgets/datapanel.php') ; ?>
								
									<?php include('widgets/weather.php') ; ?>
									
									<?php include('widgets/screenleap.php') ; ?>
									
							</div><!--/#system-stats-->
						</div><!-- END row -->
					</div><!-- END content-body -->
				</div>
			</div>
		</div><!-- END content -->
	</div>
</section><!-- END section -->

