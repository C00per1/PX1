<div class="container">
	
	<div class="row clearfix">
		
		<div class="col-md-12 column">
		
			<div class="well">
				
				<div class="container">
					
					<h3>Client Overview</h3>
			
					<?php if(isset($message)) { echo $message; } ?>
					
				</div><!-- END container -->
			
			</div><!-- END well -->
			
			<?php

				//$q = "UPDATE clients SET age = YEAR(CURDATE())-YEAR(dob) - (RIGHT(CURDATE(),5) < RIGHT(dob,5)) WHERE id = $_GET[id]";
				//$r = mysqli_query($dbc, $q);
				
				//$q = "UPDATE clients SET age = TIMESTAMPDIFF(YEAR,dob,CURDATE()) WHERE id = $_GET[id]";
				//$r = mysqli_query($dbc, $q);
								
				//$data = mysqli_fetch_assoc($r);
				
			?>
			
			<div class="row">
				<div class="col-md-6 col-md-offset-2">
					
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
									<p><strong>Age:</strong></p>
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
									<p><?php echo $client['fra']; ?></p>
								</td>
							</tr>
							
							<tr>
								<td>
									<p><strong>Life Expectance:</strong></p>
								</td>
								<td>
									<p><?php echo $client['le']; ?></p>
								</td>
							</tr>
						
						</tbody>
						
					</table><!-- END table -->
				
				</div><!-- END col-md-6 column -->
			
			</div>
		
		</div><!-- END col-md-12 column -->
		
		<p class="pull-right"><a href="?page=clients&id=<?php echo $_GET[id]; ?>" class="btn btn-default">Close</a></p>

	</div><!-- END row -->

</div><!-- END container -->