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


// Adidas Shoes Data
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
    '2', 
    'Adidas GAZELLE SHOES', 
    15499, 
    10999, 
    5, 
    '952449534_Adidas-GAZELLE-SHOES-10999.jpeg', 
    'This is Adidas GAZELLE SHOES', 
    'The Adidas GAZELLE SHOES are a variant of the classic Adidas Gazelle silhouette, known for its iconic design and versatile style. The GAZELLE designation likely refers to an oversized or exaggerated feature of the shoe, though without further context it\'s unclear exactly what aspect of the shoe is being emphasized. Adidas Gazelle shoes have been a staple in sneaker culture since their introduction in the 1960s, originally designed as training shoes but later gaining popularity as casual streetwear. They are characterized by their suede upper, contrasting stripes, and timeless aesthetic. Without specific details on the GAZELLE variation, it\'s difficult to provide a more detailed description. However, Adidas often releases special editions or collaborations within their Gazelle line, which may feature unique colorways, materials, or design elements.', 
    0, 
    'All new Adidas gazelle shoes', 
    'new Adidas gazelle shoes', 
    'Adidas shoes gazelle shoe sports sneakers'
),
(
    '2', 
    'Adidas SUPERSTAR SHOES', 
    12549, 
    8999, 
    5, 
    '362277941_Adidas-SUPERSTAR-SHOES-8999.jpeg', 
    'This is Adidas SUPERSTAR SHOES', 
    'The Adidas SUPERSTAR SHOES are a variant of the classic Adidas Superstar silhouette, known for its iconic design and versatile style. The SUPERSTAR designation likely refers to an oversized or exaggerated feature of the shoe, though without further context it\'s unclear exactly what aspect of the shoe is being emphasized. Adidas Superstar shoes have been a staple in sneaker culture since their introduction in the 1960s, originally designed as basketball shoes but later gaining popularity as casual streetwear. They are characterized by their leather upper, rubber shell toe, and timeless aesthetic. Without specific details on the SUPERSTAR variation, it\'s difficult to provide a more detailed description. However, Adidas often releases special editions or collaborations within their Superstar line, which may feature unique colorways, materials, or design elements.', 
    0, 
    'All new Adidas superstar shoes', 
    'new Adidas superstar shoes', 
    'Adidas shoes superstar shoe sports sneakers'
),
(
    '2', 
    'Adidas FORUM LOW SHOES', 
    12499, 
    9999, 
    5, 
    '819358039_FORUM-LOW-SHOES-9999.jpeg', 
    'This is new Adidas FORUM-LOW-SHOES', 
    'The Adidas FORUM-LOW-SHOES are a variant of the classic Forum Low silhouette, known for its iconic design and versatile style. The FORUM-LOW designation likely refers to an oversized or exaggerated feature of the shoe, though without further context it\'s unclear exactly what aspect of the shoe is being emphasized. Forum Low shoes have been a staple in sneaker culture since their introduction, originally designed as basketball shoes but later gaining popularity as casual streetwear. They are characterized by their sleek design, low profile, and timeless aesthetic. Without specific details on the FORUM-LOW variation, it\'s difficult to provide a more detailed description. However, Adidas often releases special editions or collaborations within their Forum Low line, which may feature unique colorways, materials, or design elements.', 
    0, 
    'All new Forum Low shoes', 
    'new Adidas Forum Low shoes', 
    'Adidas Forum Low shoes sneaker sports'
),
(
    '2', 
    'Adidas STAN SMITH SHOES', 
    12459, 
    8999, 
    5, 
    '185325951_STAN-SMITH-SHOES-8999.jpeg', 
    'This is Adidas STAN SMITH SHOES', 
    'The Adidas STAN SMITH SHOES are a variant of the classic Adidas Stan Smith silhouette, known for its iconic design and versatile style. The STAN SMITH designation likely refers to an oversized or exaggerated feature of the shoe, though without further context it\'s unclear exactly what aspect of the shoe is being emphasized. Adidas Stan Smith shoes have been a staple in sneaker culture since their introduction in the 1960s, originally designed as tennis shoes but later gaining popularity as casual streetwear. They are characterized by their clean, minimalist design, leather upper, and timeless aesthetic. Without specific details on the STAN SMITH variation, it\'s difficult to provide a more detailed description. However, Adidas often releases special editions or collaborations within their Stan Smith line, which may feature unique colorways, materials, or design elements.', 
    0, 
    'All new Adidas STAN SMITH shoes', 
    'new Adidas STAN SMITH shoes', 
    'Adidas STAN SMITH shoes sneaker sports'
),
(
    '2', 
    'Adidas VS PACE 2.0', 
    8499, 
    4999, 
    5, 
    '749248264_VS-PACE-2.0-4999.jpeg', 
    'This is Adidas VS PACE 2.0', 
    'The Adidas VS PACE 2.0 shoes are a variant of the classic Adidas VS PACE silhouette, known for its versatile style and comfort. The VS PACE 2.0 designation likely refers to an updated version or model of the original VS PACE shoes. Adidas VS PACE shoes are designed for everyday wear and casual sports activities. They are characterized by their lightweight construction, cushioned sole, and modern design. Without specific details on the VS PACE 2.0 variation, it\'s difficult to provide a more detailed description. However, Adidas often releases new iterations of their popular shoe models with improved features or design elements.', 
    0, 
    'All new Adidas VS PACE 2.0 shoes', 
    'new Adidas VS PACE 2.0 shoes', 
    'Adidas VS PACE 2.0 shoes sneaker sports'
)";

mysqli_query($conn, $sql);


// Puma Shoes Data
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
    '3',
    'PUMA Blktop Rider Preppy Unisex Sneakers', 
    12499, 
    8999, 
    3, 
    '744916767_PUMA Blktop Rider Preppy Unisex Sneakers 8999.jpg', 
    'This is PUMA Blktop Rider Preppy Unisex Sneakers', 
    'The PUMA Blktop Rider Preppy Unisex Sneakers are a stylish and versatile choice for both men and women. These sneakers feature a classic design with a modern twist, making them perfect for casual wear or dressing up an outfit. The unisex design ensures they can be worn by anyone, regardless of gender. With their comfortable fit and durable construction, these sneakers are sure to become a wardrobe staple. Whether you\'re running errands or heading out for a night on the town, the PUMA Blktop Rider Preppy Unisex Sneakers are the perfect choice.', 
    0,  
    'All new PUMA Blktop Rider Preppy Unisex Sneakers', 
    'new PUMA Blktop Rider Preppy Unisex Sneakers', 
    'PUMA Blktop Rider Preppy Unisex Sneakers shoes sneaker sports casual unisex'
),
(
    '3',
    'PUMA BMW M Motorsport Caven 2', 
    10499, 
    6999, 
    9, 
    '791257919_PUMA BMW-M-Motorsport-Caven-2 6999.jpg', 
    'This is PUMA BMW M Motorsport Caven 2', 
    'The PUMA BMW M Motorsport Caven 2 shoes combine motorsport-inspired design with casual street style. These sneakers feature a sleek and sporty look, perfect for fans of BMW and motorsport enthusiasts alike. The Caven 2 designation likely refers to a specific model or version of the PUMA BMW M Motorsport shoes. With their comfortable fit and durable construction, these sneakers are suitable for everyday wear. Whether you\'re hitting the track or exploring the city, the PUMA BMW M Motorsport Caven 2 shoes are sure to turn heads.', 
    0,  
    'All new PUMA BMW M Motorsport Caven 2 shoes', 
    'new PUMA BMW M Motorsport Caven 2 shoes', 
    'PUMA BMW M Motorsport Caven 2 shoes motorsport sneakers casual'
),
(
    '3',
    'PUMA Court Shatter Low Men\'s Sneakers', 
    7499, 
    4199, 
    4, 
    '169684507_PUMA Court Shatter Low Mens Sneakers-4199.jpg', 
    'This is PUMA Court Shatter Low Men\'s Sneakers', 
    'The PUMA Court Shatter Low Men\'s Sneakers are designed for both style and performance on the court. With a low-profile design and durable construction, these sneakers provide stability and support during intense gameplay. The Court Shatter Low designation likely refers to the design elements and technology used in the construction of these shoes. With their sleek look and comfortable fit, these sneakers are also suitable for casual wear off the court. Whether you\'re playing basketball or simply hanging out with friends, the PUMA Court Shatter Low Men\'s Sneakers are a versatile choice for any occasion.', 
    0,  
    'All new PUMA Court Shatter Low Men\'s Sneakers', 
    'new PUMA Court Shatter Low Men\'s Sneakers', 
    'PUMA Court Shatter Low Men\'s Sneakers shoes sneaker sports casual men'
),
(
    '3',
    'PUMA Palermo Unisex Sneakers', 
    8949, 
    6999, 
    8, 
    '579063336_PUMA Palermo Unisex Sneakers 6999.jpg', 
    'This is PUMA Palermo Unisex Sneakers', 
    'The PUMA Palermo Unisex Sneakers offer a versatile and stylish option for both men and women. With a classic design and comfortable fit, these sneakers are suitable for everyday wear. Whether you\'re running errands or hanging out with friends, the Palermo Unisex Sneakers are a great choice. The unisex design ensures they can be worn by anyone, regardless of gender. With their durable construction and timeless aesthetic, these sneakers are sure to become a wardrobe staple.', 
    0,  
    'All new PUMA Palermo Unisex Sneakers', 
    'new PUMA Palermo Unisex Sneakers', 
    'PUMA Palermo Unisex Sneakers shoes sneaker sports casual unisex'
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


