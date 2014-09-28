<?php

#Start the session:
session_start();

if(!isset($_SESSION['username'])) {
	header('Location: login.php');	
}

?>

<?php include('config/setup.php'); ?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $site_title; ?></title>
		<meta name="viewport" content="width=device-width, intial-scale=1.0">
		
		<?php include('config/css.php'); ?>
		
		<?php include('config/js.php'); ?>
		
	</head>
	
	<body>
		
		<div id="wrap">
			
			<? include(D_TEMPLATE.'/navigation.php'); // Main Navigation ?>