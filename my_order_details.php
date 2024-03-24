<?php 
    require 'header.php';
    $order_id = get_safe_value($conn, $_GET['id']);

?>
<?php //prx($_SESSION)?>
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area"
    style="background: url('UI Images/frontend images/grey 1920x270.png') no-repeat center center/cover;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.php">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <a class="breadcrumb-item" href="my_order.php">My Order</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Order Details</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->

<!-- wishlist-area start -->
<div class="wishlist-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="wishlist-content">
                    <form action="#">
                        <div class="wishlist-table table-responsive">
                            <table>
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
                                        $sql = "SELECT DISTINCT(order_details.id), order_details.*, product.name, product.image FROM `order_details`, `product`, `order` WHERE order_details.order_id = '$order_id' AND `order`.user_id = '$uid' AND order_details.product_id = product.id";  
                                        $result = mysqli_query($conn, $sql);

                                        $total_price = 0;

                                        // Loop start
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $total_price = $total_price + ($row['qty'] * $row['price']);
                                    ?>

                                    <tr>
                                        <td class="product-add-to-cart"><?php echo $row['name']?></td>
                                        <!-- <td class="product-name"><img src="<?php// echo $row['image']?>"></td> -->
                                        <td class="product-name"><img height="100px" src="<?php echo PRODUCT_IMAGE_SITE_PATH . $row['image']?>"
                                        alt="full-image"></td>
                                        <td class="product-name"> <?php echo $row['qty']?> </td>
                                        <td class="product-name"> <?php echo $row['price']?> </td>
                                        <td class="product-name">₹ <?php echo $row['qty'] * $row['price']?> </td>
                                    </tr>

                                    <?php }?>  <!--Loop end-->


                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="product-name"> Total Price </td>
                                        <td class="product-name">₹ <?php echo $total_price?> </td>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- wishlist-area end -->


<?php require 'footer.php'?>