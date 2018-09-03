<?php require_once("../../core/initialize.php"); ?>
<?php
  global $database;
  $googleClient = new Google_Client;
  $auth = new GoogleAuth($database, $googleClient);
?>
<?php if($auth->isLoggedIn() === false) redirect_to('login.php');?>
<?php
  global $student;
  $carInt = $student->getCareerInterestFromSession();

  $firstOption  =  trim($carInt[0]);
  $secondOption =  trim($carInt[1]);
  //echo  $carInt[1]; exit;
  
?>
<!DOCTYPE html>
<html lang="en">
    <?php include_once('includes/head.php');?>
    <body>
       <div class="container-fluid">
           <?php include_once("includes/nav.php");?>   
              
           <div class="row">  
               <div class="wrapper">
               <div class="question-box z-depth-3 card-panel">
                    <p class="center green-text" style="font-size:2.68rem; font-weight: bold">
                      Career Path <i class="fa fa-user-md" aria-hidden="true"></i> 
                      </p>
              
               <p class="center grey-text">
                 The list below contains matching career possibilities from your known Career type, 
                 now pick a career possibility from the list that you are interested in (<strong>What you would like to study in School</strong>).
                 <br>
                 
                 <b>NOTE: Pick selection from both sections</b>
               </p>
               
               <hr>

               <div class="options col m12 s12">
                    <form id action="#">
                        <?php if(isset($firstOption) && !empty($firstOption)):?>
                            <p class="green white-text z-depth-1" id="career-option1" style="font-size:2.2rem; padding: 0px 10px; margin-bottom: 0px">
                                <!-- SHOW THE NAME OF THE CAREER POSSIBILITIES -->
                                <?php echo $firstOption;?>
                            </p>

                            <?php
                                // GET THE LIST OF CAREER POSSIBILITIES (returns an array)
                                 $mylist = $student->getListOfCareerPossibilities($firstOption);
                                 foreach ($mylist as $list):
                            ?>
                                <p>
                                    <input id="<?php echo trim($list) ?>" value="<?php echo trim($list) ?>" class="firstOption" type="checkbox"  />
                                    <label for="<?php echo trim($list) ?>"><?php echo trim($list) ?></label>
                                </p>
                            <?php endforeach;?> 
                        <?php endif;?>    

                        <div style="height: 20px;"></div>
                        
                        <?php if(isset($secondOption) && !empty($secondOption)):?>
                            <p class="purple white-text z-depth-3" id="career-option1" style="font-size:2.2rem; padding: 0px 10px; margin-bottom: 0px">
                                <!-- SHOW THE NAME OF THE CAREER POSSIBILITIES -->                               
                                <?php echo $secondOption;?>
                            </p>
                            <?php
                                // GET THE LIST OF CAREER POSSIBILITIES (returns an array)
                                $mylist = $student->getListOfCareerPossibilities($secondOption);
                                foreach ($mylist as $list):
                            ?>
                                <p>
                                    <input id="<?php echo trim($list) ?>" value="<?php echo trim($list) ?>" class="secondOption"  type="checkbox"  />
                                    <label for="<?php echo trim($list) ?>"><?php echo trim($list) ?></label>
                                </p>
                            <?php endforeach;?>    
                        
                        <?php endif;?> 
                    </form>                   
                </div>

                <div class="footer">
                    <a id="save_selection" class="btn btn-large green white-text">Save seletions<i class="fa fa-left right"></i></a>
                    <img id="preloader" style="display:none;"  width="30" src="../images/addCart.gif" alt="">                    
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