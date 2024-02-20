<?php
    require 'header.inc.php';
    $sql = "SELECT * FROM categories ORDER BY categories ASC";
    $result = mysqli_query($conn, $sql);

    if(isset($_GET['type']) && $_GET['type'] != '') {
        $type = get_safe_value($conn, $_GET['type']);
        if($type == 'status') {
            $operation = get_safe_value($conn, $_GET['operation']);  //custom function get_safe_value
            $id = get_safe_value($conn, $_GET['id']);  //custom function get_safe_value
            if($operation == 'active') {   
                $status = '1';  
            } else {
                $status = '0';
            }
            $sql_update_status = "update product set status='$status' where id='$id'";
            mysqli_query($conn, $sql_update_status);
        }
    }

    if(isset($_GET['type']) && $_GET['type'] != '') {
        if($type == 'delete') {
            $id = get_safe_value($conn, $_GET['id']);
            
            $sql_delete = "delete from product where id='$id'";
            mysqli_query($conn, $sql_delete);
        }
    }

    $sql = "SELECT product.*, categories.categories FROM product, categories WHERE product.categories_id = categories.id ORDER BY product.id DESC";
    $result = mysqli_query($conn, $sql);
?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title"> Products </h4>
                        <h4 class="box-link"><a href="manage_product.php"> Add Product </a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">S.No</th>
                                        <th>ID</th>
                                        <th>Categories</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>MRP</th>
                                        <th>Price</th>
                                        <th>Qty.</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    while($row = mysqli_fetch_assoc($result)) {?>
                                        <tr>
                                            <td class="serial"><?php echo $i?></td>
                                            <td><?php echo $row['id']?></td>
                                            <td><?php echo $row['categories']?></td>
                                            <td><?php echo $row['name']?></td>
                                            <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $row['image']?>"/></td>
                                            <td><?php echo $row['mrp']?></td>
                                            <td><?php echo $row['price']?></td>
                                            <td><?php echo $row['qty']?></td>
                                            <td>
                                                <?php
                                                    if($row['status'] == 1) {
                                                        echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp";            
                                                    } else {
                                                        echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp"; 
                                                    }
                                                    echo "<span class='badge badge-edit'><a href='manage_product.php?id=".$row['id']."'>Edit</a></span>&nbsp"; //edit product button
                                                    echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>&nbsp"; //delete product button
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require 'footer.inc.php';
?>