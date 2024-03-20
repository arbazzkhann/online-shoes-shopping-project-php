<?php
    require 'header.inc.php'; //header

$categories_id = '';
$name = '';
$mrp = '';
$price = '';
$qty = '';
$image = '';
$short_desc = '';
$description = '';
$meta_title = '';
$meta_desc = '';
$meta_keyword = '';
$best_seller = '';

$msg = '';
$image_required = 'required';


if(isset($_GET['id']) && $_GET['id'] != '') {
    $image_required = '';
    $id = get_safe_value($conn, $_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM product WHERE id='$id'");
    $check = mysqli_num_rows($result);
    if($check > 0) {
        $row = mysqli_fetch_assoc($result);
        $categories_id = $row['categories_id'];
        $name = $row['name'];
        $mrp = $row['mrp'];
        $price = $row['price'];
        $qty = $row['qty'];
        $image = $row['image'];
        $short_desc = $row['short_desc'];
        $description = $row['description'];
        $meta_title = $row['meta_title'];
        $meta_desc = $row['meta_desc'];
        $meta_keyword = $row['meta_keyword'];
        $best_seller = $row['best_seller'];
    }
    else {
        header('location: product.php');
        die();
    }
}


if(isset($_POST['submit'])) {
    $categories_id = get_safe_value($conn, $_POST['categories_id']);
    $name = get_safe_value($conn, $_POST['name']);
    $mrp = get_safe_value($conn, $_POST['mrp']);
    $price = get_safe_value($conn, $_POST['price']);
    $qty = get_safe_value($conn, $_POST['qty']);
    $short_desc = get_safe_value($conn, $_POST['short_desc']);
    $description = get_safe_value($conn, $_POST['description']);
    $meta_title = get_safe_value($conn, $_POST['meta_title']);
    $meta_desc = get_safe_value($conn, $_POST['meta_desc']);
    $meta_keyword = get_safe_value($conn, $_POST['meta_keyword']);
    $best_seller = get_safe_value($conn, $_POST['best_seller']);

    $result = mysqli_query($conn, "SELECT * FROM product WHERE name='$name'");
    $check = mysqli_num_rows($result);
    if($check > 0) {
        if(isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($result);
            if($id == $getData['id']) {
                
            } 
            else {
                $msg = "Product already exists";
            }
        }
        else {
            $msg = "Categories already exists";
        }
    }
   
    // condition if admin select wrong format image
    if ($_FILES['image']['type'] != '' && 
    ($_FILES['image']['type'] != 'image/png' && 
     $_FILES['image']['type'] != 'image/jpg' && 
     $_FILES['image']['type'] != 'image/jpeg')) {
        $msg = "Please select image only in png / jpg / jpeg format";
    }



    if($msg == '') {
        if(isset($_GET['id']) && $_GET['id'] != '') {
            if($_FILES['image']['name'] != '') {
                $image = rand(111111111, 999999999).'_'.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],'../media/product/'. $image);

                //if admin wants to change image
                $update_sql = "UPDATE product set categories_id='$categories_id', name='$name', mrp='$mrp', price='$price', qty='$qty', short_desc='$short_desc', description='$description', meta_title='$meta_title', meta_desc='$meta_desc', meta_keyword='$meta_keyword', best_seller='$best_seller' image='$image' WHERE id=$id";
            }
            else {
                //admin dont want to change image
                $update_sql = "UPDATE product set categories_id='$categories_id', name='$name', mrp='$mrp', price='$price', qty='$qty', short_desc='$short_desc', description='$description', meta_title='$meta_title', meta_desc='$meta_desc', meta_keyword='$meta_keyword', best_seller='$best_seller' WHERE id=$id";
            }
            mysqli_query($conn, $update_sql);  //applying sql query for updating product
        } 
        else {
            //defining image with random number contatination
            $image = rand(111111111, 999999999).'_'.$_FILES['image']['name'];
            // saving image to directory
            move_uploaded_file($_FILES['image']['tmp_name'],'../media/product/'. $image);

            //applying sql query for inserting product into database
            $inserting_sql = "INSERT INTO product (categories_id, name, mrp, price, qty, short_desc, description, meta_title, meta_desc, meta_keyword, status, image, best_seller) VALUES ('$categories_id', '$name', '$mrp', '$price', '$qty', '$short_desc', '$description', '$meta_title', '$meta_desc', '$meta_keyword', 1, '$image', '$best_seller')";
            mysqli_query($conn, $inserting_sql);  //applying sql query for inserting product
        }
        header('location: product.php');
        die();
    }
}


?>

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Product</strong><small> Form</small></div>

                    <!-- form -->
                    <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body card-block">
                        <div class="form-group">
                                <label for="categories" class=" form-control-label">Category</label>
                                <select  class="form-control" name="categories_id">
                                    <option>Select Categories</option>
                                    <?php
                                    $result = mysqli_query($conn, "SELECT id, categories FROM categories ORDER BY categories ASC");
                                    while($row = mysqli_fetch_assoc($result)) {
                                        if($row['id'] == $categories_id) {
                                            echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
                                        }
                                        else {
                                            echo "<option value=".$row['id'].">".$row['categories']."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                        </div>

                        <!-- Product name -->
                        <div class="form-group">
                                <label for="name" class="form-control-label">Product Name<span class="imp_star">*</span></label>
                                <input type="text" name="name" placeholder="Enter product name" class="form-control" required value="<?php echo $name?>">
                        </div>

                        <!-- Best Seller -->
                        <div class="form-group">
                                <label for="categories" class=" form-control-label">Best Seller<span class="imp_star">*</span></label>
                                <select  class="form-control" name="best_seller" required>
                                    <option value="">Select</option>
                                    <?php
                                        if($best_seller == 0) {
                                            echo '<option value="1">Yes</option>
                                                  <option value="0" selected>No</option>';
                                        }
                                        else if($best_seller == 1) {
                                            echo '<option value="1" selected>Yes</option>
                                                  <option value="0">No</option>';
                                        } 
                                        else {
                                            echo '<option value="1">Yes</option>
                                            <option value="0">No</option>';
                                        }
                                    ?>
                                </select>
                        </div>

                        <!-- Product MRP -->
                        <div class="form-group">
                                <label for="mrp" class="form-control-label">MRP<span class="imp_star">*</span></label>
                                <input type="text" name="mrp" placeholder="Enter product mrp" class="form-control" required value="<?php echo $mrp?>">
                        </div>

                        <!-- Product Price -->
                        <div class="form-group">
                                <label for="price" class="form-control-label">Price<span class="imp_star">*</span></label>
                                <input type="text" name="price" placeholder="Enter product price" class="form-control" required value="<?php echo $price?>">
                        </div>

                        <!-- Product quantity -->
                        <div class="form-group">
                                <label for="qty" class="form-control-label">Quantity<span class="imp_star">*</span></label>
                                <input type="text" name="qty" placeholder="Enter product quantities" class="form-control" required value="<?php echo $qty?>">
                        </div>

                        <!-- Product image -->
                        <div class="form-group">
                                <label for="image" class="form-control-label">Product Image<span class="imp_star">*</span></label>
                                <input type="file" name="image" placeholder="Enter product image" class="form-control" <?php echo $image_required?>>
                        </div>

                        <!-- Short description -->
                        <div class="form-group">
                                <label for="short_desc" class="form-control-label">Short Description<span class="imp_star">*</span></label>
                                <textarea name="short_desc" placeholder="Enter short description" class="form-control" required><?php echo $short_desc?></textarea>
                        </div>
                    
                        <!-- Description -->
                        <div class="form-group">
                                <label for="description" class="form-control-label">Description<span class="imp_star">*</span></label>
                                <textarea name="description" placeholder="Enter description" class="form-control" required><?php echo $description?></textarea>
                        </div>
                    
                        <!-- Meta title -->
                        <div class="form-group">
                                <label for="meta_title" class="form-control-label">Meta Title</label>
                                <input type="text" name="meta_title" placeholder="Enter meta_title" class="form-control" value="<?php echo $meta_title?>">
                        </div>
                    
                        <!-- Meta description -->
                        <div class="form-group">
                                <label for="meta_desc" class="form-control-label">Meta Description</label>
                                <textarea name="meta_desc" placeholder="Enter meta description" class="form-control"><?php echo $meta_desc?></textarea>
                        </div>
                    
                        <!-- Meta keyword -->
                        <div class="form-group">
                                <label for="meta_keyword" class="form-control-label">Meta Keyword</label>
                                <textarea name="meta_keyword" placeholder="Enter meta keyword" class="form-control"><?php echo $meta_keyword?></textarea>
                        </div>

                    

                        <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                            <span id="payment-button-amount">Submit</span>
                        </button>
                        <div class="field_error"><?php echo $msg?></div>
                    </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    require 'footer.inc.php';
?>