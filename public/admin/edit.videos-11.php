    <?php $page_title = "Edit a video";?>
    <?php include_once("includes/head.php");?> 
    <?php global $blog, $database; ?>
    <?php 
        $id = $_GET["id"];
        if(checkid($id) == false) die("Execution failed");
        $blogInfo = $blog->get_blog_by_id($id);

        // Check the blog detail Into an array
        $blogTitle  = $blogInfo["blogTitle"];
        $blogStory  = $blogInfo["blogStory"];
        $blogPhoto  = $blogInfo["blogPhoto"];
    ?>
    <?php 
        if(isset($_POST['update_post']) == true){

            $blogTitle2       =  $_POST['blogTitle'];
            $blogPhoto2       =  $_FILES['blogPhoto'];
            $blogStory2       =  $_POST['blogStory'];
            
    

            // PERFORM DATA VALIDATION  
                $validate = $blog->validate($blogTitle2 ,  $blogStory2);

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
                    case 'photoUploadError':
                        # code... 
                        $alert =  '<div class="alert alert-danger alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                     Photograph upload failed!
                                  </div>';
                        break;        
                    default:
                        #No error was returned so we call the add blog method
                        $update_blog = $blog->update($id, $blogTitle2, $blogPhoto2, $blogStory2 );
                        break;
                }
             
                

              # CALL THE update() CLASS 
               if($update_blog == true){
                  // If the Product Was added 
                   $alert =  '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                  Post was updated!
                                <a class="alert-link" href="blog.php"> See list </a>.
                            </div>';
                   // $redirect = "3;";        
               }
            
        }
    ?>
    <?php 
        $id = $_GET["id"];
        if(checkid($id) == false) die("Execution failed");
        $blogInfo = $blog->get_blog_by_id($id);

        // Check the blog detail Into an array
        $blogTitle  = $blogInfo["blogTitle"];
        $blogStory  = $blogInfo["blogStory"];
        $blogPhoto  = $blogInfo["blogPhoto"];
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
                                        
                                           <!-- Post Name -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Post Title</label>
                                                <div class="col-sm-8">
                                                  <input type="text" name="blogTitle" placeholder="Post title" style="color:#000;"
                                                   class="form-control" value="<?php if(isset( $blogTitle)) echo  $blogTitle;?>" required="">
                                                </div>
                                            </div>
                                            <!-- Post Name -->  
                                            
                                            <div class="hr-line-dashed"></div>

                                            <!-- Post Photo -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg" for="file-0a"> Post photo</label>
                                                <div class="col-sm-6">
                                                    <input type="file" name="blogPhoto" class="form-control"><br>
                                                </div> 
                                                <div class="col-sm-2">
                                                    <img  class="img-responsive" src="../<?php echo $blogPhoto?>"  alt="blog photo">
                                                </div> 
                                            </div>

                                            <!-- Post Photo -->  

                                            <div class="hr-line-dashed"></div>

                                            <!-- Post story -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg" for="summernote1">Blog story</label>
                                                <div class="col-sm-8">
                                                    <textarea id="summernote1" class="form-control" name="blogStory" required=""><?php if(isset( $blogStory)) echo  htmlspecialchars_decode($blogStory);?></textarea>
                                                    <br>
                                                </div> 
                                            </div>
                                            <!-- Post story --> 


                                            <div class="hr-line-dashed"></div>
                                             
                                            <div class="form-group">
                                                <div style="margin-left:30px;" class=" col-sm-6">
                                                    <button class="btn btn-success btn-md" type="submit" name="update_post">
                                                        Update post
                                                    </button>
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