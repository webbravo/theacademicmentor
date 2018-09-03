<?php require_once("../core/initialize.php");?>
<?php 
        
    global $event;

    // THE CURRENT PAGE NUMBER current_page()
        $current_page =  !empty($_GET['page']) ? (int)$_GET['page'] : 1; 

    // THE RECORD PER PAGE
        $per_page = 3;
    
    // TABLE NAME 
        $tbl = $event->table_name; 
            
    // Get this total event count
        $total_count = $event->count_event(); 

    // CALL THE PGINATION CLASS BECAUSE SO AS TO PAGINATE THE LIST OF event  .
        $pagination = new Pagination($current_page,  $per_page,  $total_count);

    //  Call the GET METHODS
        $select_event = $event->get_all($pagination); 

        //echo $total_count." ". $event->error_msg; exit;         
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Events - The Academic Mentor</title>
    <?php include_once('includes/head.php');?>
</head>
<body>
    <div id="full-page" class="container-fluid" style="background-color:white;">
        <section class="row" id="overlay-black">
            <div class="about-top">
               <?php $eventsPage = "eventsPage";?>                                                                
               <?php include_once('includes/nav-menu.php');?>
            </div>
        </section>
        <section id="events-feed">
        <div class="post-wrapper">
           <?php if(!empty($eventRow)):?>
                <?php while($eventRow = $select_event->fetch()){?>
                    <div class="row center">
                        <h1><?php echo $eventRow['eventTitle']; ?></h1>
                        <img id="event_img" src="<?php echo $eventRow['eventPhoto']; ?>" alt="">
                        <?php 
                            $startTime =  strftime($eventRow['startDate']);
                            $endTime   =  strftime($eventRow['endDate']);
                            // $evDate    =  date("M d Y h:i a", $startTime)." - ".date("M d Y h:i a", $endTime); 
                            $evDate    =  date("M d Y ", $startTime)." - ".date("M d Y", $endTime); 
                        ?>      
                        <h3><i class="fa fa-calendar"></i><?php echo $evDate; ?></h3>
                        <h5><i class="fa fa-map-marker"></i><?php echo $eventRow["eventLocation"]; ?></h5> 
                        <p><?php echo $eventRow["eventStory"]; ?></p>
                        <a class="btn btn-large waves-effect" target="_new" href="<?php echo $eventRow["eventLink"]; ?>">Attend Event</a> 
                       
                    </div>
                    <hr/>
                <?php }?>
            <?php endif;?>
            <?php if(empty($eventRow)):?>
                <div class="center" style="margin:100px 0px;">
                    <hr>
                    <h2>No upcoming events currently</h2>
                    <a href="index.php" style="margin-top:50px;" class="btn btn-large white-text">
                        <i class="fa fa-angle-double-left"></i> Go back home
                    </a>
                </div>    
            <?php endif;?>     
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