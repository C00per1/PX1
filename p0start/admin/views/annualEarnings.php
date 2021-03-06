<?php include('functions/clientData.php'); ?>

<div class="container"
	<div class="col-md-10 col-md-offset-1">
		<div class="row">
			<div class="col-md-3" style="padding-bottom: 20px">
				<h2 class="title" style="padding-left: 10px">Yearly Earnings</h2>
			</div><!-- END modal-header -->

			<!--<div class="col-md-8 alert alert-warning alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;&nbsp;Enter the amount of Social Security earnings for each year you had earnings subject to Social Security taxes.
			</div>-->
		</div>
		
		<?php if(isset($message)) { echo $message; }; ?>
		
		<form action="?page=annualEarnings&id=<?php echo $opened['id']; ?>" id="piaCalc" method="post" role="form">		
			<div class="row">		
				<div style="margin: 0 20px">
					<?php
					$earningsDb = unserialize($opened['annualEarnings']);
					$z = 0;
					$start = $dobYear + 20;
					$end = $dobYear + 70;
					for($i = $start; $i <= $end; $i+=1) { ?>
					<div class="form-group col-md-2" style="padding: 10px">
						<div class="input-group">
							<span class="input-group-addon"><?php echo $i; ?></span>
							<input class="form-control piaCalc" type="text" id="<?php echo $i; ?>" name="income[]" value="<?php echo $earningsDb[$z]; ?>" style="text-align: center" autocomplete="off" />
						</div><!-- END input -->
			      	</div><!-- END col-md-4 -->
			      	<?php $z++; } ?>
			      	<div id"messages" class="hide"></div>
		      	</div>
		     </div>
		     
		     <div class="row">
		      	<div class="pull-right">
					<a type="button" href="?page=clientoverview&id=<?php echo $opened['id']; ?>" class="btn btn-default btn-lg">Close</a>	
					<button type="submit" class="btn btn-primary btn-lg">Save</button>
				</div>
			
	    	</div>
	    	
    		<input type="hidden" name="year" value="<?php echo $start; ?>" />
			
			<input type="hidden" name="openedid" value="<?php echo $opened['id']; ?>" />
	    	
	    	<input type="hidden" name="submitted" value="1" />
	    </form>
		
	</div>
	
</div><!-- END container -->