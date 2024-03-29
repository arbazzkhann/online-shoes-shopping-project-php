<?php 
    require 'header.php';   //header file

    if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) { ?>
        <script>
        window.location.href = "index.php";
        </script>
<?php 
    } 

    
    $cart_total = 0;

    // POST request from 'form'
    if(isset($_POST['submit'])) {
        $address = get_safe_value($conn, $_POST['address']);
        $city = get_safe_value($conn, $_POST['city']);
        $pincode = get_safe_value($conn, $_POST['pincode']);
        $payment_type = get_safe_value($conn, $_POST['payment_type']);
        $user_id = $_SESSION['USER_ID'];
        // for finding total price of cart items
        foreach($_SESSION['cart'] as $key => $val) {    
            $productArr = get_product($conn, '', '', $key);
            $price = $productArr[0]['price'];
            $qty = $val['qty'];
            $cart_total = $cart_total + ($price * $qty);
        }

        $total_price = $cart_total;
        $payment_status = 'pending';

        // If payment method is COD
        if($payment_type == 'COD') {
            $payment_status = 'success';
        }
        $order_status = '1';
        $added_on = date('Y-m-d h:i:s');

        //sql for inserting address and order details into database
        $sql = "INSERT INTO `order` (user_id, address, city, pincode, payment_type, payment_status, order_status, added_on, total_price) VALUES ('$user_id', '$address', '$city', '$pincode', '$payment_type', '$payment_status', '$order_status', '$added_on', '$total_price')";
        mysqli_query($conn, $sql);

        //fetching order id from database
        $order_id = mysqli_insert_id($conn);

        foreach($_SESSION['cart'] as $key => $val) {    
            $productArr = get_product($conn, '', '', $key);
            $price = $productArr[0]['price'];
            $qty = $val['qty'];

            //sql quert for inserting order_details into database
            $sql = "INSERT INTO `order_details` (order_id, product_id, qty, price) VALUES ('$order_id', '$key', '$qty', '$price')";
            mysqli_query($conn, $sql);
        }

        // unsetting cart items
        unset($_SESSION['cart']);

        //if Payment Method is instamojo 
        if($payment_type == 'instamojo') {
        
            // Finding user detils with user id
            $sql = "SELECT * FROM `users` WHERE id = '$user_id'";
            $result = mysqli_query($conn, $sql);
            $userArr = mysqli_fetch_assoc($result);

            $ch = curl_init();
		
            curl_setopt($ch, CURLOPT_URL, 'https://api.instamojo.com/v2/payment_requests/');
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            // curl_setopt($ch, CURLOPT_HTTPHEADER,array('Authorization: Bearer y70kak2K0Rg7J4PAL8sdW0MutnGJEl'));
            curl_setopt($ch, CURLOPT_HTTPHEADER,array("X-Api-Key:test_b5c1f10d1a5caf52895db93e6e9","X-Auth-Token:test_c3bad4119bf94ba7de76c0da657"));

            $payload = Array(
                'purpose' => 'Buy Product',
                'amount' => $total_price,
                'phone' => $userArr['mobile'],
                'buyer_name' => $userArr['name'],
                'redirect_url' => 'http://localhost/online-shoes-shopping-project-php/payment_complete.php',
                'send_email' => false,
                'send_sms' => false,
                'email' => $userArr['email'],
                'allow_repeated_payments' => false
            );
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
            $response = curl_exec($ch);
            curl_close($ch);

            $response=json_decode($response);
            $_SESSION['TID']=$response->payment_request->id;
                mysqli_query($conn, "UPDATE `order` SET txnid='".$response->payment_request->id."' where id='".$order_id."'");
            ?>
            <script>
                window.location.href='<?php echo $response->payment_request->longurl?>';
            </script>
            <?php   
        }
        else { 
            ?>
                <script>
                    window.location.href = "thank_you.php";
                </script>
            <?php 
        }  

    }
?>

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area"
    style="background: url('UI Images/frontend images/grey 1920x270.png') no-repeat center center/cover;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.html">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">checkout</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="checkout-wrap ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout__inner">
                    <div class="accordion-list">
                        <div class="accordion">


                        <!-- Login/Registration Section -->
                        <?php 
                            $accordion_class = 'accordion__title';
                            if(!isset($_SESSION['USER_LOGIN'])) { 
                                $accordion_class = 'accordion__hide';    
                        ?>
                            <div class="accordion__title">
                                Login/Registration
                            </div>
                            <div class="accordion__body">
                                <div class="accordion__body__form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="checkout-method__login">
                                                <form id="register-form" method="post">
                                                    <h5 class="checkout-method__title">Login</h5>
                                                    <div class="single-input">
                                                        <input type="email" name="login_email" id="login_email" placeholder="Email*" style="width:100%">
                                                        <span class="field_error" id="login_email_error"></span>
                                                    </div>
                                                    <div class="single-input">
                                                        <input type="password" name="login_password" id="login_password" placeholder="Password*" style="width:100%">
                                                        <span class="field_error" id="login_password_error"></span>
                                                    </div>
                                                    <div class="dark-btn">
                                                        <button type="button" class="fv-btn" onclick="user_login()">Login</button>
                                                    </div>
                                                </form>
                                                <div class="form-output login_msg">
                                                    <p class="form-messege field_error"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-method__login">
                                                <form id="register-form" method="post">
                                                    <h5 class="checkout-method__title">Register</h5>
                                                    <div class="single-input">
                                                    <input type="text" name="name" id="name" placeholder="Full Name*" style="width:100%">
                                                    <span class="field_error" id="name_error"></span>
                                                    </div>
                                                    <div class="single-input">
                                                        <input type="email" name="email" id="email" placeholder="Email*" style="width:100%">
                                                        <span class="field_error" id="email_error"></span>
                                                    </div>
                                                    <div class="single-input">
                                                        <input type="text" name="mobile" id="mobile" placeholder="Mobile*" style="width:100%">
                                                        <span class="field_error" id="mobile_error"></span>
                                                    </div>
                                                    <div class="single-input">
                                                        <input type="password" name="password" id="password" placeholder="Password*" style="width:100%">
                                                        <span class="field_error" id="password_error"></span>
                                                    </div>
                                                    <div class="dark-btn">
                                                        <button type="button" class="fv-btn" onclick="user_register()">Register</button>
                                                    </div>
                                                </form>
                                                <div class="form-output register_msg">
                                                    <p class="form-messege field_error"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>


                            <!-- Address Information Section -->
                            <div class="<?php echo $accordion_class?>">
                                Address Information
                            </div>
                            <form method="post">
                                <div class="accordion__body">
                                    <div class="bilinfo">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="single-input">
                                                        <input type="text" name="address" placeholder="Street Address" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-input">
                                                        <input type="text" name="city" placeholder="City/State" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-input">
                                                        <input type="text" name="pincode" placeholder="Pin code" required>
                                                    </div>
                                                </div>  
                                            </div>
                                    </div>
                                </div>
                            

                            <!-- Payment Information Section -->
                            <div class="<?php echo $accordion_class?>">
                                payment information
                            </div>
                            <div class="accordion__body">
                                <div class="paymentinfo">
                                    <div class="single-method">
                                        &nbsp; &nbsp; COD <input type="radio" name="payment_type" value="COD" required />
                                        &nbsp; &nbsp; Instamojo <input type="radio" name="payment_type" value="instamojo" required />
                                    </div>
                                    <input class="fv-btn" type="submit" name="submit" />
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="order-details">
                    <h5 class="order-details__title">Your Order</h5>
                    <div class="order-details__item">
                        <?php
                            $cart_total = 0;
                            foreach($_SESSION['cart'] as $key => $val) {
                                $productArr = get_product($conn, '', '', $key);
                                $pname = $productArr[0]['name'];
                                $mrp = $productArr[0]['mrp'];
                                $price = $productArr[0]['price'];
                                $image = $productArr[0]['image'];
                                $qty = $val['qty'];
                                $cart_total = $cart_total + ($price * $qty);
                        ?>
                        <div class="single-item">
                            <div class="single-item__thumb">
                                <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $image?>" alt="ordered item">
                            </div>
                            <div class="single-item__content">
                                <a href="#"><?php echo $pname?></a>
                                <span class="price">₹ <?php echo $price * $qty?></span>
                            </div>
                            <div class="single-item__remove">
                                <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i
                                        class="zmdi zmdi-delete"></i></a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="ordre-details__total">
                        <h5>Order total</h5>
                        <span class="price">₹ <?php echo $cart_total?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area end -->


<?php require 'footer.php'?>