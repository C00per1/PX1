<div class="container-fluid">
	<h1>Page Manager</h1>
</div>

<div class="row">
	
	<div class="container" style="margin-top: 2%">
	
		<div class="col-md-4">
				
			<div class="list-group">
			
				<a href="?page=pages" class="list-group-item">
					<h6 class="list-group-item-heading"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New Page</h6>
				</a>
			
			<?php
			
				$q = "SELECT * FROM posts WHERE type = 1 ORDER BY id ASC";
				$r = mysqli_query($dbc, $q);
				
				while($list = mysqli_fetch_assoc($r)) {
					
					$blurb = substr(strip_tags($list['body']), 0, 125);	
					
			?>

				<div id="page_<?php echo $list['id']; ?>" class="list-group-item <?php selected($list['id'], $opened['id'], 'active'); ?>"
					<h4 class="list-group-item-heading"><?php echo $list['title']; ?></h4>
					<span class="pull-right">
						<a href="#" id="del_<?php echo $list['id']; ?>" class="btn btn-danger btn-delete btn-sm"><i class="fa fa-trash-o"></i></a>
						<a href="?page=pages&id=<?php echo $list['id']; ?>" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
					</span>
					<p class="list-group-item-text"><?php echo $blurb.'...'; ?></p>
				</div>
						
			<?php } ?>
			
			</div><!-- END list-group -->
			
		</div><!-- END col-md-4 -->
		
		<div class="col-md-8">
					
					<?php if(isset($message)) { echo $message; } ?>
					
			<form action="?page=pages&id=<?php echo $opened['id']; ?>" method="post" role="form">
				
				<div class="form-group">
					
					<label for="title">Title</label>
					<input class="form-control" type="text" name="title" id="title" value="<?php echo $opened['title']; ?>" placeholder="Page Title" />
					
				</div>
				
				<div class="form-group">
					
					<label for="user">User</label>
					<select class="form-control" name="user" id="user">
						
						<option value="0">No user</option>
						
						<?php
						
							$q = "SELECT id FROM users ORDER BY first ASC";
							$r = mysqli_query($dbc, $q);
							
							while($user_list = mysqli_fetch_assoc($r)) { 
							
								$user_data = data_user($dbc, $user_list['id']);
								
							?>
								
								<option value="<?php echo $user_data['id']; ?>" 
									
									<?php
									
										if(isset($_GET['id'])) {
											
											selected($user_data['id'], $opened['user'], 'selected');
											
										} else {
											
											selected($user_data['id'], $user['id'], 'selected');
											
										}
										
									?>><?php echo $user_data['fullname']; ?></option>
						
						<?php } ?>
						
					</select>
					
				</div>
				
				<div class="form-group">
					
					<label for="slug">Slug:</label>
					<input class="form-control" type="text" name="slug" id="slug" value="<?php echo $opened['slug']; ?>" placeholder="Page Slug" />
					
				</div>
				
				<div class="form-group">
					
					<label for="label">Label</label>
					<input class="form-control" type="text" name="label" id="label" value="<?php echo $opened['label']; ?>" placeholder="Page Label" />
					
				</div>
				
				<div class="form-group">
					
					<label for="header">Header</label>
					<input class="form-control" type="text" name="header" id="header" value="<?php echo $opened['header']; ?>" placeholder="Page Header" />
					
				</div>
				
				<div class="form-group">
					
					<label for="body">Body</label>
					<textarea class="form-control editor" type="text" name="body" id="body" rows="8" placeholder="Page Body"><?php echo $opened['body']; ?></textarea>
					
				</div>
				
				<div class="pull-right">
					
					<button type="submit" class="btn btn-default">Save</button>
					
				</div>
				
				<input type="hidden" name="submitted" value="1" />
				<?php if(isset($opened['id'])) { ?>
					<input type="hidden" name="id" value="<?php echo $opened['id']; ?>" />
				<?php } ?>
				
			</form>
			
		</div><!-- END col-md-8 -->
				
	</div><!-- END container -->
				
</div><!-- END row -->