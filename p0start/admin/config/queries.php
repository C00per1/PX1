<?php

	switch ($page) {
		
		case 'dashboard':
			
		break;
		
		case 'pages':
			
			if(isset($_POST['submitted']) == 1) {
	
				$title = mysqli_real_escape_string($dbc, $_POST['title']);
				$label = mysqli_real_escape_string($dbc, $_POST['label']);
				$header = mysqli_real_escape_string($dbc, $_POST['header']);
				$body = mysqli_real_escape_string($dbc, $_POST['body']);
				
				if(isset($_POST['id']) != '') {
					$action = 'updated';
					$q = "UPDATE posts SET user = $_POST[user], slug = '$_POST[slug]', title = '$title', label = '$label', header = '$header', body = '$body' WHERE id = $_GET[id]";
					
				} else {
					$action = 'added';
					$q = "INSERT INTO posts (type, user, slug, title, label, header, body) VALUES (1, $_POST[user], '$_POST[slug]','$title', '$label', '$header', '$body')";
					
				}
				
				
				$r = mysqli_query($dbc, $q);
				
				if($r) {
					//$message = '<p class="bg-success">Page was '.$action.'!</>';
					$message = '
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert">
								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
							</button>
							<strong>Success!</strong> Page was added!
						</div>';
					
				} else {
					
					//$message = '<p class="bg-warning">Page could not be '.$action.' because: '.mysqli_error($dbc).'</p>';
					//$message .= '<p>Query: '.$q.'</p>';
					$message = '
						<div class="alert alert-warning alert-dismissible" role="alert">
  							<button type="button" class="close" data-dismiss="alert">
  								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
  							</button>
  							<strong>Warning!</strong> 
  							<p>Page could not be '.$action.' because: '.mysqli_error($dbc).'</p>
  							<p>Query: '.$q.'</p>
						</div>
					';
					
				}
				
			}

			if(isset($_GET['id'])) { $opened = data_post($dbc, $_GET['id']); }
			
			break;
			
		case 'users':
			
			if(isset($_POST['submitted']) == 1) {
	
				$first = mysqli_real_escape_string($dbc, $_POST['first']);
				$last = mysqli_real_escape_string($dbc, $_POST['last']);
				
				if($_POST['password'] != '') {
					
					if($_POST['password'] == $_POST['passwordv']) {
						$password = "password = SHA1('$_POST[password]'),";
						$verify = true;
						
					} else {
						$verify = false;
						
					}
					
				} else {
					$verify = false;
					
				}
				
				if(isset($_POST['id']) != '') {
					$action = 'updated';
					$q = "UPDATE users SET first = '$first', last = '$last', email = '$_POST[email]', $password status = $_POST[status] WHERE id = $_GET[id]";
					$r = mysqli_query($dbc, $q);
					
				} else {
					$action = 'added';
					$q = "INSERT INTO users (first, last, email, password, status) VALUES ('$first', '$last', '$_POST[email]', SHA1('$_POST[password]'), '$_POST[status]')";
					if($verify == true) {
						$r = mysqli_query($dbc, $q);
					}
					
				}
				
				if($r) {
					if($verify == true){
						//$message = '<p class="bg-success">User was '.$action.'!</>';
						$message = '
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert">
								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
							</button>
							<strong>Success!</strong> User was '.$action.'!
						</div>';
					} else {
						$message = '
						<div class="alert alert-warning alert-dismissible" role="alert">
  							<button type="button" class="close" data-dismiss="alert">
  								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
  							</button>
  							<strong>Caution!</strong> 
  							<p>Password not updated.</p>
						</div>
						';
					}
					
					
				} else {
					
					/*
					$message = '<p class="bg-danger">User could not be '.$action.' because: '.mysqli_error($dbc).'</p>';
										if($verify == false) {
											$message .= '<p>Password fields empty and/or do not match.</p>';
										}
										$message .= '<p>Query: '.$q.'</p>';*/
					if($verify == false) {
						$messagev = '<p>Password fields empty and/or do not match.</p>';
					}
					
					$message = '
						<div class="alert alert-warning alert-dismissible" role="alert">
  							<button type="button" class="close" data-dismiss="alert">
  								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
  							</button>
  							<strong>Warning!</strong> 
  							<p>User could not be '.$action.' because: '.mysqli_error($dbc).'</p>
  							<p>'.$messagev.'</p>
  							<p>Query: '.$q.'</p>
						</div>
						';
					
				}
				
			}

			if(isset($_GET['id'])) { $opened = data_user($dbc, $_GET['id']); }
			
			break;
			
		case 'clients':
			
			if(isset($_POST['submitted']) == 1) {
	
				$first = mysqli_real_escape_string($dbc, $_POST['first']);
				$last = mysqli_real_escape_string($dbc, $_POST['last']);
				$dob = mysqli_real_escape_string($dbc, $_POST['dob']);
				$year = date('Y', strtotime($dob));
				$fra = findFullRetirementAgeMonths($year);
				
				if(isset($_POST['id']) != '') {
					$action = 'updated';
					$q = "UPDATE clients SET first = '$first', last = '$last', status = $_POST[status], dob = '$dob', fullRetirementAgeMonths = $fra, gender = $_POST[gender] WHERE id = $_GET[id]";
						
				} else {
					$action = 'added';
					$q = "INSERT INTO clients (first, last, status, dob, fullRetirementAgeMonths, gender) VALUES ('$first', '$last', '$_POST[status]', '$dob', $fra, $_POST[gender])";
					
				}

				$r = mysqli_query($dbc, $q);
				
				if($r) {
					//$message = '<p class="bg-success">Page was '.$action.'!</>';
					$message = '
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert">
								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
							</button>
							<strong>Success!</strong> Client was '.$action.'!
						</div>';
					
				} else {
					
					//$message = '<p class="bg-warning">Page could not be '.$action.' because: '.mysqli_error($dbc).'</p>';
					//$message .= '<p>Query: '.$q.'</p>';
					$message = '
						<div class="alert alert-warning alert-dismissible" role="alert">
  							<button type="button" class="close" data-dismiss="alert">
  								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
  							</button>
  							<strong>Warning!</strong> 
  							<p>Client could not be '.$action.' because: '.mysqli_error($dbc).'</p>
  							<p>Query: '.$q.'</p>
						</div>
					';
					
				}
			}
				
			if(isset($_GET['id'])) { $opened = data_client($dbc, $_GET['id']); }

			break;
	
		case 'clientoverview':
		
			if(isset($_POST['submitted']) == 1) {
	
				$pia = mysqli_real_escape_string($dbc, $_POST['pia']);
				$cola = mysqli_real_escape_string($dbc, $_POST['cola']);
				
				if(isset($_POST['id']) != '') {
					$action = 'updated';
					$q = "UPDATE clients SET age = YEAR(CURDATE())-YEAR(dob) - (RIGHT(CURDATE(),5) < RIGHT(dob,5)), pia = '$pia', cola = '$cola' WHERE id = $_POST[id]";
					$r = mysqli_query($dbc, $q);
					
				}
				
				if($r) {
					//$message = '<p class="bg-success">Page was '.$action.'!</>';
					$message = '
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert">
								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
							</button>
							<strong>Success!</strong> Setting was '.$action.'!
						</div>';
					
				} else {
					
					//$message = '<p class="bg-warning">Page could not be '.$action.' because: '.mysqli_error($dbc).'</p>';
					//$message .= '<p>Query: '.$q.'</p>';
					$message = '
						<div class="alert alert-warning alert-dismissible" role="alert">
  							<button type="button" class="close" data-dismiss="alert">
  								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
  							</button>
  							<strong>Warning!</strong> 
  							<p>Setting could not be '.$action.' because: '.mysqli_error($dbc).'</p>
  							<p>Query: '.$q.'</p>
						</div>
					';
					
				}
			}

			if(isset($_GET['id'])) { $opened = data_client($dbc, $_GET['id']); }
			
		break;
		
		case 'navigation':
			
			if(isset($_POST['submitted']) == 1) {
	
				$label = mysqli_real_escape_string($dbc, $_POST['label']);
				$url = mysqli_real_escape_string($dbc, $_POST['url']);
				
				if(isset($_POST['id']) != '') {
					$action = 'updated';
					$q = "UPDATE navigation SET id = '$_POST[id]', label = '$label', url = '$url', position = $_POST[position], status = $_POST[status] WHERE id = '$_POST[openedid]'";
					$r = mysqli_query($dbc, $q);
					
				}
				
				if($r) {
					//$message = '<p class="bg-success">Page was '.$action.'!</>';
					$message = '
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert">
								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
							</button>
							<strong>Success!</strong> Navigation Item was '.$action.'!
						</div>';
					
				} else {
					
					//$message = '<p class="bg-warning">Page could not be '.$action.' because: '.mysqli_error($dbc).'</p>';
					//$message .= '<p>Query: '.$q.'</p>';
					$message = '
						<div class="alert alert-warning alert-dismissible" role="alert">
  							<button type="button" class="close" data-dismiss="alert">
  								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
  							</button>
  							<strong>Warning!</strong> 
  							<p>Navigation Item could not be '.$action.' because: '.mysqli_error($dbc).'</p>
  							<p>Query: '.$q.'</p>
						</div>
					';
					
				}
				
			}
			
			break;
			
		case 'settings':
			
			if(isset($_POST['submitted']) == 1) {
	
				$label = mysqli_real_escape_string($dbc, $_POST['label']);
				$value = mysqli_real_escape_string($dbc, $_POST['value']);
				
				if(isset($_POST['id']) != '') {
					$action = 'updated';
					$q = "UPDATE settings SET id = '$_POST[id]', label = '$label', value = '$value' WHERE id = '$_POST[openedid]'";
					$r = mysqli_query($dbc, $q);
					
				}
				
				if($r) {
					//$message = '<p class="bg-success">Page was '.$action.'!</>';
					$message = '
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert">
								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
							</button>
							<strong>Success!</strong> Setting was '.$action.'!
						</div>';
					
				} else {
					
					//$message = '<p class="bg-warning">Page could not be '.$action.' because: '.mysqli_error($dbc).'</p>';
					//$message .= '<p>Query: '.$q.'</p>';
					$message = '
						<div class="alert alert-warning alert-dismissible" role="alert">
  							<button type="button" class="close" data-dismiss="alert">
  								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
  							</button>
  							<strong>Warning!</strong> 
  							<p>Setting could not be '.$action.' because: '.mysqli_error($dbc).'</p>
  							<p>Query: '.$q.'</p>
						</div>
					';
					
				}
				
			}
			
			break;

		default:
			
			break;
	}



?>