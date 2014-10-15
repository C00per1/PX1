<?php

if($opened['status'] == 1) {
	include('clientoverviewMarried.php');
} elseif($opened['status'] == 0) {
	include('clientoverview.php');
}

?>