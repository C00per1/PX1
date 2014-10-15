<div id="console-debug">
	
		
	
	
	<?php
	
		$all_vars = get_defined_vars();
	
	?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">DEBUGGING WIDGET</h3>
		</div>
		<div class="panel-body">
			<h2>Path Array</h2>
			
			<pre>
				<?php print_r($path); ?>
			</pre>
			
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
			
			<h2>View Array</h2>
			
			<pre>
				<?php print_r($view); ?>
			</pre>
			
		</div>
	</div>
	
</div>