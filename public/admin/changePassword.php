    <?php $page_title = "Change Password";?>
    <?php include_once("includes/head.php");?> 
    <?php 
        if(isset($_POST['changePassword']) == true){
          
            global $admin;

            $oldPass          =  $_POST['oldPassword'];
            $newPass          =  $_POST['newPassword'];
            $conPass          =  $_POST['conPassword'];
           
             // echo $oldPass." ".$newPass." ".$conPass; exit;

            // PERFORM DATA VALIDATION  
                $validate = $admin->validate($oldPass, $newPass, $conPass);

                switch ($validate) {
                    case 'empty':
                        # code...
                        $alert =  '<div class="alert alert-danger alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    Fill out all Fields
                                  </div>';
                        break;
                    case 'tooShort':
                        # code... 
                        $alert =  '<div class="alert alert-danger alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    Password too short (6 min char)
                                  </div>';
                        break;
                    case 'misMatch':
                        # code... 
                        $alert =  '<div class="alert alert-danger alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    Confirm Password mismatch!
                                  </div>';
                        break;    
                    default:
                        #No error was returned so we call the add event method
                        $changePass = $admin->changePassword($newPass, $oldPass);
                       
                         if($changePass == true){
                                // If the Product Was added 
                                $alert =  '<div class="alert alert-success alert-dismissable">
                                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                The password Change was successsful!
                                            </div>';
                            }else if($changePass == false){
                                $alert =  '<div class="alert alert-danger alert-dismissable">
                                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                The old Password is Incorrect!
                                            </div>';
                            }
                            
                            
                            break;
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
                                                <li>change Password</li>
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
                                        <h2 class="h2 text-center">Change Password </h2>
                                        <?php if(isset($alert)) echo strtolower( $alert);?>
                                    </div>
                                    <div class="panel-body">
                                        <form method="POST" action="<?php $_SERVER["PHP_SELF"];?>" class="form-horizontal group-border stripped">
                                        
                                           <!-- Old Password -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg">Old Password</label>
                                                <div class="col-sm-6">
                                                  <input autocomplete ="off" type="text" name="oldPassword" placeholder="Enter old Password"
                                                   class="form-control" value="<?php if(isset( $oldPass)) echo  $oldPass;?>" required="">
                                                </div>
                                            </div>
                                            <!-- Old Password--> 

                                            <div class="hr-line-dashed"></div>

                                            <!--  new Password -->  
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg" for="file-0a">
                                                New password
                                                </label>
                                                <div class="col-sm-6">
                                                    <input autocomplete ="off" type="password" name="newPassword"  value="<?php if(isset( $newPass)) echo  $newPass;?>"
                                                     class="form-control" required="" placeholder="Enter New Password">
                                                    <br>
                                                </div> 
                                            </div>
                                            <!--  new Password -->  

                                            
                                             <!-- event date -->  
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label input-lg" for="file-0a">
                                               Confirm password
                                                </label>
                                                <div class="col-sm-6">
                                                    <input autocomplete ="off" type="password" name="conPassword"  class="form-control" required="" placeholder="confirm new Password">
                                                    <br>
                                                </div> 
                                            </div>
                                            <!-- event date -->  

                                            <div class="hr-line-dashed"></div>
                                             
                                            <div class="form-group">
                                                <div style="margin-left:30px;" class="col-sm-6">
                                                    <button class="btn btn-success btn-md" type="submit" name="changePassword">
                                                        Change Password
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