<!DOCTYPE html>
<!-- hhendf -->
<html>
<head>
   <?php include_once('includes/head.php');?>
</head>
<body>
   <div class="container-fluid">
       <?php include_once("includes/nav.php");?>
       <div class="row">  
           <div class="wrapper">
               
               <div class="question-box z-depth-3 card-panel">
                    <h2 id="career_int" class="center grey-text">Career Interest Checklist</h2>
                    <p  class="center grey-text">Check mark any of the activites that might be enjoyable or
                        interesting to you.  In general, making more activites provides more useful results.
                    </p>
                   <div class="header"><h4></h4></div>
                   <div class="options">
                        <ul class="collection with-header">
                            <!-- <li class="collection-item"><div>Alvin<a class="secondary-content"><i class="material-icons">check</i></a></div></li>
                            <li class="collection-item grey lighten-3"><div>Alvin<a href="#!" class="secondary-content"><i class="material-icons">check</i></a></div></li>
                            <li class="collection-item"><div>Alvin<a class="secondary-content"><i class="material-icons"></i></a></div></li>
                            <li class="collection-item grey lighten-3"><div>Alvin<a href="#!" class="secondary-content"><i class="material-icons">check</i></a></div></li> -->
                        </ul>
                   </div>
                   <div class="footer">
                       <a href="" class="grey lighten-4 black-text btn"><i class="material-icons left">refresh</i>Restart</a>
                       <a id="nextBtn" class="green right btn"> <i class="material-icons right">arrow_forward</i> Next</a>
                   </div>
                   <h5><a href="index.php">&larr; back</a></h5>
                   
                   <!-- <div class="hide-on-med-and-up footer">
                        <a href="" class="grey lighten-4 black-text btn"><i class="material-icons ">refresh</i>Restart</a>
                        <buttton id="nextBtn" class=" green btn"> <i class="material-icons ">arrow_forward</i> Next</buttton>
                    </div> -->
               </div> 
           </div>
       </div>
   </div>

   <script src="js/jquery-2.1.4.min.js"></script>
   <script src="js/materialize.js"></script>
   <script src="js/fieldOfStudy.js"></script>   
   <script src="js/main.js"></script>
   <script>
       $(document).ready(function(){
           $('.tabs').tabs();
        });
      
   </script>
</body>
</html>