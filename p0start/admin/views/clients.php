<div class="container-fluid">
	<h1>Client Manager</h1>
</div>

<div class="row">
	
	<div class="container" style="margin-top: 2%">
	
		<div class="col-md-4">
				
			<div class="list-group">
			
				<a href="?page=clients" class="list-group-item">
					<h6 class="list-group-item-heading"><i class="fa fa-plus-square"></i> New Client</h6>
				</a>
			
			<?php
			
				$q = "SELECT id FROM clients ORDER BY last ASC";
				$r = mysqli_query($dbc, $q);
				
				while($list_client = mysqli_fetch_assoc($r)) {
				
					$list = data_client($dbc, $list_client['id']);
					//$blurb = substr(strip_tags($list['body']), 0, 125);	
					
				?>
				
					<a class="list-group-item <?php selected($list['id'], $opened['id'], 'active'); ?>" href="?page=clients&id=<?php echo $list['id']; ?>"
						<h4 class="list-group-item-heading"><?php echo $list['fullname_reverse']; ?></h4>
					</a>
							
				<?php } ?>
			
			</div><!-- END list-group -->
			
		</div><!-- END col-md-4 -->
		
		<div class="col-md-8">
					
					<?php if(isset($message)) { echo $message; } ?>
				
			<form action="?page=clients&id=<?php echo $opened['id']; ?>" method="post" role="form">
				<div class="row">
					<div class="form-group col-md-6">
						
						<label for="first">First</label>
						<input class="form-control" type="text" name="first" id="first" value="<?php echo $opened['first']; ?>" placeholder="First Name" autocomplete="off" />
						
					</div>
					
					<div class="form-group col-md-6">
						
						<label for="last">Last</label>
						<input class="form-control" type="text" name="last" id="last" value="<?php echo $opened['last']; ?>" placeholder="Last Name" autocomplete="off" />
						
					</div>
				</div>
				
				<div class="row">
					<div class="form-group col-md-4">
						
						<label for="status">Marital Status</label>
						<select class="form-control" name="status" id="status">
							
							<option value="0" <?php if(isset($_GET['id'])) { selected('0', $opened['status'], 'selected'); } ?>>Single</option>
							<option value="1" <?php if(isset($_GET['id'])) { selected('1', $opened['status'], 'selected'); } ?>>Married</option>
							
						</select>
						
					</div>
					
					<div class="form-group col-md-4">
						
						<label for="status">Gender</label>
						<select class="form-control" name="gender" id="gender">
							
							<option value="0" <?php if(isset($_GET['id'])) { selected('0', $opened['gender'], 'selected'); } ?>>Male</option>
							<option value="1" <?php if(isset($_GET['id'])) { selected('1', $opened['gender'], 'selected'); } ?>>Female</option>
							
						</select>
						
					</div>
					
					<div class="form-group col-md-4">
						<label for="dob">DOB</label>
						<input class="form-control" type="date" name="dob" id="dob" value="<?php echo $opened['dob']; ?>" autocomplete="off" />
					</div>
				</div>
				
				<div class="pull-right">
					<?php
					if($opened['id'] != '') {
						$redirect = clientoverview;
					} else {
						$redirect = clients;
					}
					?>
					<a href="?page=<?php echo $redirect ?>&id=<?php echo $opened['id']; ?>" class="btn btn-default">View</a>				
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
				
				<input type="hidden" name="submitted" value="1" />
				<?php if(isset($opened['id'])) { ?>
					<input type="hidden" name="id" value="<?php echo $opened['id']; ?>" />
				<?php } ?>
			</form>
			
		</div><!-- END col-md-8 -->
				
	</div><!-- END container -->
				
</div><!-- END row -->