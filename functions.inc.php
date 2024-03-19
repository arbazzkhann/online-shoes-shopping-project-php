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


function get_product($conn, $limit = '', $cat_id = '', $product_id = '', $search_str = '', $sort_order = '', $is_best_seller = '') {
    // Initialize the SQL query
    $sql =  "SELECT product.*, categories.categories FROM product JOIN categories ON product.categories_id = categories.id WHERE product.status = 1";

    // Add conditions based on input parameters
    if ($cat_id !== '') {
        $sql .= " AND product.categories_id = $cat_id ";
    }
    
    if ($is_best_seller !== '') {
        $sql .= " AND product.best_seller = 1 ";
    }

    if ($product_id !== '') {
        $sql .= " AND product.id = $product_id ";
    }

    if ($search_str !== '') {
        $sql .= " AND (product.name LIKE '%$search_str%' OR product.description LIKE '%$search_str%')";
    }

    // Add sorting order
    if ($sort_order !== '') {
        $sql .= " $sort_order ";
    } else {
        $sql .= " ORDER BY product.id DESC ";
    }

    // Add limit if specified
    if ($limit !== '') {
        $sql .= " LIMIT $limit ";
    }

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check for query execution errors
    if (!$result) {
        // Handle query failure
        echo "Error: " . mysqli_error($conn);
        return []; // Return an empty array or handle error in your application context
    }

    // Fetch the data
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}
