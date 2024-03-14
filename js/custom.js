// function for user send_message
function send_message() {
    let name = jQuery("#name").val();
    let email = jQuery("#email").val();
    let mobile = jQuery("#mobile").val();
    let message = jQuery("#message").val();

    if(name == '') {
        alert("Error! - Enter your name");
    }
    else if(email == '') {
        alert("Error! - Enter your email");
    }
    else if(mobile == '') {
        alert("Error! - Enter your mobile number");
    }
    else if(message == '') {
        alert("Error! - Enter your password");
    }
    else {
        // by Video
        // jQuery.ajax({
        //     url: 'send_message.php',
        //     type: 'post',
        //     data: 'name=' + name + '&email=' + email + '&mobile=' + mobile +  '&message=' + message,
        //     success: function(result) {
        //         alert(result);
        //     }
        // });

        // by ChatGPT
        jQuery.ajax({
            url: 'send_message.php',
            type: 'post',
            data: { 
                name: name,
                email: email,
                mobile: mobile,
                message: message
            },
            success: function(result) {
                alert(result);
            }
        });
        
    }
}


// function for user_registeration
    function user_register() {
        jQuery('.field_error').html('');
        let name = jQuery("#name").val();
        let email = jQuery("#email").val();
        let mobile = jQuery("#mobile").val();
        let password = jQuery("#password").val();
        let is_error = '';

        if(name == '') {
            jQuery('#name_error').html('Please enter your name');
            is_error = 'yes';
        }
        if(email == '') {
            jQuery('#email_error').html('Please enter your email');
            is_error = 'yes';
        }
        if(mobile == '') {
            jQuery('#mobile_error').html('Please enter your mobile');
            is_error = 'yes';
        }
        if(password == '') {
            jQuery('#password_error').html('Please enter your password');
            is_error = 'yes';
        }
        if(is_error == '') {
            jQuery.ajax({
                url: 'register_submit.php',
                type: 'post',
                data: { 
                    name: name,
                    email: email,
                    mobile: mobile,
                    password: password
                },
                success: function(result) {
                    if(result == 'email_present') {
                        jQuery("#email_error").html('Email id alerady exists');
                    }
                    if(result == 'insert') {
                        jQuery(".register_msg p").html('Thank you for registration');
                    }
                }
            });
        } 
    }


// function for user_login
    function user_login() {
        jQuery('.field_error').html('');
        let email = jQuery("#login_email").val();
        let password = jQuery("#login_password").val();
        let is_error = '';

        if(email == '') {
            jQuery('#login_email_error').html('Please enter your email');
            is_error = 'yes';
        }
        if(password == '') {
            jQuery('#login_password_error').html('Please enter your password');
            is_error = 'yes';
        }
        if(is_error == '') {
            jQuery.ajax({
                url: 'login_submit.php',
                type: 'post',
                // data: { 
                //     email: email,
                //     password: password
                // },
                data: 'email=' + email + '&password=' + password,
                success: function(result) {
                    if(result == 'wrong') {
                        jQuery(".login_msg p").html('Please enter valid login details');
                    }
                    if(result == 'valid') {
                        window.location.href = window.location.href;
                    }
                }
            });
        } 
    }


// function for add_to_cart
    function manage_cart(pid, type) {
        let qty = '';
        if(type == 'update') {
            qty = jQuery("#" + pid + "qty").val();
        }
        else {
            qty = jQuery("#qty").val();
            window.location.href = window.location.href;
        }

            jQuery.ajax({
                url: 'manage_cart.php',
                type: 'post',
                data: 'pid=' + pid + '&qty=' + qty + '&type=' + type,
                success: function(result) {
                    if(type == 'update' || type == 'remove') {
                        window.location.href = window.location.href;
                    }
                   jQuery('htc__qua').html(result);
                }
            });
        } 


// Function for product sorting
function sort_product_drop(cat_id, site_path) {
    let sort_product_id = jQuery('#sort_product_id').val();
    window.location.href = site_path + "categories.php?id="+ cat_id +"&sort=" + sort_product_id;
}