<?php require_once("../core/initialize.php");?>
<?php 
    global $feedback , $database;

    // THE CURRENT PAGE NUMBER current_page()
        $current_page =  !empty($_GET['page']) ? (int)$_GET['page'] : 1; 

    // THE RECORD PER PAGE
        $per_page = 3;
    
    // TABLE NAME 
        $tbl = $feedback->table_name; 
            
    // Get this total feedback count
        $total_count = $feedback->count_feedback(); 

    // CALL THE PGINATION CLASS BECAUSE SO AS TO PAGINATE THE LIST OF feedback  .
        $pagination = new Pagination($current_page,  $per_page,  $total_count);

    //  Call the GET METHODS
        $select_feedback = $feedback->get_all($pagination); 

    //  GET THE RESULT 
        $result = $select_feedback->fetchAll();
        //echo "<pre>".print_r($result)."</pre>"; exit;

?>
<!DOCTYPE html>
<html>
<head>
    <title>Testimonials - The Academic Mentor</title>
    <?php include_once('includes/head.php');?>
</head>
<body>
    <div id="full-page" class="container-fluid" style="background-color:white;">   
        <section class="row" id="overlay-black">
            <div class="about-top">
                <?php $testimonialsPage = "testimonialsPage";?>                                
                <?php include_once('includes/nav-menu.php');?>
            </div>
        </section>
        <section id="testimonials-feed">
            <div class="post-wrapper">
                <?php foreach($result as $row):?>
                    <div class="row center">
                        <h2><i class="fa fa-quote-left"></i>&nbsp;<i class="fa fa-quote-right"></i></h2>
                         <?php echo $row["feedback"]?>
                    </div>
                <?php endforeach ;?>
            </div>
            <ul class="pagination center" style="margin: 30px 0px 30px;">
                <?php  
                    if($pagination->total_pages() > 1){ 
                            // Previous Button  
                        if($pagination->has_previous_page()){
                            echo "<li><a href='testimonials.php?page=".$pagination->previous_page()."'><i class=\"material-icons\">chevron_left</i> </a></li>";
                        }

                            // Page Numbers
                        for ($i=1; $i <= $pagination->total_pages() ; $i++) { 
                            
                            if($i == $current_page){
                                echo "<li class='active'><a ><b>".$i."</b></a></li>";
                            }else{
                                echo "<li class=\"waves-effect\"><a href='testimonials.php?page=".$i." '>".$i."</a></li>";
                            }

                        }

                            // Next Button  
                        if($pagination->has_next_page()){
                            echo "<li><a href='testimonials.php?page=".$pagination->next_page()."'><i class=\"material-icons\">chevron_right</i></a></li>";
                        }
                    }    

                ?>   
            </ul>
        </section>
    <?php include_once('includes/footer.php');?>
    </div>
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script> 
    <script type="text/javascript" src="js/materialize.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
</body>
</html>