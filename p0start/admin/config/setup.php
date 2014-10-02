<?php
// Setup Files:

#Error Reporting
error_reporting(0);

#Database Connection
include('../config/connection.php');

# Constants:
DEFINE('D_TEMPLATE', 'template');


# Functions:
include('functions/data.php');
include('functions/template.php');
include('functions/sandbox.php');
include('functions/calculate.php');

# Site Settings
$debug = data_setting_value($dbc, 'debug-status');
$screenLeap = data_setting_value($dbc, 'screenLeap-Status');
$site_title = data_setting_value($dbc, "site-title");

# Load page content via URL query
if(isset($_GET['page'])) {
	
	$page = $_GET['page']; // Set $pageid to equal the value given in the URL.
	
} else {
	
	$page = "dashboard"; // Set $page equal to "dashboard" or admin home.
}

# Page Setup
include('config/queries.php');

$path = get_path();
//$page = data_page($dbc, $pageid);

#User Setup:
$user = data_user($dbc, $_SESSION['username']);

#Client Setup:
//$client = data_client($dbc, $_GET['id']);

?>