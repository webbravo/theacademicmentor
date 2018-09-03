    <?php $page_title = "Edit Feeback page";?>
    <?php include_once("includes/head.php");?> 

    <?php  global $feedback;?>
    <?php 
        $id = $_GET["id"];
        if(checkid($id) == false) die("Execution failed");
        $feedbackInfo = $feedback->get_feedback_by_id($id);

        // Check the blog detail Into an array
         $feedbackInfo  = $feedbackInfo["feedback"];
    ?>
    <?php 
        if(isset($_POST['update_feedback']) == true){

            $update_feedback  =  $_POST['feedback'];

            $update_feedback = $feedback->update($id, $update_feedback ); 

            if($update_feedback == true){
                $alert =  '<div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                Feedback was updated!
                        </div>';
            }
            
        }
    ?>
    <?php 
        $id = $_GET["id"];
        if(checkid($id) == false) die("Execution failed");
        $feedbackInfo = $feedback->get_feedback_by_id($id);

        // Check the blog detail Into an array
        $feedbackInfo  = $feedbackInfo["feedback"];
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
                                                <li>Edit a post</li>
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
                                        
                                            

                                            <div class="hr-line-dashed"></div>

                                            <!-- Post story -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg" for="summernote1">Edit Feeback</label>
                                                <div class="col-sm-8">
                                                    <textarea id="summernote1" class="form-control" name="feedback" required=""><?php if(isset( $feedbackInfo)) echo  $feedbackInfo;?></textarea>
                                                    <br>
                                                </div> 
                                            </div>
                                            <!-- Post story --> 


                                            <div class="hr-line-dashed"></div>
                                             
                                            <div class="form-group">
                                                <div style="margin-left:30px;" class=" col-sm-6">
                                                    <button class="btn btn-success btn-md" type="submit" name="update_feedback">Update Feedback </button>
                                                </div>
                                            </div>
                                              
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--THE UPDATE POST FORM -->
                       


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