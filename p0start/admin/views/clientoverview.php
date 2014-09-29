<div class="container">
	
	<h3>Client Overview</h3>

	<?php if(isset($message)) { echo $message; } ?>
	
</div><!-- END container -->
			
<?php

	//$q = "UPDATE clients SET age = YEAR(CURDATE())-YEAR(dob) - (RIGHT(CURDATE(),5) < RIGHT(dob,5)) WHERE id = $_GET[id]";
	//$r = mysqli_query($dbc, $q);
	
	//$q = "UPDATE clients SET age = TIMESTAMPDIFF(YEAR,dob,CURDATE()) WHERE id = $_GET[id]";
	//$r = mysqli_query($dbc, $q);
					
	//$data = mysqli_fetch_assoc($r);
	
?>

<div class="row" style="margin-top: 2%">
	<div class="col-md-4 col-md-offset-1">
		
		<table class="table table-hover">
			
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
		<table class="table table-hover">
			<thead>
				<th>Year</th>
				<th>Age</th>
			</thead>
			<tbody>
				<?php  
				
				for($i = date("Y"); $i <= date("Y") + $client['lifeExpectancy']; $i++) { ?>
					
				<tr>
					<td><?php echo $i ; ?></td>
					<td><?php echo (($i - 2014) + $client['age']) ; ?></td>
				</tr>
				
				<?php } ?>
			</tbody>
		</table>
	</div><!-- END col-md column -->
	
		<div class="col-md-4 col-md-offset-1">
		<table class="table table-hover">
			<thead>
				<th>Date</th>
				<th>Age</th>
			</thead>
			<tbody>
			<?php  
			$dob      = date("Y-m-d", strtotime($client['dob']));
			$today    = date("Y-m-d");
			$start    = (new DateTime($today))->modify('first day of this month');
			$end      = (new DateTime('2034-05-06'))->modify('first day of this month');
			$interval = DateInterval::createFromDateString('1 month');
			$period   = new DatePeriod($start, $interval, $end);
			$ageT	  = $client['age'];
			

			function ageT($time1, $time2) {
				$intervalT = date_diff($time1, $time2);
				echo $intervalT->m + ($intervalT->y * 12);
			}
			
			foreach ($period as $dt) {
				$ageT += 1; ?>
			<tr>
			    <td><?php echo $dt->format("Y-m") ; ?></td>
			    <td><?php echo $ageT ; ?></td>
			</tr>
			<?php } ?>

			</tbody>
		</table>
	</div><!-- END col-md column -->

</div>

<p class="pull-right" style="padding-right: 10%"><a href="?page=clients&id=<?php echo $_GET[id]; ?>" class="btn btn-default">Close</a></p>
