<?php

// pid = Product Id
// qty = Quantity

class add_to_cart {
    // function for adding product into cart
    function addProduct($pid, $qty) {
        $_SESSION['cart'][$pid]['$qty'] = $qty; 
    }

    // function for updating cart products
    function updateProduct($pid, $qty) {
        if(isset($_SESSION['cart'][$pid])) {
            $_SESSION['cart'][$pid]['$qty'] = $qty;
        }
    }
    
    // function for removing cart products
    function removeProduct($pid) {
        if(isset($_SESSION['cart'][$pid])) {
            unset($_SESSION['cart'][$pid]);
        }
    }

    // function for empty cart
    function emptyProduct() {
        unset($_SESSION['cart']);
    }

    // function for total product
    function totalProduct() {
        if(isset($_SESSION['cart'])) {
            return count($_SESSION['cart']);
        }
        else {
            return 0;
        }
    }
}


?>