<div id="console-debug"

	<?php
	
		$all_vars = get_defined_vars();
	
	?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">DEBUGGING WIDGET</h3>
		</div>
		<div class="panel-body">

			<!-- Widget -->
			 <h2>GET</h2>
			
			<pre>
				<?php print_r($_GET); ?>
			</pre>
			
			<h2>POST</h2>
			
			<pre>
				<?php print_r($_POST); ?>
			</pre>
			
			<h2>All Variables</h2>
			
			<pre>
				<?php print_r($all_vars); ?>
			</pre>
			
			<h2>Page Array</h2>
			
			<pre>
				<?php print_r($page); ?>
			</pre>
		</div>
	</div>
	
</div>

<!-- Modal -->
<!--
<div id="console-debug" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="console-debugLabel" aria-hidden="true">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 id="console-debugLabel">DEBUGGING WIDGET</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default">Close</button>
      </div>
    </div>
  </div>
</div>-->

