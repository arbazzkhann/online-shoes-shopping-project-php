<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "online shoes shopping";

$conn = mysqli_connect($servername, $username, $password, $database);

define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'] . '/online%20shoes%20shopping%20in%20php/');
define('SITE_PATH', 'http://localhost/online%20shoes%20shopping%20in%20php/');

define('PRODUCT_IMAGE_SERVER_PATH', SERVER_PATH . 'media/product/');
define('PRODUCT_IMAGE_SITE_PATH', SITE_PATH . 'media/product/');
?>