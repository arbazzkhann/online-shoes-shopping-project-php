<?php

// Database Details
$servername = "localhost";
$username = "root";
$password = "";
$database = "online shoes shopping";
// $database = "bb";


// Database Connection
$conn= mysqli_connect($servername, $username, $password, $database);


// Admin Users Table
$sql = "CREATE TABLE IF NOT EXISTS `admin_users` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL)";

mysqli_query($conn, $sql);


// Inserting Admin detail
$sql = "INSERT INTO `admin_users` (username, password) VALUES ('admin', 'admin')";
mysqli_query($conn, $sql);


// Categories Table
$sql = "CREATE TABLE IF NOT EXISTS `categories` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categories VARCHAR(255) NOT NULL UNIQUE,
    status TINYINT(4) NOT NULL)";

mysqli_query($conn, $sql);


// Inserting Data into Categories Table
$sql = "INSERT INTO `categories` (categories, status) VALUES 
        ('Nike', 1),
        ('Adidas', 1),
        ('Puma', 1),
        ('Campus', 1)";

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
    name VARCHAR(60) NOT NULL UNIQUE)";

mysqli_query($conn, $sql);


// Inserting Order Status
$sql = "INSERT INTO `order_status` (name) VALUES 
        ('Pending'),
        ('Processing'),
        ('Shipped'),
        ('Canceled'),
        ('Complete')";

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
    best_seller INT DEFAULT 0,
    meta_title TEXT,
    meta_desc TEXT,
    meta_keyword VARCHAR(2000),
    status TINYINT(4) DEFAULT 1)";

mysqli_query($conn, $sql);


// SQL query to insert data into the product table
// Nike Shoes Data
$sql = "INSERT INTO `product` (
    categories_id, 
    name, 
    mrp, 
    price, 
    qty, 
    image, 
    short_desc, 
    description, 
    best_seller, 
    meta_title, 
    meta_desc, 
    meta_keyword
) 
VALUES 
(
    '1', 
    'Nike Air Dunk Jumbo', 
    17490, 
    11495, 
    5, 
    '382376888_Nike Air Dunk Jumbo 11495.png', 
    'This is Nike Air Dunk Jumbo Shoes', 
    'The Nike Air Dunk Jumbo Shoes are a variant of the classic Nike Dunk silhouette, known for its iconic design and versatile style. The Jumbo designation likely refers to an oversized or exaggerated feature of the shoe, though without further context it\'s unclear exactly what aspect of the shoe is being emphasized. Nike Dunk shoes have been a staple in sneaker culture since their introduction in the 1980s, originally designed as basketball shoes but later gaining popularity as casual streetwear. They are characterized by their supportive fit, cushioned sole, and timeless aesthetic. Without specific details on the Jumbo variation, it\'s difficult to provide a more detailed description. However, Nike often releases special editions or collaborations within their Dunk line, which may feature unique colorways, materials, or design elements.', 
    1, 
    'All new nike air dunk jumbo shoes', 
    'new nike air jumbo dunk shoes', 
    'nike shoes jumbo dunk shoe sports sneakers'
),
(
    '1', 
    'Air Jordan 1 Low SE Craft', 
    15995, 
    10295, 
    7, 
    '556418558_Air Jordan 1 Low SE Craft 10295.jpeg', 
    'Air Jordan 1 Low SE Craft Shoes', 
    'The Air Jordan 1 Low SE Craft Shoes are a variant of the classic Air Jordan 1 silhouette, known for its iconic design and versatile style. They are characterized by their supportive fit, cushioned sole, and timeless aesthetic.', 
    0, 
    'New Air Jordan 1 Low SE Craft Shoes', 
    'New Air Jordan 1 Low SE Craft shoes. Perfect for any occasion.', 
    'air jordan 1 low se craft sneakers'
),
(
    '1', 
    'Nike Air Force 1', 
    9549, 
    7495, 
    9, 
    '281368162_Nike Air Force 1 7495.png', 
    'Nike Air Force Shoes', 
    'The Nike Air Force 1 Shoes are a variant of the classic Nike Air Force silhouette, known for its iconic design and versatile style. They are characterized by their supportive fit, cushioned sole, and timeless aesthetic.', 
    1, 
    'New Nike Air Force Shoes', 
    'New Nike Air Force shoes. Perfect for any occasion.', 
    'nike air force sneakers'
),
(
    '1', 
    'Nike Air Jordan 1 Low', 
    11249, 
    8995, 
    5, 
    '733014853_Nike Air Jordan 1 Low 8995.png', 
    'Nike Air Jordan 1 Low Shoes', 
    'The Nike Air Jordan 1 Low Shoes are a variant of the classic Air Jordan 1 silhouette, known for its iconic design and versatile style. They are characterized by their supportive fit, cushioned sole, and timeless aesthetic.', 
    1, 
    'Nike Air Jordan 1 Low Shoes', 
    'Nike Air Jordan 1 Low shoes. Perfect for any occasion.', 
    'Nike Air Jordan 1 Low one sneakers'
),
(
    '1', 
    'Nike Air Jordan 1 Mid', 
    15590, 
    11495, 
    5, 
    '495226829_Nike Air Jordan 1 Mid 11495.jpeg', 
    'Nike Air Jordan 1 Mid Shoes', 
    'The Nike Air Jordan 1 Mid Shoes are a variant of the classic Air Jordan 1 silhouette, known for its iconic design and versatile style. They are characterized by their supportive fit, cushioned sole, and timeless aesthetic.', 
    1, 
    'new Nike Air Jordan 1 Mid Shoes', 
    'Nike Air Jordan 1 Mid shoes. Perfect for any occasion.', 
    'Nike Air Jordan 1 Mid one sneakers'
),
(
    '1', 
    'Nike Jumpman MVP', 
    15490, 
    10295, 
    5, 
    '779654386_Nike Jumpman MVP 15295.png', 
    'Nike Jumpman MVP Shoes', 
    'The Nike Jumpman MVP Shoes deliver top-tier performance and undeniable style. Engineered with cutting-edge technology and premium materials, these shoes are designed to excel on the court and off. With a sleek and dynamic design, they make a bold statement wherever you go. Featuring responsive cushioning and superior traction, they provide exceptional comfort and stability in every step. Whether you\'re dominating the game or hitting the streets, the Nike Jumpman MVP Shoes ensure you stand out from the crowd. Elevate your performance and style with the Nike Jumpman MVP Shoes.', 
    0, 
    'New Nike Jumpman MVP Shoes', 
    'New Nike Jumpman MVP shoes. Perfect for any occasion.', 
    'nike Nike Jumpman MVP sneakers shoes'
)";

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


// Inserting into users Table
$sql = "INSERT INTO `users` (name, password, email, mobile) VALUES 
        ('user, user, user@gmail.com, 9900123456')";

mysqli_query($conn, $sql);


?>  


