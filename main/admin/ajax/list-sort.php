<?php

include('../../config/connection.php');

$list = $_GET['list'];

// Test
print_r($list);

// Loop to extract both value and key
//foreach($list as $key => $value)
foreach($list as $position => $id) {
	
	$q = "UPDATE navigation SET position = $position WHERE id = $id";
	$r = mysqli_query($dbc, $q);
	
	echo mysqli_error($dbc);
}

?>