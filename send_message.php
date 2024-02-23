<?php 

require 'connection.inc.php'; //Database connectivity file
require 'functions.inc.php'; //User defined function file

// Storing data into variables
$name = get_safe_value($conn, $_POST['name']);
$email = get_safe_value($conn, $_POST['email']);
$mobile = get_safe_value($conn, $_POST['mobile']);
$comment = get_safe_value($conn, $_POST['message']);
$added_on = date('Y-m-d h:i:s');

//sql for inserting form data 
$sql = "INSERT INTO contact_us(name, email, mobile, comment, added_on) VALUES ('$name', '$email', $mobile, '$comment', '$added_on')";  

mysqli_query($conn, $sql);  //Running sql

echo "Thank you";


?>

