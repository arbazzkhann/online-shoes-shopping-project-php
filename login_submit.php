<?php 
session_start();
require 'connection.inc.php';
require 'functions.inc.php';

$email = get_safe_value($conn, $_POST['email']);
$password = get_safe_value($conn, $_POST['password']);

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $sql);  //sql for email exists in database or not

$check_user = mysqli_num_rows($result);

if($check_user > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['USER_LOGIN'] = 'yes';
    $_SESSION['USER_ID'] = $row['id'];
    $_SESSION['USER_NAME'] = $row['name'];
    echo "valid";
}
else {
    echo "wrong";
}

?>