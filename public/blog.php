<?php require_once("../core/initialize.php");?>
<?php 
    global $blog , $database;

    // THE CURRENT PAGE NUMBER current_page()
        $current_page =  !empty($_GET['page']) ? (int)$_GET['page'] : 1; 

    // THE RECORD PER PAGE
        $per_page = 3;
    
    // TABLE NAME 
        $tbl = $blog->table_name; 
            
    // Get this total blog count
        $total_count = $blog->count_blog(); 

    // CALL THE PGINATION CLASS BECAUSE SO AS TO PAGINATE THE LIST OF Blog  .
        $pagination = new Pagination($current_page,  $per_page,  $total_count);

    //  Call the GET METHODS
        $select_blog = $blog->get_all($pagination); 

     //  GET THE RESULT 
        $result = $select_blog->fetchAll();

    // GET THE FEATURED BLOG POST
        $featured_post = $blog->getFeaturedPost(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog - The Academic Mentor</title>
    <?php include_once('includes/head.php');?>
</head>
<body>
    <div id="full-page" class="container-fluid" style="background-color:white;">
        <section class="row" id="overlay-black">
            <div class="about-top">
               <?php $blogPage = "blog";?>                                
               <?php include_once('includes/nav-menu.php');?>
            </div>
        </section>
        <section id="blog-feed">
            <div class="content-wrapper">
                <div class="row featured">
                   <div class="col l6 m12 s12 featured-img">
                   <a href="blog-post.php?id=<?php echo $featured_post['id'] ?>">
                       <img data-src="<?php echo $featured_post['blogPhoto']; ?>" class="z-depth-1 responsive-img ft-ct-img hoverable" alt="">
                   </a>                            
                   </div>
                   <div class="col l6 m12 s12 info">
                       <h2><a href="blog-post.php?id=<?php echo $featured_post['id'] ?>"><?php echo $featured_post['blogTitle']; ?></a></h2> 
                       <!-- <h2>Headline Tag</h2> -->
                       <p class="author">Author name, May 12 2018</p>
                       <p class="info-text"><?php echo  substr( strip_tags( $featured_post['blogStory']), 0, 500); ?></p>
                        <a href="blog-post.php?id=<?php echo $featured_post['id'] ?>" class="tam-blue-button">READ MORE</a>
                   </div>
                </div>
                <div class="row content-body">
                    <?php foreach($result as $row):?>
                    <div class="col s12 m12 l4 blog-post left-align">
                        <a href="blog-post.php?id=<?php echo $row['id']; ?>">
                            <img data-src="<?php echo $row['blogPhoto']; ?>" class="z-depth-1 responsive-img  ft-ct-img hoverable" alt="">
                        </a>
                        <div class="post-info">
                            <h3><a href="blog-post.php?id=<?php echo $row['id']; ?>"><?php echo $row['blogTitle']; ?></a></h3>
                            <p class="info-text"><?php echo  substr( strip_tags( $row['blogStory']), 0, 250); ?></p> 
                        </div>
                    </div>
                    <?php endforeach ;?>
                    
                </div>
                <ul class="pagination center" style="margin: 30px 0px 30px;">
                        <?php  
                            if($pagination->total_pages() > 1){ 
                                    // Previous Button  
                                if($pagination->has_previous_page()){
                                    echo "<li><a href='blog.php?page=".$pagination->previous_page()."'><i class=\"material-icons\">chevron_left</i> </a></li>";
                                }

                                    // Page Numbers
                                for ($i=1; $i <= $pagination->total_pages() ; $i++) { 
                                    
                                    if($i == $current_page){
                                        echo "<li class='active'><a ><b>".$i."</b></a></li>";
                                    }else{
                                        echo "<li class=\"waves-effect\"><a href='blog.php?page=".$i." '>".$i."</a></li>";
                                    }

                                }

                                    // Next Button  
                                if($pagination->has_next_page()){
                                    echo "<li><a href='blog.php?page=".$pagination->next_page()."'><i class=\"material-icons\">chevron_right</i></a></li>";
                                }
                            }    

                        ?>   
                </ul>
            </div>
        </section>
        <?php include_once('includes/footer.php');?>
    </div>
    
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script> 
    <script type="text/javascript" src="js/materialize.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
</body>
</html>