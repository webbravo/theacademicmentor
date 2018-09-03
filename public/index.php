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
        // $featured_post = $blog->getFeaturedPost(); 
        // print_r($result); exit;
?>
<!DOCTYPE html>
<html>
<head>
    <title>The Academic Mentor - Official</title>
    <?php include_once('includes/head.php');?>
</head>
<body>
    <div id="full-page" class="container-fluid" style="background-color:white;">
       <div class="homescreen-bg-img">
            <section id="overlay-black" class="row">
                <?php $indexPage = "index";?>
                <?php include_once('includes/nav-menu.php');?>
                <div style="height:340px" class="content-homescreen">
                    <div class="content-wrapper">
                        <div class="content-homescreen-text">
                            <h1>Zion Oshiobugie, HND </h1>
                            <h2 class="white-text">Raising a new generation of problem solver</h2>
                        </div>
                        <div class="col s12 m6 l3 z-depth-5 button tam-white-button ">
                            <a href="careertest/" title="Take career test">Take career test</a>
                        </div>                
                        <div class="col s12 m6 l3 z-depth-5 button tam-filled-button ">
                            <a href="events.php" title="Event registration">Event registration</a>
                        </div>  
                    </div>
                </div>
            </section> 
       </div>
       <section class="row featured-content">
           <div class="content-wrapper">
               <div class="center content-title">
                   <h2>what's new</h2>
                   <h3 class="flow-text">
                        Meet TAM. Videos &amp; Podcasts. Upcoming Events. Shop.
                   </h3>
               </div>
               <div class="content-body">
                    <div class="col s12 m6 l4">
                        <a href="about.html">
                            <img data-src="images/featured/meet-tam.jpg" class="z-depth-4 responsive-img ft-ct-img hoverable" alt="">
                        </a>
                    </div>
                    <div class="col s12 m6 l4">
                        <a target="_blank" href="http://127.0.0.1/clevermindschools/">
                            <img data-src="images/featured/school.jpg" class="z-depth-4 responsive-img ft-ct-img hoverable" alt="">
                        </a>
                    </div>
                    <div class="col s12 m6 l4">
                        <a href="grind-gear.php">
                            <img data-src="images/featured/grind.jpg" class="z-depth-4 responsive-img ft-ct-img hoverable" alt="">                            
                        </a>
                    </div>
                    <div class="col s12 m6 l4">
                        <a href="events.php">
                            <img data-src="images/featured/events.jpg" class="z-depth-4 responsive-img ft-ct-img hoverable" alt="">
                            <!-- <h4>what's up dude?</h4> -->
                        </a>
                    </div>
                    <div class="col s12 m6 l4">
                        <a href="book-store.php">
                            <img data-src="images/featured/book-store.jpg" class="z-depth-4 responsive-img ft-ct-img hoverable" alt="">
                            <!-- <h4>what's up dude?</h4> -->
                        </a>
                    </div>
                    <div class="col s12 m6 l4">
                        <a href="video.php">
                            <img data-src="images/featured/video.jpg" class="z-depth-4 responsive-img ft-ct-img hoverable" alt="">
                            <!-- <h4>what's up dude?</h4> -->
                        </a>
                    </div>
               </div>
           </div>
       </section>
       <section class="row">
            <div class="center review-bg-img">
                <div id="overlay-white" class="review">
                    <div class="review-content">
                        <h2>My addmission struggle ended, when I met TAM &trade;</h2>
                        <div class="clearfix buttons">
                            <div class="hoverable tam-blue-button" style="background-color: rgba(248, 242, 242, 0.473);">
                                <a href="testimonials.php" title="More Reviews">More Reviews</a>
                            </div>
                        </div>
                    </div> 
                </div>
                                   
            </div>
       </section>
       <section class="">
           <div class="content-wrapper">
                <div class="row center content-title">
                    <h2>From Our Blog</h2>
                    <h3 class="flow-text">
                        Get more inspiration and idea from our blog!.
                    </h3>
                </div>
                <div class="row content-body">
                    <?php foreach($result as $row):?>
                    <div class="col s12 m12 l4 blog-post">
                       <a href="blog-post.php?id=<?php echo $row['id']; ?>#blog-feed">
                            <img data-src="<?php echo $row['blogPhoto']; ?>" class="z-depth-1 responsive-img ft-ct-img hoverable" alt="">
                        </a>
                        <div class="post-info">
                            <h3><a href="blog-post.php?id=<?php echo $row['id']; ?>#blog-feed"><?php echo $row['blogTitle']; ?></a></h3>
                            <p><?php echo  substr( strip_tags( $row['blogStory']), 0, 250); ?></p> 
                        </div>
                    </div>
                    <?php endforeach ; ?>
                    <!-- <div class="col s12 m12 l4 blog-post">
                        <a href="">
                            <img data-src="images/one.jpg" class="z-depth-1 responsive-img ft-ct-img hoverable" alt="">
                        </a>
                        <div class="post-info">
                            <h3><a href="">Lorem, ipsum dolor.</a></h3>
                            <p class="post-author">By TAM</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, ad?</p> 
                        </div>
                    </div>
                    <div class="col s12 m12 l4 blog-post">
                        <a href="">
                            <img data-src="images/one.jpg" class="z-depth-1 responsive-img ft-ct-img hoverable" alt="">
                        </a>
                        <div class="post-info">
                            <h3><a href="">Lorem, ipsum dolor.</a></h3>
                            <p class="post-author">By TAM</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, ad?</p> 
                        </div>
                    </div> -->
                </div>
                <div class="more">
                    <a href="blog.php" title="Load More" onclick="load_more(2,event);"> Load More </a>
                </div>
           </div>
       </section>
       <?php include_once('includes/footer.php');?>
    </div>
    
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script> 
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script async type="text/javascript" src="js/custom.js"></script>
    
</body>
</html>