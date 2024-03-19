<?php 
    require 'header.php'; //Header
    $cat_id = mysqli_real_escape_string($conn, $_GET['id']);  // Storting id into variable

    $new = "";
    $price_high = "";
    $price_low = "";
    $old = "";

    $sort_order = '';
    if(isset($_GET['sort'])) {
        $sort = $_GET['sort']; // sort type from GET Request
        switch ($sort) {    // Switch Case
            case 'new':
                $sort_order = " ORDER BY product.id DESC";
                $new = "selected";
                break;
            case 'price_high':
                $sort_order = " ORDER BY product.price ASC";
                $price_high = "selected";
                break;
            case 'price_low':
                $sort_order = " ORDER BY product.price DESC";
                $price_low = "selected";
                break;
            case 'old':
                $sort_order = " ORDER BY product.id ASC";
                $old = "selected";
                break;
            default:
                // Handle invalid sort option
                break;
        }
    }

    //condition if user put negative id in url
    if($cat_id > 0 ) {
        $get_product = get_product($conn, '', $cat_id, '', '', $sort_order);  //calling getproduct function and storing into variable
    }
    else { ?>
        <script>
            window.location.href = "index.php";
        </script>   
    <?php }?>
    
<div class="body__overlay"></div>
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
                            <a class="breadcrumb-item" href="categories.php?id=<?php echo $get_product['0']['categories_id']?>"><?php echo $get_product['0']['categories']?></a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Product Grid -->
<section class="htc__product__grid bg__white ptb--100">
    <div class="container">
        <div class="row">
            <?php 
            if(count($get_product) > 0) {
            ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="htc__product__rightidebar">
                    <div class="htc__grid__top">
                        <div class="htc__select__option">
                            <select class="ht__select" onchange="sort_product_drop('<?php echo $cat_id?>', '<?php echo SITE_PATH?>')" id="sort_product_id">
                                <option value="new" <?php echo $new?>>New Products</option>
                                <option value="price_high" <?php echo $price_high?>>High to Low</option>
                                <option value="price_low" <?php echo $price_low?>>Low to High</option>
                                <option value="old" <?php echo $old?>>Old Products</option>
                            </select>
                        </div>
                    </div>
                    <!-- Start Product View -->
                    <div class="row">
                        <div class="shop__grid__view__wrap">
                            <div role="tabpanel" id="grid-view"
                                class="single-grid-view tab-pane fade in active clearfix">
                                <?php 
                                    foreach($get_product as $list) { //loop for printing latest products
                                ?>
                                <!-- Start Single Category -->
                                <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                    <div class="category">
                                        <div class="ht__cat__thumb">
                                            <a href="product.php?id=<?php echo $list['id']?>">
                                                <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image']?>">
                                            </a>
                                        </div>

                                        <div class="fr__product__inner">
                                            <h4><a href="product.php?id=<?php echo $list['id']?>"><?php echo $list['name']?></a></h4>
                                            <ul class="fr__pro__prize">
                                                <li class="old__prize">₹ <strike><?php echo $list['mrp']?></strike></li>
                                                <li>₹ <?php echo $list['price']?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                                <!-- End Single Category -->
                            </div>
                        </div>
                    </div>
                    <!-- End Product View -->
                </div>
                <?php 
                } 
                else {
                    echo "DATA NOT FOUND!";
                }
                ?>
            </div>
        </div>
    </div>
</section>
<!-- End Product Grid -->
<!-- End Banner Area -->
<?php require 'footer.php'?>