<?php require_once("../../core/initialize.php"); ?>
<?php
  global $database;
  $googleClient = new Google_Client;
  $auth = new GoogleAuth($database, $googleClient);
  if ($auth->checkRedirectCode() === true){
       redirect_to('index.php');
  }else{
       $url  =  $auth->getAuthUrl();
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>The Academic mentor - Career Test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/materialize.css"  media="screen,projection"/>
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css" />  
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />       -->
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="icon" href="../images/logo/favicon.png">    
</head>
<body>
   <div class="container-fluid">
       <div class="row z-depth-3 title">
           <p class="center content-wrapper">THE ACADEMIC MENTOR CAREER TEST</p>
       </div>
       <div class="row">
           <div class="wrapper">
                <div>
                    <div class="login-form z-depth-1" action="hint.html" method="get">    
                        <div class="col s12 m12 center">
                            <a href="../index.php"><img class="img-responsive" src="images/ct-logo.png" alt=""></a>
                        </div>
                        <p class="center flow-text grey-text">Welcome signup to continue</p>
                        <p class="center"><a href="<?php echo $url; ?>" class="btn btn-large green darken-2 z-depth-3"> <i class="fa fa-google left"></i>login with Google</a></p>
                        <p class="center"><a class="btn btn-large blue darken-4  z-depth-3"> <i class="fa fa-facebook left"></i>login with Facebook</a></p>
                    </div>
               </div>
           </div>
       </div>

   </div>
   <script src="js/jquery-2.1.4.min.js"></script>
   <script src="js/materialize.js"></script>
   <!-- <script src="js/main.js"></script> -->
</body>
</html>