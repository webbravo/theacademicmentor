<?php require_once("../core/initialize.php");?>
<?php 
    global $video , $database;

    // THE CURRENT PAGE NUMBER current_page()
        $current_page =  !empty($_GET['page']) ? (int)$_GET['page'] : 1; 

    // THE RECORD PER PAGE
        $per_page = 3;
    
    // TABLE NAME 
        $tbl = $video->table_name; 
            
    // Get this total Video count
        $total_count = $video->count_video(); 

    // CALL THE PGINATION CLASS BECAUSE SO AS TO PAGINATE THE LIST OF Video  .
        $pagination = new Pagination($current_page,  $per_page,  $total_count);

    //  Call the GET METHODS
        $select_video = $video->get_all($pagination); 

     //  GET THE RESULT 
        $result = $select_video->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Video - The Academic Mentor</title>
    <?php include_once('includes/head.php');?>
</head>
<body>
    <div id="full-page" class="container-fluid" style="background-color:white;">   
        <section class="row" id="overlay-black">
            <div class="about-top">
                <?php $videoPage = "video";?>                
                <?php include_once('includes/nav-menu.php');?>
            </div>
        </section>
        <section id="blog-feed">
            <div class="row post-wrapper">
                
                <?php if (!empty($result)) {?>
                    <?php foreach($result as $row):?>
                        <div class="video-container">
                            <?php echo $row["videoURL"];?>
                        </div>
                        <h3><?php echo $row["videoTitle"];?></h3>                        
                        <p><?php echo $row["videoCaption"];?></p>
                    <?php endforeach ;?>
                <?php } else{
                    echo '<div class="center" style="margin:100px 0px;">';
                    echo "<h2>Sorry, No video found!</h2>";
                    echo '<a href="index.php" style="margin-top:50px;" class="btn btn-large white-text"><i class="fa fa-angle-double-left"></i> Go back home</a>';
                    echo '</div>';                
                }?>    
            </div>
        </section>
    <?php include_once('includes/footer.php');?>
    </div>
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script> 
    <script type="text/javascript" src="js/materialize.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
</body>
</html>