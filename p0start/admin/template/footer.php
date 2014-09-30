
			<span id="top-link-block" class="hidden pull-right">
			    <a href="#wrap" class="well well-sm"  onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
			        <i class="glyphicon glyphicon-chevron-up"></i> Back to Top
			    </a>
			</span><!-- /top-link-block -->
		</div><!-- END WRAP -->	
		<div class="footer" id="footer">
			<div class="container">
				<p class="text-muted">This is my footer.</p>

				<?php// if($screenLeap == 1) { ?>
					<!--<button type="button" id="btn-screenLeap" class="btn btn-default pull-right"><i class="fa fa-arrow-right"></i></button>-->
				<?php// } ?>

			</div>
		</div>

<?php if($debug == 1) { include('widgets/debug.php'); } //Debug Widget ?>
<?php// if($screenLeap == 1) { include('widgets/screenleap.php'); } //ScreenLeap Widget ?>
	</body>
</html>