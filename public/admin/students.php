     <?php $page_title = "Student List";?>
     <?php include_once("includes/head.php");?> 
     <?php 
        
         global $student , $database;

        // THE CURRENT PAGE NUMBER current_page()
            $current_page =  !empty($_GET['page']) ? (int)$_GET['page'] : 1; 

        // THE RECORD PER PAGE
            $per_page = 5;
        
        // TABLE NAME 
            $tbl = $student->table_name; 
                
        // Get this total student count
            $total_count = $student->count_student(); 

        // CALL THE PGINATION CLASS BECAUSE SO AS TO PAGINATE THE LIST OF student  .
            $pagination = new Pagination($current_page,  $per_page,  $total_count);

        //  Call the GET METHODS
            $select_student = $student->getStudent($pagination); 

         
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
                                        <!-- <h3 class="pull-left">Career test</h3> -->
                                        <ol class="breadcrumb pull-right">
                                            <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                                            <li>See career test</li>
                                        </ol>

                                    </div>
                                </div>
                            </div>
                        </div><!-- end .page title-->

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="well">
                                    <h3 class="">Career test result</h3><br>
                                    <form  method="post" enctype="multipart/form-data" id="form-product" class="">
                                        <div style="overflow-x:auto;">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td class="text-left"><h4>Full Name</h4></td>
                                                        <td class="text-left"><h4>Email</h4></td>
                                                        <td class="text-left"><h4>Career Interest</h4></td>
                                                        <td class="text-left"><h4>First Option</h4></td>
                                                        <td class="text-left"><h4>Second Option</h4></td>
                                                        <td class="text-center"><h4>Action</h4></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php while ($rows = $select_student->fetch()) :  ?>
                                                    <tr>
                                                        <td class="text-left"><?php echo $rows['name']; ?></td>
                                                        <td class="text-left"><?php echo $rows['email']; ?></td>
                                                        <td class="text-left"><?php echo $rows['careerInterest']; ?></td>
                                                        <td class="text-left"><?php echo $rows['firstOption']; ?></td>
                                                        <td class="text-left"><?php echo $rows['secondOption']; ?></td>
                                                        
                                                        <td class="text-center">
                                                        <a  title="" class="btn btn-primary" data-original-title="View" data-toggle="modal" data-target="#myModal<?php echo $rows["id"]; ?>">
                                                          <i class="fa fa-eye"></i>
                                                        </a>
                                                
                                                        <a title="Delete Student" href="delete.php?tbl=<?php echo $tbl;?>&fid=<?php echo (int)$rows['id']; ?>"  class="btn btn-danger" data-original-title="View">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                        </td>
                                                    </tr>
                                                    <!-- INCLUDE THE MODELS TO THE WHILE LOOP -->
                                                    <?php  //include("includes/student.modal.php");?>
                                                    <?php endwhile; ?>  

                                                    
                                                </tbody>
                                            </table>

                                            <div class="dataTables_paginate paging_bootstrap" id="basic-datatables_paginate">
                                                
                                                <ul class="pagination">
                                                    <?php 
                                                    if($pagination->total_pages() > 1){
                                                        
                                                        // Previous Button  
                                                        if($pagination->has_previous_page()){
                                                            echo "<li class='prev'><a href='student.php?page=".$pagination->previous_page()."'>← Previous </a></li>";
                                                        }
                                                        
                                                            // Page Numbers
                                                        for ($i=1; $i <= $pagination->total_pages() ; $i++) { 

                                                            if($i == $current_page){
                                                                    echo "<li class='active'><a ><b>".$i."</b></a></li>";
                                                            }else{
                                                                    echo "<li><a href='student.php?page=".$i." '>".$i."</a></li>";
                                                            }

                                                        }

                                                            // Next Button  
                                                        if($pagination->has_next_page()){
                                                            echo "<li class='next'><a href='student.php?page=".$pagination->next_page()."'>Next → </a></li>";
                                                        }
                                                        
                                                    }
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