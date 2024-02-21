<?php

// Database details
$servername = "localhost";
$username = "root";
$password = "";
$database = "online shoes shopping";

// connecting with database
$conn = mysqli_connect($servername, $username, $password, $database);

//defining SERVER_PATH and SITE_PATH
define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'] . '/online-shoes-shopping-project-php/');
define('SITE_PATH', 'http://localhost/online-shoes-shopping-project-php/');

//defining PRODUCT_IMAGE_SERVER_PATH and PRODUCT_IMAGE_SITE_PATH
define('PRODUCT_IMAGE_SERVER_PATH', SERVER_PATH . 'media/product/');
define('PRODUCT_IMAGE_SITE_PATH', SITE_PATH . 'media/product/');
?>