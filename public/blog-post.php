<?php require_once("../core/initialize.php");?>
<?php 
    global $blog;

    $id = $_GET["id"];
    if(checkid($id) === false) die("Execution failed");

    //  Call the GET METHODS
        $select_post = $blog->get_blog_by_id($id);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog Post - The Academic Mentor</title>
    <?php include_once('includes/head.php');?>
</head>
<body>
    <div id="full-page" class="container-fluid" style="background-color:white;">   
        <section class="row" id="overlay-black">
            <div class="about-top">
                <?php $blogPage = "index";?>                
                <?php include_once('includes/nav-menu.php');?>
            </div>
        </section>
        <section id="blog-feed">
            <div class="row post-wrapper">
                <div class="col s12" style="margin-bottom:20px;">
                    <!-- <a href="blog.php<?php //echo $_SERVER['HTTP_REFERRER'];?>" class="btn-floating btn-large"><i class="fa fa-angle-double-left"></i></a> -->
                    <a href="<?php echo $_SERVER["HTTP_REFERER"];?>">&larr; back</a>
                </div>
            <?php if (isset($select_post['blogTitle'])) {?>
                <h2><?php echo $select_post['blogTitle']; ?></h2>
                <img src="<?php echo $select_post['blogPhoto']; ?>">
                <?php echo $select_post['blogStory']; ?>
                <a href="blog.php">&larr; back</a>
            <?php } else{
                echo '<div class="center" style="margin:100px 0px;">';
                echo "<h2>Sorry, No post found!</h2>";
                echo '<a href="blog.php" style="margin-top:50px;" class="btn btn-large white-text"><i class="fa fa-angle-double-left"></i> Go back</a>';
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