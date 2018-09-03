    <?php $page_title = "Add an awrd";?>
    <?php include_once("includes/head.php");?> 
    <?php 
        if(isset($_POST['add_award']) == true){
          
            global $award;
            global $database;

            $awardTitle       =  $_POST['awardTitle'];
            $awardPhoto       =  $_FILES['awardPhoto'];
            $awardStory       =  $_POST['awardStory'];

            // PERFORM DATA VALIDATION  
            $validate = $award->validate($awardTitle, $awardStory);

            switch ($validate) {
                case 'titleTooLong':
                    # code...
                    $alert =  '<div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                Title too long (200 max char)
                                </div>';
                    break;
                case 'titleTooShort':
                    # code... 
                    $alert =  '<div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                Title too short (10 min char)
                                </div>';
                    break;
                case 'storyTooShort':
                    # code... 
                    $alert =  '<div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                The story is quite short (20 min char)
                                </div>';
                    break;    
                default:
                    #No error was returned so we call the add award method
                    $add_award = $award->add($awardTitle, $awardPhoto, $awardStory );
                    break;
            }
             
                

        // echo $awardTitle." ".$awardPhoto["name"]." ".$awardStory;
        // exit;

        
        // CALL THE add_award() CLASS 
            
            if($add_award == true){
                // If the Product Was added 
                $alert =  '<div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                One award added!
                            <a class="alert-link" href="award.php"> See list </a>.
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
                                                <li>Add an Award</li>
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
                                        <h2 class="h2 text-center">Add an award </h2>
                                        <?php if(isset($alert)) echo strtolower( $alert);?>
                                    </div>
                                    <div class="panel-body">
                                        <form method="POST" action="<?php $_SERVER["PHP_SELF"];?>" enctype="multipart/form-data" class="form-horizontal group-border stripped">
                                        
                                           <!-- Award Name -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Award Title</label>
                                                <div class="col-sm-8">
                                                  <input type="text" name="awardTitle" placeholder="Award title  "
                                                   class="form-control" value="<?php if(isset( $awardTitle)) echo  $awardTitle;?>" required="">
                                                </div>
                                            </div>
                                            <!-- Award Name -->  
                                            
                                            <div class="hr-line-dashed"></div>

                                            <!-- Award Photo -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg" for="file-0a">
                                                Award photo
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="file" name="awardPhoto" class="form-control" required="">
                                                    <br>
                                                </div> 
                                            </div>

                                            <!-- Award Photo -->  

                                            <div class="hr-line-dashed"></div>

                                            <!-- Award Beirf story -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg" for="file-0a">
                                               Brief story
                                                </label>
                                                <span>200 word Max</span>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control" name="awardStory" required=""><?php if(isset( $awardStory)) echo  $awardStory;?></textarea>
                                                    <br>
                                                </div> 
                                            </div>
                                            <!-- Award Brief story --> 


                                            <div class="hr-line-dashed"></div>
                                             
                                            <div class="form-group">
                                                <div style="margin-left:30px;" class=" col-sm-6">
                                                    <button class="btn btn-success btn-md" type="submit" name="add_award">
                                                        Add Award
                                                    </button>
                                                </div>
                                            </div>
                                              
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--THE ADD AWARD FORM -->
                       


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