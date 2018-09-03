<?php require_once("../../core/initialize.php"); ?>
<?php
  global $database;
  $googleClient = new Google_Client;
  $auth = new GoogleAuth($database, $googleClient);
?>
<?php if($auth->isLoggedIn() === false) redirect_to('login.php');?>
<html lang="en">
    <?php include_once('includes/head.php');?>
    <body>
       <div class="container-fluid">
           <?php include_once("includes/nav.php");?>
           <!-- <div class="row">
                <div class="card-panel green darken-1">
                    <span class="white-text">
                       Lorem ipsum, dolor sit amet consectetur adipisicing elit. Culpa odio minima quae neque qui modi sequi dolore. Totam hic aut numquam. Vero veritatis quod aliquid nisi dolorum. Pariatur, deserunt saepe.
                    </span>
                </div>
           </div> -->
           <div class="row">  
               <div class="wrapper">
               <div class="question-box z-depth-3 card-panel">
               <p id="welcome_title" class="center grey-text">Welcome to TAM career test! <i class="fa fa-book"></i> </p>
               <!-- <p class="center grey-text">
                  Thanks for taking the career test, from the few information your provided, we found out 
                  that you have the following career personality;
               </p><hr> -->
               <div class="options col m12 s12">
                    <p class=" purple-text z-depth-1" id="career-option1" >
                      Take new Test
                    </p>
                    <p class="flow-text grey-text">Take a new career test, by clicking on the purple button below.</p>
                    <a href="new-test.php" class="btn waves-effect btn-large purple ">career test</a>      
                    <div style="height: 40px;"></div>
                    
                    <p class=" green-text z-depth-1" id="career-option1" >
                        Previous Result
                    </p>
                        <p class="flow-text grey-text">To check Previous career take result, click the green button below.</p>
                        <!-- <a class="btn waves-effect btn-large green ">click here</a> -->
                </div>
                <div class="footer">
                    <a href="previous-result.php" class="btn btn-large green white-text">Check result</a>
                </div></div> 
               </div>
           </div>
       </div>
    
       <script src="js/jquery-2.1.4.min.js"></script>
       <script src="js/materialize.js"></script>
       <script src="js/fieldOfStudy.js"></script>
       <script>
           $(document).ready(function(){
               $('.tabs').tabs();
            });
          
       </script>
    </body>
</html>