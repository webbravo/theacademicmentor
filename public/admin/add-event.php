    <?php $page_title = "Create an Event";?>
    <?php include_once("includes/head.php");?> 
    <?php 
        if(isset($_POST['create_event']) == true){
          
            global $event;
            global $database;

            $eventTitle        =  trim( $_POST['eventTitle']);
            $eventLink         =  trim( $_POST['eventLink']);
            $eventLocation     =  trim($_POST['eventLocation']);
            $eventPhoto        =  $_FILES['eventPhoto'];
            $eventStartDate    =  trim($_POST['eventStartDate']);
            $eventEndDate      =  trim($_POST['eventEndDate']);
            $eventStory        =  trim($_POST['eventStory']);

            //echo $eventStartDate." ".$eventEndDate; exit;
            // PERFORM DATA VALIDATION  
                $validate = $event->validate($id = 0, $eventTitle,  $eventLocation, $eventStartDate, $eventEndDate,  $eventStory);

                if(!empty($validate) && $validate !== ""){
                    $alert = $validate;
                }else{
                    $add_blog = $event->add($eventTitle, $eventLink , $eventLocation,  $eventPhoto,  $eventStartDate, $eventEndDate, $eventStory);
                        if($add_blog == true){
                          // If the Event Was added Created!
                           $alert =  '<div class="alert alert-success alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        One event created
                                        <a class="alert-link" href="events.php"> See list </a>.
                                     </div>';
                        }
                        
                }
            
            // CALL THE add_event() CLASS 
             
              
            
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
                                                <li>Add an event</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end .page title-->
                        

                        <!-- QUICK STAT AREA -->
                           <?php // include("includes/quickStat.php");?>
                        <!-- QUICK STAT AREA -->


                        <!--THE ADD PRODUCTS FORM -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="panel-heading">
                                        <h2 class="h2 text-center">Add an event </h2>
                                        <?php if(isset($alert)) echo strtolower( $alert);?>
                                    </div>
                                    <div class="panel-body">
                                        <form method="POST" action="<?php $_SERVER["PHP_SELF"];?>" enctype="multipart/form-data" class="form-horizontal group-border stripped">
                                        
                                           <!-- event Name eventLocation -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Event Name</label>
                                                <div class="col-sm-6">
                                                  <input type="text" name="eventTitle" placeholder="The name of your event "
                                                   class="form-control" value="<?php if(isset( $eventTitle)) echo  $eventTitle;?>" required="">
                                                </div>
                                            </div>
                                            <!-- event Name -->  
                                            <!-- event Link  -->  
                                               <div class="form-group">
                                                    <label class="col-sm-2 control-label input-lg">Meetup Link</label>
                                                    <div class="col-sm-6">
                                                    <input type="text" name="eventLink" placeholder="http:// "
                                                    class="form-control" value="<?php if(isset( $eventLink)) echo  $eventLink;?>" >
                                                    </div>
                                                </div>
                                            <!-- event Link -->  
                                             <!-- event eventLocation -->  
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Event Venue</label>
                                                <div class="col-sm-6">
                                                  <input type="text" name="eventLocation" placeholder="Name and address of event center"
                                                   class="form-control" value="<?php if(isset( $eventLocation)) echo  $eventLocation;?>" required="">
                                                </div>
                                            </div>
                                            <!-- event eventLocation -->  
                                            
                                            <div class="hr-line-dashed"></div>

                                            <!-- event Photo -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg" for="file-0a">
                                                Event photo
                                                </label>
                                                <div class="col-sm-6">
                                                    <input type="file" name="eventPhoto" class="form-control" required="">
                                                    <br>
                                                </div> 
                                            </div>
                                            <!-- Event Photo -->  

                                            <div class="hr-line-dashed"></div>

                                             <!-- event start date -->  
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg" for="file-0a">
                                                Start Date
                                                </label>
                                                <div class="col-sm-6">
                                                    <input type="datetime-local" name="eventStartDate" class="form-control" required="" 
                                                    value="<?php if(isset( $eventStartDate)) echo  $eventStartDate;?>">
                                                    <br>
                                                </div> 
                                            </div>
                                            <!-- event start date -->  
                                             <!-- event end date -->  
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg" for="file-0a">
                                                End Date
                                                </label>
                                                <div class="col-sm-6">
                                                    <input type="datetime-local" name="eventEndDate" class="form-control" required="" 
                                                    value="<?php if(isset( $eventEndDate)) echo  $eventEndDate;?>" >
                                                    <br>
                                                </div> 
                                            </div>
                                            <!-- event end date -->  

                                            <div class="hr-line-dashed"></div>

                                            <!-- Event Beirf story -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg" for="file-0a">
                                               Event details
                                                </label>
                                                <!-- <span>200 word Max</span> -->
                                                <div class="col-sm-6">
                                                    <textarea class="form-control" name="eventStory" required=""><?php if(isset( $eventStory)) echo  $eventStory;?></textarea>
                                                    <br>
                                                </div>
                                            </div>
                                            <!-- Event Brief story --> 


                                            <div class="hr-line-dashed"></div>
                                             
                                            <div class="form-group">
                                                <div style="margin-left:30px;" class="col-sm-6">
                                                    <button class="btn btn-success btn-md" type="submit" name="create_event">
                                                        Create event 
                                                    </button>
                                                </div>
                                            </div>
                                              
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--THE ADD Event FORM -->
                       


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