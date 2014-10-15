<section class="section">
	<div class="row" style="margin-top: 50px">
	
		<?php include('template/sidebar.php'); ?>
		
		<div id="fixedContent" class="margin-top col-xs-10 col-sm-10">
			<div class="container-fluid">
				<h1>Navigation</h1>
			</div>
				
			<div class="container" style="margin-top: 2%">
				
				<div class="col-md-5">
					
					<ul id="sort-nav" class="list-group">
						
						<?php
						
						$q = "SELECT * FROM navigation ORDER BY position ASC";
						$r = mysqli_query($dbc, $q);
						
						while ($list = mysqli_fetch_assoc($r)) { ?>
						
						<li id="list_<?php echo $list['id']; ?>" class="list-group-item">
							
							<a id="label_<?php echo $list['id']; ?>" data-toggle="collapse" data-target="#form_<?php echo $list['id']; ?>">
								<?php echo $list['label'].' <i class="fa fa-chevron-down pull-right"></i>'; ?>
							</a>
							
							<div id="form_<?php echo $list['id']; ?>" class="collapse">
								
								<form class="form-horizontal nav-form" action="?page=navigation&id=<?php echo $list['id']; ?>" method="post" role="form">
			
									<div class="form-group">
										
										<label class="col-sm-2 control-label" for="id">ID:</label>
										<div class="col-sm-10">
											<input class="form-control" type="text" name="id" id="id" value="<?php echo $list['id']; ?>" placeholder="Id-Name" autocomplete="off" readonly/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-2 control-label" for="label">Label:</label>
										<div class="col-sm-10">
											<input class="form-control input-sm" type="text" name="label" id="label" value="<?php echo $list['label']; ?>" placeholder="Label" autocomplete="off" />
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-2 control-label" for="url">Url:</label>
										<div class="col-sm-10">
											<input class="form-control input-sm" type="text" name="url" id="url" value="<?php echo $list['url']; ?>" placeholder="Url" autocomplete="off" />
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-2 control-label" for="status">Status:</label>
										<div class="col-sm-10">
											<input class="form-control input-sm" type="text" name="status" id="status" value="<?php echo $list['status']; ?>" placeholder="" autocomplete="off" />
										</div>
									</div>
									
									<div class="row">
									
										<div class="pull-right" style="margin-right:10px;">
											<button type="submit" data-toggle="collapse" data-target="#form_<?php echo $list['id']; ?>" class="btn btn-primary btn-sm">Save</button>
											<button type="reset" class="btn btn-default btn-sm">Cancel</button>
										</div>
									
									</div>
									
									<input type="hidden" name="submitted" value="1" />
									<input type="hidden" name="openedid" value="<?php echo $list['id']; ?>" />
			
								</form>
								
							</div>
							
						</li>
			
						<?php } ?>
						
					</ul>
					
				</div>
				<?php if(isset($message)) { echo $message; } ?>				
			</div><!-- END container -->
		</div>
	</div>
</section><!-- END section -->
	
