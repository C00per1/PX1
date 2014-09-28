<?php if(isset($opened['id'])) { ?>
	<script>
		
		$(document).ready(function() {
			
			Dropzone.autoDiscover = false;
			
			var myDropzone = new Dropzone("#avatar-dropzone");
			
			myDropzone.on("success", function(file) {
				
				$("#avatar").load("ajax/avatar.php?id=<?php echo $opened['id']; ?>");
				
			});
			
		});
		
	</script>
	
<?php } ?>

<div class="container">
	<h1>User Manager</h1>
</div>

<div class="row">
	
	<div class="container">
	
		<div class="col-md-4">
				
			<div class="list-group">
			
				<a href="?page=users" class="list-group-item">
					<h6 class="list-group-item-heading"><i class="fa fa-plus-square"></i> New User</h6>
				</a>
			
			<?php
			
				$q = "SELECT * FROM users ORDER BY last ASC";
				$r = mysqli_query($dbc, $q);
				
				while($list = mysqli_fetch_assoc($r)) {
				
					$list = data_user($dbc, $list['id']);
					//$blurb = substr(strip_tags($list['body']), 0, 125);	
					
				?>
	
				<a class="list-group-item <?php selected($list['id'], $opened['id'], 'active'); ?>" href="?page=users&id=<?php echo $list['id']; ?>"
					<h4 class="list-group-item-heading"><?php echo $list['fullname_reverse']; ?></h4>
					<!--<p class="list-group-item-text"> php echo //$blurb; </p>-->
				</a>
							
				<?php } ?>
			
			</div><!-- END list-group -->
			
		</div><!-- END col-md-4 -->
		
		<div class="col-md-8">
					
					<?php if(isset($message)) { echo $message; } ?>
					
			<form action="?page=users&id=<?php echo $opened['id']; ?>" method="post" role="form">
				
				<div id="avatar">
					
				<?php if($opened['avatar'] != '') { ?>
					
					<div class="avatar-container" style="background-image: url('../uploads/<?php echo $opened['avatar']; ?>')"></div>	
					
				<?php } ?>
				
				</div>
				
				<?php if($opened['avatar'] != '') { ?>
					
				<br>
				
				<?php } ?>
				
				<div class="form-group">
					
					<label for="first">First</label>
					<input class="form-control" type="text" name="first" id="first" value="<?php echo $opened['first']; ?>" placeholder="First Name" autocomplete="off" />
					
				</div>
				
				<div class="form-group">
					
					<label for="last">Last</label>
					<input class="form-control" type="text" name="last" id="last" value="<?php echo $opened['last']; ?>" placeholder="Last Name" autocomplete="off" />
					
				</div>
				
				<div class="form-group">
					
					<label for="email">Email</label>
					<input class="form-control" type="text" name="email" id="email" value="<?php echo $opened['email']; ?>" placeholder="Email Address" autocomplete="off" />
					
				</div>
				
				<div class="form-group">
					
					<label for="status">Status</label>
					<select class="form-control" name="status" id="status">
						
						<option value="0" <?php if(isset($_GET['id'])) { selected('0', $opened['status'], 'selected'); } ?>>Inactive</option>
						<option value="1" <?php if(isset($_GET['id'])) { selected('1', $opened['status'], 'selected'); } ?>>Active</option>
						
					</select>
					
				</div>
				
				<div class="form-group">
					
					<label for="password">Password:</label>
					<input class="form-control" type="password" name="password" id="password" placeholder="Password" autocomplete="off" />
					
				</div>
				
				<div class="form-group">
					
					<label for="passwordv">Verify Password:</label>
					<input class="form-control" type="password" name="passwordv" id="passwordv" placeholder="Re-Enter Password" autocomplete="off" />
					
				</div>
				
				<div class="pull-right">
					
					<button type="submit" class="btn btn-default">Save</button>
					
				</div>
				
				<input type="hidden" name="submitted" value="1" />
				<?php if(isset($opened['id'])) { ?>
					<input type="hidden" name="id" value="<?php echo $opened['id']; ?>" />
				<?php } ?>
			</form>
			
			<?php if(isset($opened['id'])) { ?>
				<br><br><br>
				<form action="uploads.php?id=<?php echo $opened['id']; ?>" class="dropzone" id="avatar-dropzone">
					
					<input type="file" name="file">
					
				</form>
			<?php } ?>
			
		</div><!-- END col-md-8 -->
				
	</div><!-- END container -->
				
</div><!-- END row -->