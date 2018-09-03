    <?php $page_title = "Add a Product";?>
    <?php include_once("includes/head.php");?> 
    <?php 
        if(isset($_POST['create_product']) == true){
          
            global $product;

            $product_name      =  trim( $_POST['product_name']);
            $product_type      =  trim( $_POST['product_type']);
            $product_brand     =  trim($_POST['brand']);
            $product_price     =  trim($_POST['price']);
            $product_photo     =  $_FILES['photo'];
            $description       =  trim($_POST['description']);

            // PERFORM DATA VALIDATION  
                $validate = $product->validate( $product_name,  $description);

                if(!empty($validate) && $validate !== ""){
                    $alert = $validate;
                }else{
                    $add_product = $product->add($product_name, $product_type, $product_brand, $product_price, $product_photo, $description);
                        if($add_product == true){
                          // If the Product Was Added!
                           $alert =  '<div class="alert alert-success alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        One Product added!
                                        <a class="alert-link" target="_new" href="products.php"> See list </a>.
                                     </div>';
                        }
                        
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
                                                <li>Add a product</li>
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
                                        <h2 class="h2 text-center">Add a product </h2>
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
                                                      <option value="book">Book Product</option>
                                                      <option value="grind_gear">Grind Gear</option>
                                                  </select>
                                                </div>
                                            </div>
                                            <!-- Product Type -->

                                            <!-- Product brand  -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Brand / Author</label>
                                                <div class="col-sm-6">
                                                  <input type="text" name="brand" placeholder="Product brand or Book author"
                                                   class="form-control" value="<?php if(isset( $brand)) echo  $brand;?>" required="">
                                                </div>
                                            </div>
                                            <!-- Product brand -->   
                                      
                                             <!-- Product price  -->  
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Product Price</label>
                                                <div class="col-sm-6">
                                                   <input type="number" name="price" placeholder="Product price : 2000"  class="form-control" value="<?php if(isset( $price)) echo  $price;?>" required="">
                                                </div>
                                            </div>
                                            <!-- Product price -->  
                                            
                                            <!-- <div class="hr-line-dashed"></div> -->

                                            <!-- Product Photo -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Product photo</label>
                                                <div class="col-sm-6">
                                                    <input type="file" name="photo" class="form-control" required="">
                                                    <br>
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
                                                    <button class="btn btn-success btn-md" type="submit" name="create_product">
                                                        Add Product 
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