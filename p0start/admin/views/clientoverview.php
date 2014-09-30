<div class="container">
	
	<h3>Client Overview</h3>

	<?php if(isset($message)) { echo $message; } ?>
	
</div><!-- END container -->
			
<?php
//include('functions/sandbox.php');
	//$q = "UPDATE clients SET age = YEAR(CURDATE())-YEAR(dob) - (RIGHT(CURDATE(),5) < RIGHT(dob,5)) WHERE id = $_GET[id]";
	//$r = mysqli_query($dbc, $q);
	
	//$q = "UPDATE clients SET age = TIMESTAMPDIFF(YEAR,dob,CURDATE()) WHERE id = $_GET[id]";
	//$r = mysqli_query($dbc, $q);
					
	//$data = mysqli_fetch_assoc($r);
	
?>

<div class="row" style="margin-top: 2%">
	<div class="col-md-4 col-md-offset-1">
		
		<table class="table table-hover">
			<p><?php print $final; ?></p>
			<thead>
				<th></th>
				<th data-field="id"><?php echo $client['fullname']; ?></th>
			</thead>
			
			<tbody>
				
				<tr>
					<td>
						<p><strong>Date of Birth:</strong></p>
					</td>
					<td>
						<p><?php echo $client['dob']; ?></p>
					</td>
				</tr>
				
				<tr>
					<td>
						<p><strong>Current Age:</strong></p>
					</td>
					<td>
						<p><?php echo $client['age']; ?></p>
					</td>
				</tr>
				
				<tr>
					<td>
						<p><strong>Full Retirement Age:</strong></p>
					</td>
					<td>
						<p><?php
							if(($client['fullRetirementAgeMonths'] % 12) == 0) {
								$remainder = '';
							} else {
								$remainder = "-".round($client['fullRetirementAgeMonths'] % 12);
							};
							echo floor(($client['fullRetirementAgeMonths']/12)).$remainder;
							
							?>
						</p>
					</td>
				</tr>
				
				<tr>
					<td>
						<p><strong>Life Expectancy:</strong></p>
					</td>
					<td>
						<p><?php echo $client['lifeExpectancy']; ?></p>
					</td>
				</tr>
			
			</tbody>
			
		</table><!-- END table -->
	
	</div><!-- END col-md column -->
</div>
<div class="row">
	<div class="col-md-4 col-md-offset-1">
		<table class="table table-hover color-hover">
			<thead>
				<th>Year</th>
				<th>Age</th>
				<th>Income</th>
			</thead>
			<tbody>
				<?php  
				for($i = date("Y"); $i <= (date("Y") + $client['lifeExpectancy']); $i++) { ?>
					
				<tr>
					<td><?php echo $i ; ?></td>
					<td><?php echo (($i - 2014) + $client['age']) ; ?></td>
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
				<th>Income</th>
			</thead>
			<tbody>

				<?php 
				$y = $client['lifeExpectancy'];
				$x = date("Y-m-d", strtotime($client['dob']));
				$result = monthlyData($x, $y);
				$annualInflation = 0.045;
				$money = 1500;

				for($i = 0; $i < arrayCount($result); $i++) {
					(date("m", strtotime($result[$i][0])) == 1) ? $z = 1 : $z = 0;
					$growth = ($z == 0) ? 0 : $annualInflation*$z*$money;
					$money += $growth;
					
					 ?>
				<tr>
				    <td><?php echo $result[$i][0] ?></td>
				    <td><?php echo $result[$i][1] ; ?></td>
				    <td><?php echo '$'.number_format(floor($money)) ; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div><!-- END col-md column -->

</div>

<span class="pull-right stickyButton">
    <a href="?page=clients&id=<?php echo $_GET[id]; ?>" class="well well-sm">
        <i class="glyphicon glyphicon-chevron-left"></i>&nbsp;&nbsp;&nbsp;&nbsp;Return&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </a>
</span><!-- /top-link-block -->
<!--<p class="pull-right" style="padding-right: 10%"><a href="?page=clients&id=<?php// echo $_GET[id]; ?>" class="btn btn-default">Close</a></p>-->
