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

// function get_safe_value($conn, $str) {
//     if($str != '') {
//         $str = trim($str);
//         return mysqli_real_escape_string($conn, $str);
//     }
// }

function get_product($conn, $type = '', $limit = '') {
    $sql =  "SELECT * FROM product WHERE status = 1";

    // contatinating in sql if product type latest
    if($type == 'latest') {
        $sql .= " ORDER BY id DESC";
    }
    // contatinating in sql if limit is not NULL
    if($limit != '') {
        $sql .= " limit $limit";
    }

    // running query
    $result = mysqli_query($conn, $sql);

    $data = array();

    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}


?>