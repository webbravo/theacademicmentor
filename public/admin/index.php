    <?php $page_title = "Admin Hompage ";?>
    <?php include("includes/head.php");  ?>
    <?php 
        
       // global $Database;
          global $database;
       
       // global Award
        //   global $award;
        //   $total_award = $award->count_award();

      // global Blog
          global $blog;
          $total_blog = $blog->count_blog();  

      // global Event
        //   global $event;
        //   $total_event = $event->count_event(); 

   
    ?>
    <body class="fixed-top">

        <!-- wrapper -->
        <div id="wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="index.php">
                          <img src="assets/images/logo.png" alt="Clever Mind Schools" class="img-responsive logo-default"/>
                        </a>

                    </div><div class="menu-toggler sidebar-toggler">
                        <a href="javascript:;" class="navbar-minimalize minimalize-styl-2  pull-left "><i class="fa fa-bars"></i></a>
                    </div>

                    <div class="search-bar">
                        
                    </div>
                    <!-- END LOGO -->

                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->

            <!-- BEGIN CONTAINER -->
            <div class="page-container">

                <?php include("includes/navbar.php");?>

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
                                                <li><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                                <li>Dashboard</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end .page title-->

                        <!-- QUICK AREA -->
                           <?php include("includes/quickStat.php");?>
                         <!-- QUICK AREA -->

                        <div class="row">
                            <div class="col-md-12">


                               <!-- <div class="panel panel-card recent-activites">
                                     Start .panel
                                    <div class="panel-heading">
                                    List of registered Facilitator
                                        <div class="pull-right">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info btn-rounded btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action <span class="caret"></span></button>
                                               <ul class="dropdown-menu panel-dropdown" role="menu">
                                                    <li><a href="#">Action</a></li>
                                                    <li><a href="#">Another action</a></li>
                                                    <li><a href="#">Something else here</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="#">Separated link</a></li>
                                                </ul> 
                                            </div>
                                        </div>
                                    </div>
                                  
                                </div> End .panel --> 


                            </div>
                        </div>

                    </div> 
                    <div class="clearfix"></div>
                    <?php include("includes/footer.php");?>
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
         <?php include_once("includes/js_file.php");?>
        
    </body>
</html>