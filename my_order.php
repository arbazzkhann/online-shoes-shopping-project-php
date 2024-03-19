<?php require 'header.php'?>  <!--header-->
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
                            <a class="breadcrumb-item" href="my_order.php">Order</a>
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
                                        <th class="product-thumbnail">Order ID</th>
                                        <th class="product-name"><span class="nobr">Order Date</span></th>
                                        <th class="product-price"><span class="nobr"> Address </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Payment Type </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Payment Status </span></th>
                                        <th class="product-add-to-cart"><span class="nobr">Order Status</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php


                                        //userid from session array
                                        $uid = $_SESSION['USER_ID'];  
                                        
                                        //sql form selecting user order by user id
                                        $sql = "SELECT `order`.*, order_status.name AS order_status_str FROM `order`, order_status WHERE `order`.user_id = '$uid' AND order_status.id = `order`.order_status";  
                                        $result = mysqli_query($conn, $sql);

                                        while($row = mysqli_fetch_assoc($result)) { 
                                    ?>

                                    <tr>
                                        <td class="product-add-to-cart"><a href="my_order_details.php?id=<?php echo $row['id']?>"><?php echo $row['id']?></a></td>
                                        <td class="product-name"> <?php echo $row['added_on']?> </td>
                                        <td class="product-name"> 
                                            <?php echo $row['address']?><br/> 
                                            <?php echo $row['city']?><br/> 
                                            <?php echo $row['pincode']?><br/> 
                                        </td>
                                        <td class="product-name"> <?php echo $row['payment_type']?> </td>
                                        <td class="product-name"> <?php echo $row['payment_status']?> </td>
                                        <td class="product-name"> <?php echo $row['order_status_str']?> </td>
                                        </td>
                                    </tr>
                                    <?php }?>
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