<?php require_once("../../core/initialize.php"); ?>
<?php
   global $database;
   global $student;
   $googleClient = new Google_Client;
   $auth = new GoogleAuth($database, $googleClient);

   // Verify  the for the User is properly logged in 
   if($auth->isLoggedIn() === false) redirect_to('login.php');
?>

<?php 
  // GET THE USER PREVIOUS CAREER TEST RESUT
      global $student;
      $careerInterest = $student->getCareerInterest($_SESSION['name'], $_SESSION['email']);
?>

<?php 

  // The Career result from the database
     //$careerInterest =  "Social,Artistic";

  // Create an array from the result set
     if(isset($careerInterest) && $careerInterest !=  "") $careerInterest = (explode("," , $careerInterest));

    function getCareerInterestMessage ($ci) {
        switch ($ci) {
        case 'Conventional': 
        return 'A person who like to work with data, have clerical or numerical ability, carry out tasks in  detail, or follow through on others’ instruction';
        case 'Social': 
        return 'A person who like to work with people to enlighten, inform, help, train, or cure them, or are skilled with words.';
        case 'Realistic': 
        return 'A person who have athletic ability, prefer to work with objects, machines, tools, plants or animals, or to be outdoors.';
        case 'Investigative': 
        return 'You are a person who can to observe, learn, investigate, analyze, evaluate, or solve problems. ';
        case 'Artistic': 
        return 'You are artistic, innovating, or intuitional abilities and like to work in unstructured situations using their imagination and creativity';
        case 'Enterprising': 
        return 'You like to work with people, influencing, persuading, leading or managing for organizational goals or economic gain. ';
        default : return null;
        }
    }
?>

<html>
    <?php include_once('includes/head.php');?>
    <body>
       <div class="container-fluid">
           <?php include_once("includes/nav.php");?>

           <div class="row">  
               <div class="wrapper">
                    <div class="question-box z-depth-3 card-panel">
                        <?php 
                            if (!empty($careerInterest)) {
                                echo '<p class="center green-text " style="font-size:2.68rem; font-weight: bold">Congratulation <i class="fa fa-check"></i> </p>
                                        <p class="center grey-text">
                                            Thanks for taking the career test, from the few information your provided, we found out 
                                            that you have the following career personality;
                                        </p><hr>
                                <div class="options col m12 s12">
                                    <p class="green white-text z-depth-1" id="career-option1" style="font-size:2.2rem; padding: 0px 10px; margin-bottom: 0px">
                                        '.$careerInterest[0].'
                                    </p>
                                    <p class="grey-text" id="career-option-txt1">
                                        '.getCareerInterestMessage($careerInterest[0]).'
                                    </p>
                                    <div style="height: 20px;"></div>
                                    <p class="purple white-text z-depth-3" id="career-option1" style="font-size:2.2rem; padding: 0px 10px; margin-bottom: 0px">
                                        '.$careerInterest[1].'
                                    </p>
                                    <p class="grey-text" id="career-option-txt1">
                                        '.getCareerInterestMessage($careerInterest[1]).'
                                    </p>
                                </div>
                                <div class="footer">
                                    <a href="index.php" class="btn btn-large green white-text">Goto homepage<i class="fa fa-left right"></i></a>
                                </div>';
                            } else {
                                # code...
                                echo '<p class="center red-text " style="font-size:2.68rem; font-weight: bold"> No Result Found <i class="fa fa-check"></i> </p>
                                            <p class="center grey-text">
                                            We could not get find your previous career test result, for one of two reason, it is likely you have not done the career test or Data cache is full, click the green button to continue.
                                            </p><hr>
                                        <div class="options col m12 s12">
                                        
                                        </div>
                                        <div class="footer center">
                                            <a href="index.html" class="btn btn-small green white-text">Goto homepage<i class="fa fa-left right"></i></a>
                                        </div>';
                            }
                            
                        ?>
                    </div> 
               </div>
           </div>
       </div>
    
       <script src="js/jquery-2.1.4.min.js"></script>
       <script src="js/materialize.js"></script>
       <!-- <script src="js/result.js"></script> -->
       <script>
           $(document).ready(function(){
               $('.tabs').tabs();
            });
          
       </script>
    
    </body>
</html>