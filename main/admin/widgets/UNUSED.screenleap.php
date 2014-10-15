<div id="console-screenLeap">
	<?php
	    // Configure the request.
	    $url = 'https://api.screenleap.com/v2/screen-shares?isSecure=true';
	    $ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('authtoken:KPyqcaCWNN'));          curl_setopt($ch, CURLOPT_POSTFIELDS, 'accountid=G8T0R');                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	    // Whether you need the following line depends on your curl configuration.
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	
	    // Make the request.
	    $screenShareData = curl_exec($ch);
	    $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE );
	    curl_close($ch);
	
	    // Parse the JSON response for extracting the error message and viewer url below.
	    $json = json_decode($screenShareData,true);
	
	    if ($httpStatusCode != 200) { // Only display this block if there is an error.
	
	?>
	
	<div id="errorInfo">
	    <p>Request HTTP Status Code: <?php echo $httpStatusCode ?></p>
	    <p>Error message: <?php echo $json['errorMessage'] ?></p>
	</div>
	
	<?php
	    } else { // Display this section when there is no error, to launch the screen share.
	?>
	
	<!-- The following 3 divs display conditionally to show the viewer information about the screen share. They are managed by the screenleap callback functions below. -->
	<p id="screenIsLoading">Your screen share is loading...</p>
	<p id="screenIsShared" style="display:none;">
	    Click to view the screen share: <a href="<?php echo $json['viewerUrl'] ?>" target="_blank"><?php echo $json['viewerUrl'] ?></a>
	    <div id="viewerMessages"></div>
	</p>
	<p id="screenShareEnded" style="display:none;"><b>Your screen share has ended</b></p>
	
	<!-- These scripts respond to share functions to show feedback to the user. -->
	<script type="text/javascript">
		$("#btn-screenLeap").on("click", function() {
		        screenleap.startSharing('NATIVE', <?php echo $screenShareData ?>);
		        screenleap.onScreenShareStart = function() {
		            document.getElementById('screenIsLoading').style.display = 'none';
		            document.getElementById('screenIsShared').style.display = 'block';
		        };
		        screenleap.onScreenShareEnd = function() {
		            document.getElementById('screenIsShared').style.display = 'none';
		            document.getElementById('screenShareEnded').style.display = 'block';
		        };
		        screenleap.onViewerConnect = function(participantId, externalId) {
		            document.getElementById('viewerMessage').innerHTML = document.getElementById('viewerMessage').innerHTML + '<br>Viewer ' + (externalId ? externalId : participantId) + ' connected.';
		        };
		        screenleap.onViewerDisconnect = function(participantId, externalId) {
		            document.getElementById('viewerMessage').innerHTML = document.getElementById('viewerMessage').innerHTML + '<br>Viewer ' + (externalId ? externalId : participantId) + ' disconnected.';
		        };
		})
	</script>
	<?php
	    }
	?>
</div>
