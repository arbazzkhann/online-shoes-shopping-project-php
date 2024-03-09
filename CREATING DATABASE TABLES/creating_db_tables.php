<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "online shoes shopping";


$conn= mysqli_connect($servername, $username, $password, $database);

// Admin Users Table
$sql = "CREATE TABLE IF NOT EXISTS `admin_users` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL)";

mysqli_query($conn, $sql);


// Categories Table
$sql = "CREATE TABLE IF NOT EXISTS `categories` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categories VARCHAR(255) NOT NULL,
    status TINYINT(4) NOT NULL)";

mysqli_query($conn, $sql);


// Contact us Table
$sql = "CREATE TABLE IF NOT EXISTS `contact_us` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(75) NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    comment TEXT NOT NULL,
    added_on DATETIME NOT NULL)";
    
mysqli_query($conn, $sql);


// Order Table
$sql = "CREATE TABLE IF NOT EXISTS `order` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    address VARCHAR(250) NOT NULL,
    city VARCHAR(50) NOT NULL,
    pincode INT NOT NULL,
    payment_type VARCHAR(20) NOT NULL,
    total_price FLOAT NOT NULL,
    payment_status VARCHAR(20) NOT NULL,
    order_status INT NOT NULL,
    added_on DATETIME NOT NULL)";

mysqli_query($conn, $sql);


// Order Details Table
$sql = "CREATE TABLE IF NOT EXISTS `order_details` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    qty INT NOT NULL,
    price FLOAT NOT NULL)";

mysqli_query($conn, $sql);


// Order Status Table
$sql = "CREATE TABLE IF NOT EXISTS `order_status` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(60) NOT NULL)";

mysqli_query($conn, $sql);


// Product Table
$sql = "CREATE TABLE IF NOT EXISTS `product` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categories_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    mrp FLOAT NOT NULL,
    price FLOAT NOT NULL,
    qty INT NOT NULL,
    image VARCHAR(2000) NOT NULL,
    short_desc VARCHAR(2000) NOT NULL,
    description TEXT NOT NULL,
    meta_title TEXT,
    meta_desc TEXT,
    meta_keyword VARCHAR(2000),
    status TINYINT(4) NOT NULL)";

mysqli_query($conn, $sql);


// Users Table
$sql = "CREATE TABLE IF NOT EXISTS `users` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    added_on DATETIME NOT NULL)";

mysqli_query($conn, $sql);

?>  