    <?php $page_title = "Add blog post";?>
    <?php include_once("includes/head.php");?> 
    <?php 
        if(isset($_POST['add_post']) == true){
          
            global $blog;
            global $database;

            $blogTitle       =  $_POST['blogTitle'];
            $blogPhoto       =  $_FILES['blogPhoto'];
            $blogStory       =  $_POST['blogStory'];

            // PERFORM DATA VALIDATION  
                $validate = $blog->validate($blogTitle, $blogStory);

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
                        #No error was returned so we call the add blog method
                        $add_blog = $blog->add($blogTitle, $blogPhoto, $blogStory );
                        break;
                }
             
                

            // echo $blogTitle." ".$blogPhoto["name"]." ".$blogStory;
            // exit;

            
            // CALL THE add_blog() CLASS 
             
               if($add_blog == true){
                  // If the Product Was added 
                   $alert =  '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                  Blog post created!
                                <a class="alert-link" href="blog.php"> See list </a>.
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
                                                <li>Add an Blog</li>
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
                                        <h2 class="h2 text-center">Create a post </h2>
                                        <?php if(isset($alert)) echo strtolower( $alert);?>
                                    </div>
                                    <div class="panel-body">
                                        <form method="POST" action="<?php $_SERVER["PHP_SELF"];?>" enctype="multipart/form-data" class="form-horizontal group-border stripped">
                                        
                                           <!-- Blog Name -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Blog Title</label>
                                                <div class="col-sm-8">
                                                  <input type="text" name="blogTitle" placeholder="A title for your post"
                                                   class="form-control" value="<?php if(isset( $blogTitle)) echo  $blogTitle;?>" required="">
                                                </div>
                                            </div>
                                            <!-- Blog Name -->  
                                            
                                            <div class="hr-line-dashed"></div>

                                            <!-- Blog Photo -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg" for="file-0a">
                                                Blog photo
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="file" name="blogPhoto" class="form-control" required="">
                                                    <br>
                                                </div> 
                                            </div>

                                            <!-- Blog Photo -->  

                                            <div class="hr-line-dashed"></div>

                                            <!-- Blog  story -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg" for="file-0a">
                                               Post story
                                                </label>
                                                <!-- <span>10,000 word Max</span> -->
                                                <div class="col-sm-8">
                                                    <textarea id="summernote1" class="form-control" name="blogStory" required=""><?php if(isset( $blogStory)) echo  $blogStory;?></textarea>
                                                    <br>
                                                </div> 
                                            </div>
                                            <!-- Blog story --> 


                                            <div class="hr-line-dashed"></div>
                                             
                                            <div class="form-group">
                                                <div style="margin-left:30px;" class="col-md-6 col-sm-offset-2">
                                                    <button class="btn btn-success btn-md" type="submit" name="add_post">
                                                        Add Blog
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