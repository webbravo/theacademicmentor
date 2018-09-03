    <?php $page_title = "Edit an event";?>
    <?php include_once("includes/head.php");?> 


    <?php  

      // Import Class files
        global $event;
        global $database;
       
        $id = $_GET["id"];
        if(checkid($id) == false) die("Execution failed");
       
        // Check the event detail Into an array 
           $eventInfo      = $event->get_event_by_id($id);

           $eventPhoto     = $eventInfo["eventPhoto"];
           $eventTitle     = $eventInfo["eventTitle"]; 
           $eventLink     = $eventInfo["eventLink"]; 
           $eventLocation  = $eventInfo["eventLocation"]; 
           $eventStory     = $eventInfo["eventStory"]; 
           
           $eventStartDate   = $event->covert_datetime_locale($eventInfo["startDate"]);
           $eventEndDate     = $event->covert_datetime_locale($eventInfo["endDate"]);
          
        //    echo $eventStartDate." ".$eventEndDate."<br/>";
        //    echo $eventInfo["startDate"]." ".$eventInfo["endDate"]."<br/>";
        //    exit;
          
           
    ?>


    <?php 
        if(isset($_POST['update_event']) == true){
           
            $eventPhoto2        =  $_FILES['eventPhoto'];
            $eventTitle2        =  $_POST['eventTitle'];
            $eventLink2         =  $_POST["eventLink"];             
            $eventLocation2     =  $_POST['eventLocation'];
            $eventStartDate2    =  $_POST['eventStartDate'];
            $eventEndDate2      =  $_POST['eventEndDate'];
            $eventStory2        =  $_POST['eventStory'];
            
            // PERFORM DATA VALIDATION  $id, $eventTitle2,  $eventStartDate, $eventEndDate,  $eventS
            $validate = $event->validate($id, $eventTitle2, $eventLocation2, $eventStartDate2, $eventEndDate2,  $eventStory2);
            
            if(!empty($validate) && $validate !== ""){
                $alert = $validate;
            }else{
                $update_event = $event->update($id, $eventTitle2, $eventLink2, $eventLocation2,  $eventPhoto2, $eventStartDate2, $eventEndDate2, $eventStory2 );
                    if($update_event == true){
                        // If the Event Was added Created!
                        $alert =  '<div class="alert alert-success alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    Event update was successful!
                                    <a class="alert-link" href="events.php"> See list </a>.
                                    </div>';
                    }
                    
            }

            
        }
    ?>

    <?php  

        $eventInfo      = $event->get_event_by_id($id);

        $eventPhoto     = $eventInfo["eventPhoto"];
        $eventTitle     = $eventInfo["eventTitle"]; 
        $eventLink      = $eventInfo["eventLink"];         
        $eventLocation  = $eventInfo["eventLocation"]; 
        $eventStory     = $eventInfo["eventStory"]; 
        
        $eventStartDate   = $event->covert_datetime_locale($eventInfo["startDate"]);
        $eventEndDate     = $event->covert_datetime_locale($eventInfo["endDate"]);
        
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
                                                <li>edit event details</li>
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
                                        <h2 class="h2 text-center">Edit </h2>
                                        <?php if(isset($alert)) echo strtolower( $alert);?>
                                    </div>
                                    <div class="panel-body">
                                        <form method="POST" action="<?php $_SERVER["PHP_SELF"];?>" enctype="multipart/form-data" class="form-horizontal group-border stripped">
                                        
                                           <!-- event Name -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Event Title</label>
                                                <div class="col-sm-8">
                                                  <input type="text" name="eventTitle" placeholder="event title  "
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
                                                    <input type="file" name="eventPhoto" class="form-control">
                                                    <br>
                                                </div> 
                                                <div class="col-sm-2">
                                                    <img  class="img-responsive" src="../<?php echo $eventPhoto?>"  alt="event photo">
                                                </div> 
                                            </div>
                                            <!-- event Photo --> 

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

                                            <!-- event Beirf story -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg" for="file-0a">
                                                Event details
                                                </label>
                                                <!-- <span>200 word Max</span> -->
                                                <div class="col-sm-8">
                                                    <textarea class="form-control" name="eventStory" required=""><?php if(isset( $eventStory)) echo  $eventStory;?></textarea>
                                                    <br>
                                                </div> 
                                            </div>
                                            <!-- event Brief story --> 


                                            <div class="hr-line-dashed"></div>
                                             
                                            <div class="form-group">
                                                <div style="margin-left:30px;" class=" col-sm-6">
                                                    <button class="btn btn-success btn-md" type="submit" name="update_event">
                                                        Update event
                                                    </button>
                                                </div>
                                            </div>
                                              
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--THE ADD event FORM -->
                       


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