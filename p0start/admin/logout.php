<?php

#Start Session
session_start();

unset($_SESSION['username']); //Delete the username key

//session_destroy(); //Delate all of the session keys

header('Location: login.php');

?>