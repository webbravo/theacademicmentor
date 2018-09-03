<?php $page_title = "Create an Event";?>
<?php include_once("includes/head.php");?> 
<?php $aboutPage = $pages->getAboutPage(); ?>
 <!-- RETRIEVE ABOUT PAGE -->
    <?php  
                            
        # code...
        $aboutTitle     = $aboutPage['about_us_title'];
        $aboutContent   = $aboutPage['about_us_content'];

        $storyTitle     = $aboutPage['our_story_title'];
        $storyContent   = $aboutPage['our_story_content'];

        $missionTitle   = $aboutPage['our_mission_title'];
        $missionContent = $aboutPage['our_mission_content'];

        $visionTitle    = $aboutPage['our_vision_title'];
        $visionContent  = $aboutPage['our_vision_content']; 
        
    ?>
<!-- RETRIEVE ABOUT PAGE -->

    <?php 
        if(isset($_POST['update_about_page']) == true){
          
            global $pages;
            global $database;

            $aboutTitle     = $database->prep_value($_POST['aboutTitle']);
            $aboutContent   = $database->prep_value($_POST['aboutContent']);

            $storyTitle     = $database->prep_value($_POST['storyTitle']);
            $storyContent   = $database->prep_value($_POST['storyContent']);

            $missionTitle   = $database->prep_value($_POST['missionTitle']);
            $missionContent = $database->prep_value($_POST['missionContent']);

            $visionTitle    = $database->prep_value($_POST['visionTitle']);
            $visionContent  = $database->prep_value($_POST['visionContent']);

              
            $update = $pages->updateAboutPage($aboutTitle, $aboutContent, $storyTitle, $storyContent, $missionTitle, $missionContent, $visionTitle, $visionContent);
            if($update == true){
                // If the Event Was added Created!
                $alert =  '<div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            About page was updated!
                            <a class="alert-link" target="_new" href="../about-us.php"> See page </a>.
                            </div>';
                    
                        // AFTER THE TABLE WAS UPDATED FETCH AGAIN THE NEW RECORD FROM THE DATABASE    
                        $aboutPage = $pages->getAboutPage();

                        # code...
                        $aboutTitle     = $aboutPage['about_us_title'];
                        $aboutContent   = $aboutPage['about_us_content'];

                        $storyTitle     = $aboutPage['our_story_title'];
                        $storyContent   = $aboutPage['our_story_content'];

                        $missionTitle   = $aboutPage['our_mission_title'];
                        $missionContent = $aboutPage['our_mission_content'];

                        $visionTitle    = $aboutPage['our_vision_title'];
                        $visionContent  = $aboutPage['our_vision_content']; 
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
                                                <li>Update about page</li>
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
                                        <h2 class="h2 text-center">Update about page  </h2>
                                        <?php if(isset($alert)) echo strtolower( $alert);?>
                                    </div>
                                    <div class="panel-body">
                                        <form method="POST" action="<?php $_SERVER["PHP_SELF"];?>" enctype="multipart/form-data" class="form-horizontal group-border stripped">
                                        
                                            <!-- aboutTitle-->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">About-Us Title</label>
                                                <div class="col-sm-6">
                                                  <input type="text" name="aboutTitle" placeholder="The title for the about us "
                                                   class="form-control" value="<?php if(isset( $aboutTitle)) echo  $aboutTitle;?>" required="">
                                                </div>
                                            </div>
                                            <!-- aboutTitle -->  
                                             <!-- aboutContent -->  
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">About Content</label>
                                                <div class="col-sm-6">
                                                    <textarea class="form-control" name="aboutContent" required=""><?php if(isset( $aboutContent)) echo  $aboutContent;?></textarea>
                                                    <br>
                                                </div>
                                            </div>
                                            <!-- aboutContent -->  
                                            
                                            <div class="hr-line-dashed"></div>

                                            <!-- storyTitle-->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Story Title</label>
                                                <div class="col-sm-6">
                                                  <input type="text" name="storyTitle" placeholder="Our story title" class="form-control" value="<?php if(isset( $storyTitle)) echo  $storyTitle;?>" required="">
                                                </div>
                                            </div>
                                            <!-- storyTitle -->  
                                            <!-- storyContent -->  
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Story Content</label>
                                                <div class="col-sm-6">
                                                    <textarea class="form-control" name="storyContent" required=""><?php if(isset( $storyContent)) echo  $storyContent;?></textarea>
                                                    <br>
                                                </div>
                                            </div>
                                            <!-- storyContent -->  
                                            
                                            <div class="hr-line-dashed"></div>

                                            <!-- missionTitle-->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Mission Title</label>
                                                <div class="col-sm-6">
                                                  <input type="text" name="missionTitle" placeholder="Our Mission title" class="form-control" value="<?php if(isset( $missionTitle)) echo  $missionTitle;?>" required="">
                                                </div>
                                            </div>
                                            <!-- missionTitle -->  
                                            <!-- missionContent -->  
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Mission Content</label>
                                                <div class="col-sm-6">
                                                    <textarea class="form-control" name="missionContent" required=""><?php if(isset( $missionContent)) echo  $missionContent;?></textarea>
                                                    <br>
                                                </div>
                                            </div>
                                            <!-- missionContent --> 

                                            <div class="hr-line-dashed"></div>

                                           <!-- visionTitle-->  
                                           <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Vision Title</label>
                                                <div class="col-sm-6">
                                                  <input type="text" name="visionTitle" placeholder="Our Vision title" class="form-control" value="<?php if(isset( $visionTitle)) echo  $visionTitle;?>" required="">
                                                </div>
                                            </div>
                                            <!-- visionTitle -->  
                                            <!-- visionContent -->  
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Vision Content</label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control" name="visionContent" required=""><?php if(isset( $visionContent)) echo  $visionContent;?></textarea>
                                                    <br>
                                                </div>
                                            </div>
                                            <!-- visionContent -->  


                                            <div class="hr-line-dashed"></div>
                                             
                                            <div class="form-group">
                                                <div style="margin-left:30px;" class="col-sm-6">
                                                    <button class="btn btn-success btn-lg" type="submit" name="update_about_page">
                                                       Update Page 
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