<?php
    require 'header.inc.php';
    $order_id = get_safe_value($conn, $_GET['id']);
    if(isset($_POST['update_order_status'])) {
        $update_order_status = $_POST['update_order_status'];

        // sql for updating status
        $sql = "UPDATE `order` SET order_status = '$update_order_status' WHERE id = '$order_id'";
        mysqli_query($conn, $sql);

    }
?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title"> Order Master </h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th><span class="nobr">Product Image</span></th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        //userid from session array
                                        $uid = $_SESSION['USER_ID'];  
                                        
                                        //sql form selecting user order by user id
                                        $sql = "SELECT DISTINCT(order_details.id), order_details.*, product.name, product.image, `order`.address, `order`.city, `order`.pincode FROM `order_details`, `product`, `order` WHERE order_details.order_id = '$order_id' AND `order`.user_id = '$uid' AND order_details.product_id = product.id";  
                                        $result = mysqli_query($conn, $sql);

                                        $total_price = 0;

                                        // Loop start
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $address = $row['address'];
                                            $city = $row['city'];
                                            $pincode = $row['pincode'];
                                            $total_price = $total_price + ($row['qty'] * $row['price']);
                                    ?>

                                    <tr>
                                        <td class="product-add-to-cart"><?php echo $row['name']?></td>
                                        <!-- <td class="product-name"><img src="<?php// echo $row['image']?>"></td> -->
                                        <td class="product-name"><img height="60px"
                                                src="<?php echo PRODUCT_IMAGE_SITE_PATH . $row['image']?>"
                                                alt="full-image"></td>
                                        <td class="product-name"> <?php echo $row['qty']?> </td>
                                        <td class="product-name"> <?php echo $row['price']?> </td>
                                        <td class="product-name">₹ <?php echo $row['qty'] * $row['price']?> </td>
                                    </tr>

                                    <?php }?>
                                    <!--Loop end-->


                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="product-name"> Total Price </td>
                                        <td class="product-name">₹ <?php echo $total_price?> </td>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <!-- Div for address details -->
                            <div id="address_details">
                                <strong>Address: </strong>
                                <?php echo $address?>, <?php echo $city?>, <?php echo $pincode?> <br /><br />
                                <strong>Order Status: </strong>
                                <?php 
                                    // sql for fetching order status 
                                    $sql = "SELECT order_status.name FROM order_status, `order` WHERE `order`.id = '$order_id' AND `order`.order_status = order_status.id";
                                    $order_status_arr = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                                    echo $order_status_arr['name'];
                                ?>

                                <div>
                                    <!-- Form for status updating -->
                                    <form method="post">
                                        <select class="form-control" name="update_order_status">
                                            <option>Select status</option>
                                            <?php
                                            $result = mysqli_query($conn, "SELECT * FROM `order_status`");
                                            while($row = mysqli_fetch_assoc($result)) {
                                                if($row['id'] == $categories_id) {
                                                    echo "<option selected value=".$row['id'].">".$row['name']."</option>";
                                                }
                                                else {
                                                    echo "<option value=".$row['id'].">".$row['name']."</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input type="submit" class="form-control" />
                                    </form>
                                </div>
                            </div>
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