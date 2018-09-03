    <?php require '../../core/initialize.php'; ?>
    <?php date_default_timezone_set("Africa/Lagos");?>
    <?php // REMEMBER TO REDIRECT USER WHEN THEY ARE TO THE INDEX PAGE?>
    <?php 
       if(isset($_POST['login']) == true){
           global $session;

           $unique_id = $_POST['unique_id'];
           $password  = $_POST['password'];

           if(empty($unique_id) && empty($password)){
               $alert =  '<div class="alert alert-danger alert-dismissable">
                              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                              Email or Password is blank!  
                           </div>';
           }else{
             # The email and password is not empty
             $login_admin = $session->login_admin($unique_id, $password);
             if ($login_admin == true) {
                    # code...
                    
                 $alert =  '<div class="alert alert-success alert-dismissable">
                               <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                Hello Admin! you are Welcome 
                               <a class="alert-link" href="index.php"></a>.
                            </div>';
                    $redirect = "3;URL=index.php";                 
                } else{
                     $alert =  '<div class="alert alert-danger alert-dismissable">
                               <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                Invalid Password or Email! 
                               <a class="alert-link" href="index.php"></a>.
                            </div>';
                }

           }
       }
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>CleverMind - admin </title>
        <meta http-equiv="refresh" content="<?php if(isset($redirect)){ echo $redirect; }?>">
        <meta name="keywords" content="clever Mind - admin" />
        <meta name="description" content="" />
        <meta name="Author" content="clever Mind - admin" />

        <!-- mobile settings -->
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

        <!-- WEB FONTS : use %7C instead of | (pipe) -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />

        <!-- CORE CSS -->
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/theme/dark.css" rel="stylesheet" type="text/css" />

     
        <!-- PAGE LEVEL SCRIPTS -->

    </head>
    <body class="account">
        <div class="container">
                <div class="account-col text-center col-md-">
                    <?php if(isset($alert)){ echo $alert; }?>
                   
                    <h1 class="h1">TAM Admin</h1>
                    <h3>please Login </h3>
                    <form method="post" class="m-t"  role="form" action="<?php $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <input type="text" name="unique_id" class="form-control" autocomplete="off" placeholder="Email or Phone" 
                            value="<?php if(isset($unique_id)){ echo $unique_id; }?>" required="">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required="">
                        </div>
                        <button type="submit" name="login" class="btn btn-primary btn-block ">Login</button>
                        <?php // Do forget the ?>
                        <a href="forgotpassword.php"><small>Forgot password?</small></a>
                        <!-- <p class=" text-center"><small>Do not have an account?</small></p>
                        <a class="btn  btn-default btn-block" href="register.php">Create an account</a> -->
                        <p> theAcademicMentor.com &copy; <?php echo date("Y",  time()); ?></p>
                    </form>
                </div>
        </div>
        <script type="text/javascript" src="assets/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    </body>


</html>
