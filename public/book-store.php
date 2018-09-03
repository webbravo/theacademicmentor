<?php require_once("../core/initialize.php");?>
<?php 

       global $product;

    // THE CURRENT PAGE NUMBER current_page()
        $current_page =  !empty($_GET['page']) ? (int)$_GET['page'] : 1; 

    // THE RECORD PER PAGE
        $per_page = 9;
            
    // Get this total Product count
        $total_count = $product->count_product_by_type($type = 'book'); 

    // CALL THE PGINATION CLASS BECAUSE SO AS TO PAGINATE THE LIST OF PRODUCT  .
        $pagination = new Pagination($current_page,  $per_page,  $total_count);

    //  Call the GET METHODS
        $select_product = $product->get_product_by_type($type = 'book', $pagination); 

        $result = $select_product->fetchAll();   

        
?>
<!DOCTYPE html>
<html>
<head>
   <title>Book store - The Academic Mentor</title>    
   <?php include_once('includes/head.php');?>
</head>
<body>
    <div id="full-page" class="container-fluid" style="background-color:white;">
        <section class="row" id="overlay-black">
            <div class="book-top">
               <?php $bookStorePage = "bookStorePage";?>                                                
               <?php include_once('includes/nav-menu.php');?>
            </div>
        </section>
        <div class="center content-title">
            <h2>Book Store</h2>
            <h3 class="flow-text">
                Get the latest book from TAM's Collection
            </h3>
        </div>      
        
        <section id="book-feed">
        
            <div class="content-wrapper">
                <div class="row content-body" style="padding-left:10px">
                    <?php if(isset($result)):?>
                        <?php foreach($result as $row):?>
                            <div class="col s12 m12 l4 store-item z-depth-1">
                                <div class="">
                                    <a class="modal-trigger" href="#modal_<?php echo $row["id"];?>">
                                        <img data-src="<?php echo $row['photo']; ?>" class="responsive-img hoverable" alt="">
                                    </a>
                                    <div class="book-info">
                                        <h2><a class="modal-trigger" href="#modal_<?php echo $row["id"];?>"><?php echo $row['name']; ?></a></h2>
                                        <p class="book-author"><?php echo $row['brand']; ?></p>
                                        <p class="book-price"><?php echo "N". number_format($row['price'], 0); ?></p>
                                        <div>
                                            <a href="#!" title="Add to cart">
                                            <div id="<?php echo $row['id'];?>" class="col s6 add-cart-btn z-depth-1">
                                                Get it <i class=" fa fa-shopping-basket right"></i>
                                                </div>
                                            </a>
                                            <div id="gifpy_<?php echo $row['id'];?>" style="display:none" class="col s4" >
                                                <img width="30" data-src="images/addCart.gif" alt="">
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                            </div>

                            <!-- Modal Structure -->
                            <div id="modal_<?php echo $row["id"];?>" class="modal modal-fixed-footer">
                                <div class="modal-content">
                                    <div class="col m6">
                                        <img data-src="<?php echo $row['photo']; ?>" class="responsive-img z-depth-1" alt="">
                                    </div>
                                    <div class="col m6">
                                        <h5><?php echo $row['name']; ?></h5>
                                        <p>Product ID: <?php echo $row['id']; ?></p>
                                        <p class="book-price"><?php echo "N".number_format( $row['price']); ?></p>
                                        <h5>Description</h5>
                                        <p><?php echo $row['description']; ?></p>
                                    
                                    <label> <h5>Quantity</h5></label>
                                        <select id="item_qty_<?php echo $row["id"];?>" class="browser-default">
                                            <option value="" disabled selected>Choose your option</option>
                                            <option value="1"> 1</option>
                                            <option value="2"> 2</option>
                                            <option value="3"> 3</option>
                                            <option value="4"> 4</option>
                                            <option value="5"> 5</option>
                                        </select>
                                    </div>
                                    <div id="<?php echo $row['id'];?>" class="right col m6 cart-btn">
                                        <button class=" add_cart_btn1 btn waves-effect large">ADD TO CART <i class="large material-icons">shopping_cart</i></button>
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
                                </div>
                            </div>
                            <!-- Modal Structure -->
                        <?php endforeach;?> 
                    <?php endif;?> 
                    <?php if(empty($result)):?>
                        
                        <div class="center" style="margin:100px 0px;">
                            <hr>
                            <h2>Sorry, No book found!</h2>
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
        
        <div class="fixed-action-btn horizontal click-to-toggle">
            <div><p class="flow-text teal-text" style="margin-bottom: 0px; font-weight: bold;">0</p></div>
            <a target="_new" href="cart.php" class="btn-floating btn-large pulse">
                <i class="large material-icons">shopping_cart</i>  
            </a>
        </div>
        <?php include_once("includes/footer.php")?>
    </div>
    
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script> 
    <script type="text/javascript" src="js/materialize.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <script type="text/javascript" src="js/cartAction.js"></script>
</body>
</html>