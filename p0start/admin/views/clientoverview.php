<div class="container">
	<?php
	include_once('functions/clientData.php');

	//echo '<pre>';
	//print_r($ageSixtyTwoBoolean);
	//echo strtotime($opened['dob']);
	//print_r($result);
	//print_r($age);
	//echo '</pre>';
	?>

	<h3>Client Overview</h3>

	<?php if(isset($message)) { echo $message; } ?>
	
</div><!-- END container -->

<div class="row" style="margin-top: 2%">
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
		
		<div class="row">
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
		
		<div class="row" style="margin: 20px 0">
			<div>
				<button class="btn btn-block btn-primary btn-md" data-toggle="modal" data-target="#calcPia">Calculate PIA</button>
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

							<?php for($i = $dobYear + 21; $i <= $dobYear + 68; $i+=1) { ?>
							<div class="col-md-3" style="padding: 5px">
								<div class="input-group">
									<span class="input-group-addon"><?php echo $i; ?></span>
									<input type="text" class="form-control" id="<?php echo $i; ?>" placeholder="0" style="text-align: center" autocomplete="off" />
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
	<div class="col-md-4 col-md-offset-1">
		<h3>Monthly View:</h3>
		<div id="chart_div" style="width:450; height:300"></div>
		<script>
			// Load the Visualization API and the piechart package.
			google.load('visualization', '1.0', {'packages':['corechart']});
  
			// Set a callback to run when the Google Visualization API is loaded.
			google.setOnLoadCallback(drawChart);


			// Callback that creates and populates a data table, 
			// instantiates the pie chart, passes in the data and
			// draws it.
			function drawChart() {
				
				var jsonData = $.ajax({
					url: "functions/clientData.php",
					dataType:"json",
					async: false
				}).responseText;
				
				// Create the data table.
				var data = new google.visualization.DataTable(jsonData);
	
				// Set chart options
				var options = {
					title:'Lifetime Social Security Benefits by Starting Age',
					hAxis: {title: 'Age'},
					backgroundColor: '#efefef',
					//legend.position:'none',
					width:500,
					height:350
				};
	
				// Instantiate and draw our chart, passing in some options.
				var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
				chart.draw(data);
			}
		</script>
		
	</div>
</div>

<div class="row" style="margin-top: 1%">
	<div class="col-md-4 col-md-offset-1">
		<table class="table table-hover color-hover">
			<thead>
				<th>Year</th>
				<th>Age</th>
				<th>PIA</th>
				<th>Benefit</th>
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
					<td><?php echo $resultYearEx[0] ; ?></td>
					<td><?php echo $resultAgeEx[0] ; ?></td>
					<td><?php echo '$'.number_format(round($result[$i][4])) ; ?></td>
					<td><?php echo '$'.number_format(round($result[$i][5])) ; ?></td>
				</tr>
				<?php } } ; ?>

			</tbody>
		</table>
	</div><!-- END col-md column -->
	
	<div class="col-md-5 col-md-offset-1">
		<table class="table table-hover color-hover">
			<thead>
				<th>Date</th>
				<th>Age</th>
				<th>PIA</th>
				<th>PIA<br>Adjustment</th>
				<th>Monthly<br>Benefit</th>
				<th>Total</th>
			</thead>
			<tbody>

				<?php for($i = 0; $i < count($result); $i++) { 
					if($result[$i][5] > 0 && $result[$i][2] <= 840) {?>
				<tr>
				    <td><?php echo $result[$i][0] ; ?></td>
				    <td><?php echo $result[$i][1] ; ?></td>
				    <!--<td><?php// echo $result[$i][5] ; ?></td>-->
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

<span class="pull-right stickyButton">
    <a href="?page=clients&id=<?php echo $opened['id']; ?>" class="well well-sm">
        <i class="glyphicon glyphicon-chevron-left"></i> Back
    </a>
</span><!-- /top-link-block -->

<input type="hidden" name="submitted" value="1" />
<input type="hidden" name="openedid" value="<?php echo $opened['id']; ?>" />
