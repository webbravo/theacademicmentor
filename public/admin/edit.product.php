    <?php $page_title = "Edit a Product";?>
    <?php include_once("includes/head.php");?> 

    <?php   /* Import Class files*/ global $product; ?>
    <?php 
        $id = $_GET["id"];
        if(checkid($id) == false) die("Execution failed");
        $productInfo = $product->get_product_by_id($id);

        // Get the Product detail from the array
        $product_name  = $productInfo["name"];
        $product_type  = $productInfo["product_type"];
        $product_brand = $productInfo["brand"];
        $product_price = $productInfo["price"];
        $product_photo = $productInfo["photo"];
        $description   = $productInfo["description"];
    ?>
    <?php 
        if(isset($_POST['update_product']) == true){

            
            $product_name      =  trim( $_POST['product_name']);
            $product_type      =  trim( $_POST['product_type']);
            $product_brand     =  trim($_POST['brand']);
            $product_price     =  trim($_POST['price']);
            $product_photo     =  $_FILES['photo'];
            $description       =  trim($_POST['description']);
    
            // PERFORM DATA VALIDATION  
               $validate = $product->validate( $product_name,  $description);
               if(!empty($validate) && $validate !== "") $alert = $validate;
               $update_product = $product->update($id, $product_name, $product_type, $product_brand, $product_price, $product_photo, $description);                    

              # Call the update_product() Method 
               if($update_product === true){
                  // If the Product Was Updated 
                   $alert =  '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                  Product was updated!
                                <a class="alert-link" target="_new" href="products.php"> See list </a>.
                            </div>';
               }
            
        }
    ?>
    
    <body class="fixed-top">

        <!-- wrapper -->
        <div id="wrapper">
            <!-- BEGIN HEADER -->
            <?php include_once("includes/header_horizon.php");?>
            <!-- END HEADER -->

            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->

            <!-- BEGIN CONTAINER -->
            <div class="page-container">

                <?php include_once("includes/navbar.php");?>

                <!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4 class="pull-left">Dashboard</h4>

                                            <ol class="breadcrumb pull-right">
                                                <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                                                <li>Update product</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end .page title-->

                        <!--THE ADD PRODUCTS FORM -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="panel-heading">
                                        <h2 class="h2 text-center">Update product Details </h2>
                                        <?php if(isset($alert)) echo strtolower( $alert);?>
                                    </div>
                                    <div class="panel-body">
                                        <form method="POST" action="<?php $_SERVER["PHP_SELF"];?>" enctype="multipart/form-data" class="form-horizontal group-border stripped">
                                        
                                        <!-- Product Name  -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Product Name</label>
                                                <div class="col-sm-6">
                                                <input type="text" name="product_name" placeholder="Product name "
                                                class="form-control" value="<?php if(isset( $product_name)) echo  $product_name;?>" required="">
                                                </div>
                                            </div>
                                            <!-- Product Name --> 

                                            <!-- Product Type  -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Product type</label>
                                                <div class="col-sm-6">
                                                <!-- SELECT MENU -->
                                                <select class="form-control" name="product_type" id="" required="">
                                                    <option>-- Choose a product type --</option>
                                                    <option <?php if($product_type === "book") echo "selected"; ?> value="book">Book Product</option>
                                                    <option <?php if($product_type === "grind_gear") echo "selected"; ?> value="grind_gear">Grind Gear</option>
                                                </select>
                                                </div>
                                            </div>
                                            <!-- Product Type -->

                                            <!-- Product brand  -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Brand / Author</label>
                                                <div class="col-sm-6">
                                                <input type="text" name="brand" placeholder="Product brand or Book author"
                                                class="form-control" value="<?php if(isset( $product_brand)) echo  $product_brand;?>" required="">
                                                </div>
                                            </div>
                                            <!-- Product brand -->   
                                    
                                            <!-- Product price  -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Product Price</label>
                                                <div class="col-sm-6">
                                                <input type="number" name="price" placeholder="Product price : 2000"  class="form-control" value="<?php if(isset( $product_price)) echo  $product_price;?>" required="">
                                                </div>
                                            </div>
                                            <!-- Product price -->  
                                            
                                            <!-- <div class="hr-line-dashed"></div> -->

                                            <!-- Product Photo -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Product photo</label>
                                                <div class="col-sm-6">
                                                    <input type="file" name="photo" class="form-control"\>
                                                    <br>
                                                </div>
                                                <div class="col-md-6">
                                                    <img width="200" src="../<?php if(isset( $product_photo)) echo  $product_photo;?>" alt="">
                                                </div>
                                            </div>
                                            <!-- Product Photo -->                                        

                                            <!-- Product Description -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Description</label>
                                                <!-- <span>200 word Max</span> -->
                                                <div class="col-sm-6">
                                                    <textarea class="form-control" name="description" required=""><?php if(isset( $description)) echo  $description;?></textarea>
                                                    <br>
                                                </div>
                                            </div>
                                            <!-- Product Description --> 


                                            <div class="hr-line-dashed"></div>
                                            
                                            <div class="form-group">
                                                <div style="margin-left:30px;" class="col-sm-6">
                                                    <button class="btn btn-success btn-md" type="submit" name="update_product">
                                                        Update Product 
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--THE ADD PRODUCT FORM -->
                    


                    </div> 
                    <div class="clearfix"></div>
                    <!--THE FOOTER AREA-->
                    <?php include_once("includes/footer.php"); ?>
                    <!--THE FOOTER AREA-->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTAINER -->
        </div>
        <!-- /wrapper -->


        <!-- SCROLL TO TOP -->
        <a href="#" id="toTop"></a>


        <!-- PRELOADER -->
        <div id="preloader">
            <div class="inner">
                <span class="loader"></span>
            </div>
        </div>
        <!-- /PRELOADER -->


        <!-- JAVASCRIPT FILES -->
        <?php include_once("includes/js_file.php");?>

    </body>
</html>