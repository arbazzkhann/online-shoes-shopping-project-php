<?php 
require 'header.php'; //header file

if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN'] == 'yes') { ?>
    
    <script>
        window.location.href = 'my_order.php';
    </script>

    <?php
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
                            <a class="breadcrumb-item" href="index.php">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Login/Register</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Contact Area -->
<section class="htc__contact__area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="contact-form-wrap mt--60">
                    <div class="col-xs-12">
                        <div class="contact-title">
                            <h2 class="title__line--6">Login</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">

                        <!-- Login Form -->
                        <form id="login-form" method="post">
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="email" name="login_email" id="login_email" placeholder="Email*" style="width:100%">
                                </div>
								<span class="field_error" id="login_email_error"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="password" name="login_password" id="login_password" placeholder="Password*" style="width:100%">
                                </div>
								<span class="field_error" id="login_password_error"></span>
                            </div>

                            <div class="contact-btn">
                                <button type="button" class="fv-btn" onclick="user_login()">Login</button>
                            </div>
                        </form>
                        <div class="form-output login_msg">
                            <p class="form-messege field_error"></p>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-md-6">
                <div class="contact-form-wrap mt--60">
                    <div class="col-xs-12">
                        <div class="contact-title">
                            <h2 class="title__line--6">Register</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">

                        <!-- Registration Form -->
                        <form id="register-form" method="post">
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="text" name="name" id="name" placeholder="Full Name*"
                                        style="width:100%">
                                </div>
                                <span class="field_error" id="name_error"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="email" name="email" id="email" placeholder="Email*" style="width:100%">
                                </div>
                                <span class="field_error" id="email_error"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="text" name="mobile" id="mobile" placeholder="Mobile*" style="width:100%">
                                </div>
                                <span class="field_error" id="mobile_error"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="password" name="password" id="password" placeholder="Password*" style="width:100%">
                                </div>
                                <span class="field_error" id="password_error"></span>
                            </div>

                            <div class="contact-btn">
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
</section>
<!-- End Contact Area -->


<?php require 'footer.php'?>