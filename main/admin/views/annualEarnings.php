<?php include('functions/clientData.php'); ?>

<div class="container" style="margin-left: -150px; padding-top: 50px; padding-bottom: 10px">
	<form action="?page=annualEarnings&id=<?php echo $opened['id']; ?>" id="piaCalc" method="post" role="form">		
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-10" style="padding-bottom: 15px; padding-top: 20px">
					<h3 class="title" style="padding-left: 15px">Yearly Earnings</h3>
					<p class="help-block" style="padding-left: 15px">Enter the amount of Social Security earnings for each year you had earnings subject to Social Security taxes.</p>
				</div><!-- END modal-header -->
				<div class="col-md-2 pull-right" style="padding-top: 40px">
					<div class="btn-group">
						<a type="button" href="?page=client&id=<?php echo $opened['id']; ?>" class="btn btn-default">Close</a>	
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</div>
			<!--<div class="col-md-9 alert alert-warning alert-dismissible" role="alert" style="margin-top: 20px">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;&nbsp;Enter the amount of Social Security earnings for each year you had earnings subject to Social Security taxes.
			</div>-->
			</div>
		
			<?php if(isset($message)) { echo $message; }; ?>
			
			
			<div class="row">		
				<div style="margin: 0 20px">
					<?php
					$earningsDb = unserialize($opened['annualEarnings']);
					$z = 0;
					$start = $dobYear + 20;
					$end = $dobYear + 70;
					for($i = $start; $i <= $end; $i+=1) { ?>
					<div class="form-group col-md-2" style="padding: 5px 5px 0">
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
		      	
			
	    	</div>
	    	
    		<input type="hidden" name="year" value="<?php echo $start; ?>" />
			
			<input type="hidden" name="openedid" value="<?php echo $opened['id']; ?>" />
	    	
	    	<input type="hidden" name="submitted" value="1" />
	    
		
		</div>
	</form>
</div><!-- END container -->