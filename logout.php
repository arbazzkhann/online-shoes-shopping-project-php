<?php 
session_start(); // Start the session

require 'connection.inc.php';
require 'functions.inc.php';

// Unset session variables
unset($_SESSION['USER_LOGIN']);
unset($_SESSION['USER_ID']);
unset($_SESSION['USER_NAME']);

// Redirect to index.php
header('location: index.php');
die();
?>
