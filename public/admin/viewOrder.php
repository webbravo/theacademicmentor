<?php $page_title = "View all orders";?>
<?php include_once("includes/head.php");?> 
<?php 

    global $orders;
    
// CATCH THE ORDER ID, SO WE CAN GET THE ORDER ITEMS
    $orderID =  !empty($_GET['orderID']) ? (int)$_GET['orderID'] : 1; 

//  Call the GET METHODS
    $select_order = $orders->viewOrders($orderID); 
    
    // echo "<pre>".print_r($select_order, true)."</pre>";
    // echo "<br/>";
    // echo $orderID;
    // exit;  
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
                                        <!-- <h3 class="pull-left">Customer test</h3> -->
                                        <ol class="breadcrumb pull-right">
                                            <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                                            <li>Order list</li>
                                        </ol>

                                    </div>
                                </div>
                            </div>
                        </div><!-- end .page title-->

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="well">
                                    <h3 class="">Order list</h3><br>
                                    <form  method="post" enctype="multipart/form-data" id="form-product" class="">
                                        <div style="overflow-x:auto;">
                                            <a href="<?php echo isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : "orders.php"; ?>"><h4>back to orders</h4></a>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td class="text-left"><h4>Product ID</h4></td>
                                                        <td class="text-left"><h4>Product Photo</h4></td>
                                                        <td class="text-left"><h4>Product Name</h4></td>
                                                        <td class="text-left"><h4>Product price</h4></td>
                                                        <td class="text-left"><h4>Quatitly</h4></td>
                                                        <!-- <td class="text-left"><h4>Status</h4></td>
                                                        <td class="text-center"><h4>Action</h4></td> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php while ($rows = $select_order->fetch()) :  ?>
                                                    <tr>
                                                        <td class="text-left"><h4><?php echo $rows['id']; ?></h4></td>
                                                        <td class="text-left"><img width="150" src="../<?php echo $rows['photo']; ?>" alt="product photo"></td>
                                                        <td class="text-left"><h5><?php echo $rows['name']; ?></h5></td>
                                                        <td class="text-left"><h4><b class="text-success"><?php echo "N".number_format($rows['price'], 2, ".", ","); ?></h4></b></td>
                                                        <td class="text-left"><h4><?php echo $rows['quantity']; ?></h4></td>
                                                    </tr>
                                                    <!-- INCLUDE THE MODELS TO THE WHILE LOOP -->
                                                    <?php  //include("includes/customers.modal.php");?>
                                                    <?php endwhile; ?>  

                                                    
                                                </tbody>
                                            </table>

                                            <div class="dataTables_paginate paging_bootstrap" id="basic-datatables_paginate">
                                                
                                                <ul class="pagination">
                                                    <?php 
                                                    // if($pagination->total_pages() > 1){
                                                        
                                                    //     // Previous Button  
                                                    //     if($pagination->has_previous_page()){
                                                    //         echo "<li class='prev'><a href='customers.php?page=".$pagination->previous_page()."'>← Previous </a></li>";
                                                    //     }
                                                        
                                                    //         // Page Numbers
                                                    //     for ($i=1; $i <= $pagination->total_pages() ; $i++) { 

                                                    //         if($i == $current_page){
                                                    //                 echo "<li class='active'><a ><b>".$i."</b></a></li>";
                                                    //         }else{
                                                    //                 echo "<li><a href='customers.php?page=".$i." '>".$i."</a></li>";
                                                    //         }

                                                    //     }

                                                    //         // Next Button  
                                                    //     if($pagination->has_next_page()){
                                                    //         echo "<li class='next'><a href='customers.php?page=".$pagination->next_page()."'>Next → </a></li>";
                                                    //     }
                                                        
                                                    // }
                                                    ?>
                                                
                                                
                                                </ul>
                                            </div>
                                            </div>
                                    </form>
                                </div>
                            </div> 
                        </div>


                        <div class="row">
                            <div class="col-sm-6 text-left"></div>
                            <div class="col-sm-6 text-right">
                                 Showing 1 to <?php echo $per_page; ?> from  (Page <?php echo $pagination->current_page; ?> )
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div> 

                    <div class="clearfix"></div>
                    <?php include_once("includes/footer.php");?>
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
        </div><!-- /PRELOADER -->


        <!-- JAVASCRIPT FILES -->

        <script type="text/javascript" src="assets/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="assets/plugins/metis-menu/metisMenu.min.js"></script>
        <script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/plugins/slim-scroll/jquery.slimscroll.min.js"></script>
        <script src="assets/plugins/c3/d3.v3.min.js" charset="utf-8"></script>       
        <script src="assets/plugins/c3/c3.min.js"></script>
        <script type="text/javascript" src="../../../../../../../www.gstatic.com/charts/loader.js"></script>
        <script src="assets/plugins/calendar/moment.min.js"></script>
        <script src="assets/plugins/calendar/fullcalendar.min.js"></script>
        <script src="assets/plugins/ui/jquery-ui.js"></script>


        <!-- PAGE LEVEL FILES -->
        <script src="assets/plugins/data-tables/jquery.dataTables.js"></script>
        <script src="assets/plugins/data-tables/dataTables.tableTools.js"></script>
        <script src="assets/plugins/data-tables/dataTables.bootstrap.js"></script>
        <script src="assets/plugins/data-tables/dataTables.responsive.js"></script>
        <script src="assets/plugins/data-tables/tables-data.js"></script>
        <!-- Custom FILES -->
        <script type="text/javascript" src="assets/js/custom.js"></script>

    </body>

</html>