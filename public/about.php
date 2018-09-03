<?php require_once("../core/initialize.php");?>
<?php 
    global $about;

    $aboutInfo  =  $about->get_about_tam();

    // Check the blog detail Into an array
    $about_tam  =  $aboutInfo["about"];
?>
<!DOCTYPE html>
<html>
<head>
   <title>About - The Academic Mentor</title>    
   <?php include_once('includes/head.php');?>
</head>
<body>
    <div id="full-page" class="container-fluid" style="background-color:white;">
        <section class="row" id="overlay-black">
            <div class="about-top">
               <?php $aboutPage = "aboutPage";?>                                                
               <?php include_once('includes/nav-menu.php');?>
            </div>
        </section>
        <section class="row">
            <div class="content-wrapper">
                 <div id="about-content">
                     <?php if(isset( $about_tam)) echo  $about_tam;?>
                     <!-- <h2>About The Academic Mentor</h2>
                     <p>
                         Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                         Non qui veritatis exercitationem consequatur incidunt similique corporis libero, 
                         odio saepe voluptatum odit accusamus cumque deleniti dolorum quam voluptate esse. 
                         Architecto rem molestiae exercitationem alias autem fugiat eaque cumque voluptate magni natus assumenda incidunt, 
                         quam odio. Velit similique rem excepturi sit! 
                         Ipsum excepturi veniam soluta earum fugit eaque explicabo tempora nesciunt 
                         quia et tempore blanditiis inventore fuga velit, quod necessitatibus cumque,
                          porro corporis dolorem placeat illo dolor commodi praesentium? Qui illo et deserunt 
                          sapiente ea reiciendis vel. Sequi ducimus, amet minima, 
                          nisi corporis voluptatum voluptas sapiente enim iste quasi porro explicabo ipsam.
                     </p>
                     <p> -->
                 </div>
            </div>
        </section>
        <?php include_once("includes/footer.php")?>
    </div>
    
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script> 
    <script type="text/javascript" src="js/materialize.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
</body>
</html>