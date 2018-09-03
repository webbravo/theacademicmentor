     <?php $page_title = "Booking Request";?>
     <?php include_once("includes/head.php");?> 
     <?php 
        
         global $booking , $database;

        // THE ID OF THE BOOKING
           $id =  !empty($_GET['id']) ? (int)$_GET["id"] : 1;
           $type = $_GET["type"];

        // CHECK IF THE BOOKING ID IS NUMERIC
           if(checkid($id) == false) die("Execution failed");    
        
        // TABLE NAME 
            $tbl = $booking->table_name; 

            $select_booking = $booking->get_booking_by_id($id, $type);
         
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

                                        <h3 class="pull-left">See all Post</h3>


                                        <ol class="breadcrumb pull-right">
                                            <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                                            <li>See new booking</li>
                                        </ol>

                                    </div>
                                </div>
                            </div>
                        </div><!-- end .page title-->

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="well">
                                </div>
                                <form  method="post" enctype="multipart/form-data" id="form-product" class="">
                                    <div style="overflow-x:auto;">
                                    <a href="<?php echo $_SERVER["HTTP_REFERER"];?>"><h3>&larr; back</h3></a>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr><td class="text-left" colspan="2"><h1>Booking details</h1></td></tr>
                                            </thead>
                                            <tbody>
                                               <tr><td class="text-center" colspan="2"><h3>PERSONAL INFO</h3></td></tr>
                                                <tr>
                                                    <td class="text-left"><h4>Full name</h4></td>
                                                    <td class="text-left"><?php echo $select_booking['fullname']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left"><h4>Email address</h4></td>
                                                    <td class="text-left"><?php echo $select_booking['email']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left"><h4>Phone number</h4></td>
                                                    <td class="text-left"><?php echo $select_booking['phone']; ?></td>
                                                </tr>

                                                <tr><td class="text-center" colspan="2"><h3>COMPANY INFO</h3></td></tr>
                                                <tr>
                                                    <td class="text-left"><h4>Company name</h4></td>
                                                    <td class="text-left"><?php echo $select_booking['company_name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left"><h4>Company Category</h4></td>
                                                    <td class="text-left"><?php echo $select_booking['organization_type']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left"><h4>Company address</h4></td>
                                                    <td class="text-left"><?php echo $select_booking['company_address']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left"><h4>State located</h4></td>
                                                    <td class="text-left"><?php echo $select_booking['company_state']; ?></td>
                                                </tr>

                                                <tr><td class="text-center" colspan="2"><h3>EVENT INFO 1</h3></td></tr>
                                                <tr>
                                                    <td class="text-left"><h4>Event name</h4></td>
                                                    <td class="text-left"><?php echo $select_booking['event_name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left"><h4>Purpose of event</h4></td>
                                                    <td class="text-left"><?php echo $select_booking['event_purpose']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left"><h4>Date of event</h4></td>
                                                    <td class="text-left"><?php echo $select_booking['event_date']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left"><h4>Time of event</h4></td>
                                                    <td class="text-left"><?php echo $select_booking['event_time']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left"><h4>Event Projected Budget</h4></td>
                                                    <td class="text-left"><?php echo $select_booking['projected_budget']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left"><h4>TAM Presentation topic</h4></td>
                                                    <td class="text-left"><?php echo $select_booking['presentation_topic']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left"><h4>Event center</h4></td>
                                                    <td class="text-left"><?php echo $select_booking['event_center']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left"><h4>Event center location</h4></td>
                                                    <td class="text-left"><?php echo $select_booking['event_location']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left"><h4>Numbers of expected attendees</h4></td>
                                                    <td class="text-left"><?php echo $select_booking['attendees_number']." Persons"; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left"><h4>Expected attendees Demography</h4></td>
                                                    <td class="text-left"><?php echo $select_booking['attendees_demograph']; ?></td>
                                                </tr>
                                                <tr><td class="text-center" colspan="2"><h3>EVENT INFO 2</h3></td></tr>
                                                <tr>
                                                    <td class="text-left"><h4>Is it an Open Event ?</h4></td>
                                                    <td class="text-left"><b><?php echo strtoupper($select_booking['open_event']) ; ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left"><h4>Will ticket be sold?</h4></td>
                                                    <td class="text-left"><b><?php echo strtoupper($select_booking['event_has_ticket']) ; ?></b></td>                                                    
                                                </tr>
                                                <tr>
                                                    <td class="text-left"><h4>Record or Live stream Event?</h4></td>
                                                    <td class="text-left"><b><?php echo strtoupper($select_booking['record_event']) ; ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left"><h4>Will Product be sold at Event?</h4></td>
                                                    <td class="text-left"><b><?php echo strtoupper($select_booking['product_sales']) ; ?></b></td>                                                    
                                                </tr> 
                                            </tbody>
                                           
                                        </table>

                                        <div class="dataTables_paginate paging_bootstrap" id="basic-datatables_paginate">
                                            
                                         </div>
                                        </div>
                                </form>

                            </div> 
                        </div>


                        <div class="row">
                            <div class="col-sm-6 text-left"></div>
                            <div class="col-sm-6 text-right">
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