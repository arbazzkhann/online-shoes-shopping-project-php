<?php 
require 'connection.inc.php';
require 'functions.inc.php';

$name = get_safe_value($conn, $_POST['name']);
$email = get_safe_value($conn, $_POST['email']);
$mobile = get_safe_value($conn, $_POST['mobile']);
$password = get_safe_value($conn, $_POST['password']);

$check_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='$email'"));

if($check_user > 0) {
    echo "email_present";
}
else {
    echo "insert";
}

?>