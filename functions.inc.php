<?php

function pr($arr) {
    echo '<pre>';
    print_r($arr);
}

function prx($arr) {
    echo '<pre>';
    print_r($arr);
    die();
}

function get_safe_value($conn, $str) {
    if($str != '') {
        $str = trim($str);
        return mysqli_real_escape_string($conn, $str);
    }
}

//shows error
// function get_product($conn, $limit = '', $cat_id = '', $product_id = '') {
//     $sql =  "SELECT product.*, categories.categories FROM product, categories WHERE product.status = 1";

//     if($cat_id != '') {
//         $sql .= " AND product.categories_id = $cat_id";
//     }
    
//     if($product_id != '') {
//         $sql .= " AND product.id = $product_id";
//     }
//     $sql .= " AND product.categories_id = categories.id";
//     $sql .= " ORDER BY product.id DESC";

//     // contatinating in sql if limit is not NULL
//     if($limit != '') {
//         $sql .= " LIMIT $limit";
//     }

//     // running query
//     $result = mysqli_query($conn, $sql);

//     $data = array();

//     while($row = mysqli_fetch_assoc($result)) {
//         $data[] = $row;
//     }
//     return $data;
// }


function get_product($conn, $limit = '', $cat_id = '', $product_id = '') {
    $sql =  "SELECT product.*, categories.categories FROM product, categories WHERE product.status = 1";

    if($cat_id != '') {
        $sql .= " AND product.categories_id = $cat_id";
    }
    
    if($product_id != '') {
        $sql .= " AND product.id = $product_id";
    }
    $sql .= " AND product.categories_id = categories.id";
    $sql .= " ORDER BY product.id DESC";

    // contatinating in sql if limit is not NULL
    if($limit != '') {
        $sql .= " LIMIT $limit";
    }

    // running query
    $result = mysqli_query($conn, $sql);

    // Check if query failed
    if (!$result) {
        // Handle query failure
        echo "Error: " . mysqli_error($conn);
        return []; // Return an empty array or handle error in your application context
    }

    $data = array();

    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

?>