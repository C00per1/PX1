<?php
include_once('functions/clientData.php');
if(isset($message)) { echo $message; };
?>
<div class="container-fluid">
	<h1>Client Overview</h1>
</div><!-- END container -->

<div class="container-fluid">
	<div class="row" style="margin-top: 2%; margin-bottom: 1%">
		<div class="col-md-4 col-md-offset-1">
			
			<table class="table table-hover">
				
				<thead>
					<th></th>
					<th data-field="id"><?php echo $opened['fullname']; ?></th>
				</thead>
				
				<tbody>
					
					<tr>
						<td>
							<p><strong>Date of Birth:</strong></p>
						</td>
						<td>
							<p><?php echo $opened['dob']; ?></p>
						</td>
					</tr>
					
					<tr>
						<td>
							<p><strong>Current Age:</strong></p>
						</td>
						<td>
							<p><?php echo $result[0][1]; ?></p>
						</td>
					</tr>
					
					<tr>
						<td>
							<p><strong>Full Retirement Age:</strong></p>
						</td>
						<td>
							<p><?php
								if(($opened['fullRetirementAgeMonths'] % 12) == 0) {
									$remainder = '';
								} else {
									$remainder = "-".round($opened['fullRetirementAgeMonths'] % 12);
								};
								echo floor(($opened['fullRetirementAgeMonths']/12)).$remainder;
								
								?>
							</p>
						</td>
					</tr>
					
					<tr>
						<td>
							<p><strong>Life Expectancy:</strong></p>
						</td>
						<td>
							<p><?php echo $result[$lastItem][1]; ?></p>
						</td>
					</tr>
	
				</tbody>
				
			</table><!-- END table -->
		</div>
		<div class="col-md-4 col-md-offset-1">
			
			<div class="row" style="margin-top: 10%">
				<form class="form-inline" style="margin-left: 10px" action="?page=clientoverview&id=<?php echo $opened['id']; ?>" method="post" role="form">
					<div class="form-group col-md-4">
						<label for="pia">PIA:</label>
						<div class="input-group">
							<input class="form-control blur-save" data-id="<?php echo $opened['id'] ; ?>" data-label="Client PIA" data-db="clients-pia" type="number" name="pia" id="pia" value="<?php echo $opened['pia']; ?>" placeholder="PIA" autocomplete="off" />
						</div>
					</div>
		
					<div class="form-group col-md-4">
						<label for="cola">COLA:</label>
						<div class="input-group">
							<input class="form-control blur-save" data-id="<?php echo $opened['id'] ; ?>" data-label="Client COLA" data-db="clients-cola" type="number" name="cola" id="cola" value="<?php echo $opened['cola']; ?>" placeholder="COLA" autocomplete="off" />
						</div>
					</div>
					
					<div class="form-group col-md-4" style="margin-top: 35px">
					    <a href="?page=clientoverview&id=<?php echo $opened['id']; ?>" class="well well-sm">
					        <i class="glyphicon glyphicon-chevron-right"></i> Go
					    </a>
					</div>
				</form>
			</div>
			
			<div class="row" style="margin-top: 3%; padding-left: 10px">
				<div class="col-md-4">
					<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#calcPia" style="text-align: center">Calculate PIA</button>
				</div>
			</div>
			
			<div class="modal fade" id="calcPia" tabindex="-1" role="dialog" aria-labelledby="calcPiaLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content" style="background-color: #fbfbfb">
						
			    		<div class="modal-header" style="background-color: #e1e1e1">
			    			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			    			<h4 class="modal-title" id="calcPiaLabel">Yearly Earnings</h4>
			    		</div><!-- END modal-header -->
			    		
			    		<div class="modal-body">
			    			<div class="row" style="padding: 10px">
			    				<div class="alert alert-warning alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;&nbsp;Enter the amount of Social Security earnings for each year you had earnings subject to Social Security taxes.
								</div>
	
								<?php for($i = $dobYear + 20; $i <= $dobYear + 70; $i+=1) { ?>
								<div class="col-md-3" style="padding: 5px">
									<div class="input-group">
										<span class="input-group-addon"><?php echo $i; ?></span>
										<input type="text" class="form-control" id="<?php echo $i; ?>" style="text-align: center" autocomplete="off" />
									</div><!-- END input -->
						      	</div><!-- END col-md-4 -->
						      	<?php } ?>
					      	</div>
					    </div><!-- END modal-body -->
					    
					    <div class="modal-footer" style="background-color: #e1e1e1">
					    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					    	<button type="button" class="btn btn-primary">Save changes</button>
						</div><!-- END modal-footer -->
						
					</div><!-- END modal-content -->
				</div><!-- END modal-dialog -->
			</div><!-- END modal -->
			
		</div><!-- END col-md column -->

	</div>
</div>
<div class="container-fluid">
	<div class="row" style="margin-top: 1%">
		<div class="col-md-5" style="margin-left: 45px">
			<?php 
			
			//echo '<pre>';
			//print_r($ageMaxLifetimeBenefits);
			//var_dump($ageMaxLifetimeBenefits);
			//print_r($result);
			//var_dump($myArray2);
			//echo '</pre>'
			?>
			<h2 style="font-variant: small-caps">If You Started Taking Benefits...</h>
			
			<h3><i class="fa fa-close" style="color: red"></i> Earliest:</h3>
			<h4>...at age <u><?php echo $myArray2[0][1]; ?></u> you'll receive lifetime benefits of <u><?php echo '$'.number_format($myArray2[0][6]); ?></u></h4>
			
			<h3><i class="fa fa-close" style="color: red"></i> FRA:</h3>
			<h4>...at age <u><?php echo $myArray4[0][1]; ?></u> you'll receive lifetime benefits of <u><?php echo '$'.number_format($myArray4[0][6]); ?></u></h4>

			<h3><i class="fa fa-close" style="color: red"></i> Latest:</h3>
			<h4>...at age <u><?php echo $myArray3[0][1]; ?></u> you'll receive lifetime benefits of <u><?php echo '$'.number_format($myArray3[0][6]); ?></u></h4>

			<h3><i class="fa fa-check" style="color: green"></i> Maximum:</h3>
			<h4>...at age <u><?php echo $ageMaxLifetimeBenefits[0][1]; ?></u> you'll receive lifetime benefits of <u><?php echo '$'.number_format($ageMaxLifetimeBenefits[0][6]); ?></u></h4>

		</div>
		<div class="col-md-6" style="margin-top: 25px">
			<div id="chartContainer2" class="fushionCharts" style="padding: 0 15px"></div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row" style="margin-top: 4%">
		<div class="col-md-12">
			<div id="chartContainer" class="fushionCharts" style="margin: 0 45px"></div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row" style="margin-top: 2%">
		<div class="col-md-10 col-md-offset-1">
			<!-- Nav tabs -->
			<ul id="tableTabs" class="nav nav-tabs" role="tablist" style="padding: 0 15px">
			  <li class="active"><a href="#annualTable" role="tab" data-toggle="tab">Annual View</a></li>
			  <li><a href="#monthlyTable" role="tab" data-toggle="tab">Monthly View</a></li>
			</ul>
			<div id="tableTabContent" class="tab-content">
				<div class="tab-pane fade in active" id="annualTable">
					<div class="col-md-12">
						<table class="table table-hover color-hover">
							<thead>
								<th style="padding-left: 15px">Election Age</th>
								<th>Year</th>
								
								<th>PIA Before Adjustment</th>
								<th>Adjustment to PIA</th>
								<th>Monthly Benefit</th>
								<th>Lifetime Total</th>
							</thead>
							<tbody>
								<?php  
								for($i = 0; $i <= count($result); $i+=12) {
									$resultYearEx = explode('-', $result[$i][0]);
									$resultAgeEx = explode('-', $result[$i][1]);
									$end = date("Y", $result[$lastItem][0]);
									if($result[$i][5] > 0) {
									?>
									
								<tr>
									<td style="padding-left: 15px"><?php echo $resultAgeEx[0] ; ?></td>
									<td><?php echo $resultYearEx[0] ; ?></td>
									
									<td>$<?php echo number_format(floor($result[$i][4])) ; ?></td>
									<td><?php echo '$'.number_format(round($result[$i][4])) ; ?></td>
									<td><?php echo '$'.number_format(round($result[$i][5])) ; ?></td>
									<td>$<?php echo number_format(floor($result[$i][6])) ; ?></td>
								</tr>
								<?php } } ; ?>
				
							</tbody>
						</table>
					</div><!-- END col-md column -->
				</div>
			
				<div class="tab-pane fade" id="monthlyTable">
					<div class="col-md-12">
						<table class="table table-hover color-hover">
							
							<thead>
								<th style="padding-left: 15px">Election Age</th>
								<th>Year-Month</th>
								
								<th>PIA Before Adjustment</th>
								<th>Adjustment to PIA</th>
								<th>Monthly Benefit</th>
								<th>Lifetime Total</th>
							</thead>
							<tbody>
				
								<?php for($i = 0; $i < count($result); $i++) { 
									if($result[$i][5] > 0 && $result[$i][2] <= 840) {?>
								<tr>
									<td style="padding-left: 15px"><?php echo $result[$i][1] ; ?></td>
								    <td><?php echo $result[$i][0] ; ?></td>
								    
								    <td>$<?php echo number_format(floor($result[$i][4])) ; ?></td>
								    <td><?php echo $result[$i][3].'%' ; ?></td>
								    <td>$<?php echo number_format(floor($result[$i][5])) ; ?></td>
								    <td>$<?php echo number_format(floor($result[$i][6])) ; ?></td>
								</tr>
								<?php } } ?>
							</tbody>
						</table>
					</div><!-- END col-md column -->
				</div>
			</div>
		</div>
	</div>
</div>
<span class="pull-right stickyButton">
    <a href="?page=clients&id=<?php echo $opened['id']; ?>" class="well well-sm">
        <i class="glyphicon glyphicon-chevron-left"></i> Back
    </a>
</span><!-- stickyButton -->
<span id="top-link-block" class="hidden">
    <a href="#top" class="well well-sm"  onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
        <i class="glyphicon glyphicon-chevron-up"></i> Top&nbsp;&nbsp;
    </a>
</span><!-- /top-link-block -->

<input type="hidden" name="submitted" value="1" />
<input type="hidden" name="openedid" value="<?php echo $opened['id']; ?>" />
