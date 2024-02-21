<?php
    require 'header.inc.php';

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
$msg = '';

if(isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($conn, $_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM product WHERE id='$id'");
    $check = mysqli_num_rows($result);
    if($check > 0) {
        $row = mysqli_fetch_assoc($result);
        $categories = $row['categories'];
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
    $image = get_safe_value($conn, $_POST['image']);
    $short_desc = get_safe_value($conn, $_POST['short_desc']);
    $description = get_safe_value($conn, $_POST['description']);
    $meta_title = get_safe_value($conn, $_POST['meta_title']);
    $meta_desc = get_safe_value($conn, $_POST['meta_desc']);
    $meta_keyword = get_safe_value($conn, $_POST['meta_keyword']);

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
   
    if($msg == '') {
        if(isset($_GET['id']) && $_GET['id'] != '') {
            mysqli_query($conn, "UPDATE categories set categories='$categories' WHERE id=$id");  //applying sql query for inserting categories into database
        } 
        else {
            mysqli_query($conn, "INSERT INTO categories (categories, status) VALUES ('$categories', '1')");  //applying sql query for inserting categories into database
        }
        header('location: categories.php');
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
                    <form action="" method="post">
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
                                <label for="name" class="form-control-label">Product Name</label>
                                <input type="text" name="name" placeholder="Enter product name" class="form-control" required value="<?php echo $name?>">
                        </div>

                        <!-- Product MRP -->
                        <div class="form-group">
                                <label for="mrp" class="form-control-label">MRP</label>
                                <input type="text" name="mrp" placeholder="Enter product mrp" class="form-control" required value="<?php echo $mrp?>">
                        </div>

                        <!-- Product Price -->
                        <div class="form-group">
                                <label for="price" class="form-control-label">Price</label>
                                <input type="text" name="price" placeholder="Enter product price" class="form-control" required value="<?php echo $price?>">
                        </div>

                        <!-- Product quantity -->
                        <div class="form-group">
                                <label for="qty" class="form-control-label">Quantity</label>
                                <input type="text" name="qty" placeholder="Enter product quantities" class="form-control" required value="<?php echo $qty?>">
                        </div>

                        <!-- Product image -->
                        <div class="form-group">
                                <label for="image" class="form-control-label">Product Image</label>
                                <input type="text" name="image" placeholder="Enter product image" class="form-control" required value="<?php echo $image?>">
                        </div>

                        <!-- Short description -->
                        <div class="form-group">
                                <label for="short_desc" class="form-control-label">Short Description</label>
                                <textarea name="short_desc" placeholder="Enter short description" class="form-control" required value="<?php echo $short_desc?>"></textarea>
                        </div>
                    
                        <!-- Description -->
                        <div class="form-group">
                                <label for="description" class="form-control-label">Description</label>
                                <textarea name="description" placeholder="Enter description" class="form-control" required value="<?php echo $description?>"></textarea>
                        </div>
                    
                        <!-- Meta title -->
                        <div class="form-group">
                                <label for="meta_title" class="form-control-label">Meta Title</label>
                                <input type="text" name="meta_title" placeholder="Enter meta_title" class="form-control" required value="<?php echo $meta_title?>">
                        </div>
                    
                        <!-- Meta description -->
                        <div class="form-group">
                                <label for="meta_desc" class="form-control-label">Meta Description</label>
                                <textarea name="meta_desc" placeholder="Enter meta description" class="form-control" required value="<?php echo $meta_desc?>"></textarea>
                        </div>
                    
                        <!-- Meta keyword -->
                        <div class="form-group">
                                <label for="meta_keyword" class="form-control-label">Meta Keyword</label>
                                <textarea name="meta_keyword" placeholder="Enter meta keyword" class="form-control" required value="<?php echo $meta_keyword?>"></textarea>
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