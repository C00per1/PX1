<div class="container-fluid">
	<h1>Settings</h1>
</div>

<div class="row">
	
	<div class="container" style="margin-top: 2%">
	
		<div class="col-md-8 col-md-offset-2">
			
			<?php if(isset($message)) { echo $message; } ?>
			
			<?php
			
				$q = "SELECT * FROM settings ORDER BY id ASC";
				$r = mysqli_query($dbc, $q);
				
				while($opened = mysqli_fetch_assoc($r)) {?>
					
					<form class="form-inline" action="?page=settings&id=<?php echo $opened['id']; ?>" method="post" role="form">
				
						<div class="form-group">
							
							<label class="sr-only" for="id">ID:</label>
							<input class="form-control" data-id="<?php echo $opened['id'] ; ?>" data-label="Setting ID" data-db="settings-id" type="text" name="id" id="id" value="<?php echo $opened['id']; ?>" placeholder="Id-Name" autocomplete="off" disabled />
							
						</div>
						
						<div class="form-group">
							
							<label class="sr-only" for="label">Label:</label>
							<input class="form-control blur-save" data-id="<?php echo $opened['id'] ; ?>" data-label="Setting Label" data-db="settings-label" type="text" name="label" id="label" value="<?php echo $opened['label']; ?>" placeholder="Label" autocomplete="off" />
							
						</div>
						
						<div class="form-group">
							
							<label class="sr-only" for="value">Value:</label>
							<input class="form-control blur-save" data-id="<?php echo $opened['id'] ; ?>" data-label="Setting Value" data-db="settings-value" type="text" name="value" id="value" value="<?php echo $opened['value']; ?>" placeholder="Value" autocomplete="off" />
							
						</div>
						
						<input type="hidden" name="submitted" value="1" />
						<input type="hidden" name="openedid" value="<?php echo $opened['id']; ?>" />


					</form>
								
			<?php } ?>
			
		</div><!-- END col-md-12 -->
				
	</div><!-- END container -->
				
</div><!-- END row -->