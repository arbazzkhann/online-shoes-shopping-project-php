<?php 
session_start();
require 'connection.inc.php';
require 'functions.inc.php';
require 'add_to_cart.inc.php';

$pid = get_safe_value($conn, $_POST['pid']);
$qty = get_safe_value($conn, $_POST['qty']);
$type = get_safe_value($conn, $_POST['type']);

$obj = new add_to_cart();

if($type == 'add') {
    $obj -> addProduct($pid, $qty);
}

echo $obj -> totalProduct();

?>