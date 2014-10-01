<div class="container">
	
	<h3>Client Overview</h3>
<?php 
//echo '<pre>';
//echo print_r($opened);
//echo '</pre>';
?>
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
						<p><?php echo $opened['age']; ?></p>
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
						<p><?php echo $opened['lifeExpectancy']; ?></p>
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
	<?php
	$y = $opened['lifeExpectancy'];
	$x = date("Y-m-d", strtotime($opened['dob']));
	$annualInflation = $opened['cola']/100;
	$pia = $opened['pia'];
	$result = monthlyData($x, $y, $annualInflation, $pia);
	$lastItem = arrayCount($result) - 1;
	?>	
	</div><!-- END col-md column -->
	<div class="col-md-4 col-md-offset-1">
		<h3>Lifetime Total: &nbsp;<strong>$ <?php echo number_format(floor($result[$lastItem][3])) ; ?></strong></h3>
	</div>
</div>

<div class="row" style="margin-top: 1%">
	<div class="col-md-4 col-md-offset-1">
		<table class="table table-hover color-hover">
			<thead>
				<th>Year</th>
				<th>Age</th>
				<th>Income</th>
			</thead>
			<tbody>
				<?php  
				for($i = date("Y"); $i <= (date("Y") + $opened['lifeExpectancy']); $i++) { ?>
					
				<tr>
					<td><?php echo $i ; ?></td>
					<td><?php echo (($i - 2014) + $opened['age']) ; ?></td>
					<td>$18,000</td>
				</tr>
				<?php } ; ?>

			</tbody>
		</table>
	</div><!-- END col-md column -->
	
		<div class="col-md-4 col-md-offset-1">
		<table class="table table-hover color-hover">
			<thead>
				<th>Date</th>
				<th>Age</th>
				<th>PIA</th>
				<th>Total</th>
			</thead>
			<tbody>

				<?php

				for($i = 0; $i < arrayCount($result); $i++) { ?>
				<tr>
				    <td><?php echo $result[$i][0] ; ?></td>
				    <td><?php echo $result[$i][1] ; ?></td>
				    <td>$<?php echo number_format(floor($result[$i][2])) ; ?></td>
				    <td>$<?php echo number_format(floor($result[$i][3])) ; ?></td>
				</tr>
				<?php } ?>
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
