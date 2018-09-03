<?php require_once("../core/initialize.php");?>
<?php 

       global $product, $cart;

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
   <title>Shopping Cart - The Academic Mentor</title>    
   <?php include_once('includes/head.php');?>
</head>
<body>
    <div id="full-page" class="container-fluid" style="background-color:white;">
        <section class="row" id="overlay-black">
            <div class="about-top">
               <?php $bookStorePage = "bookStorePage";?>                                                
               <?php include_once('includes/nav-menu.php');?>
            </div>
        </section>

        <div id="cart_title" class="center content-title">
            <h2> Shopping Cart </h2>
            <h3 class="flow-text">
                See all item on your shopping cart.
            </h3>
        </div> 

        <section id="book-feed">
            <div class="content-wrapper">
                <div class="content-body" style="padding-left:10px">
                    <div class="row">
                       <div class="col s12 m12 l9 cart">
                          <h2 class="grey white-text cart-header">Your cart (<?php echo $cart->total_items(); ?>)</h2>  
                            <?php if($cart->total_items() > 0): ?>
                               <?php $cartItems = $cart->contents();?>
                               <?php foreach($cartItems as $item){  ?>
                                     <?php $product_info = $product->get_product_by_id($item["id"]);?>
                                    <div id="item_<?php echo $item["id"]?>" class="col m12 cart-item">
                                            <div class="col m3 item-img">
                                                <img data-src="<?php echo $product_info["photo"]?>" class="responsive-img" alt="">                              
                                            </div>
                                            <div class="item-details col m6">
                                                <h5><?php echo $item["name"]; ?></h5>
                                                <p>Product ID: <?php echo $item["id"]; ?></p>
                                                <p class="book-price"><?php echo 'N'.number_format($item["price"]); ?></p>
                                                <p><b>Description:</b> <?php echo substr($product_info["description"], 0, 200)."...."; ?></p>                                    
                                                <p><b id="item_quatity_<?php echo $item["rowid"];?>"> Qty: <?php echo $item["qty"]; ?><b></p>
                                            </div>

                                            <div id="<?php echo $item['rowid'] ?>" class="col m12">
                                                <button href="#modal_<?php echo $item["id"];?>" style="margin-right: 20px;" class="modal-trigger col s12 m3 btn waves-effect white grey-text large">EDIT</button>
                                                <button id="<?php echo $item['id'] ?>" class="delete_item col s12 m3 btn waves-effect red lighten-2">REMOVE</button>
                                                <!-- <button id="<?php //echo $item['id'] ?>"  onclick="deleteItem('<?php //echo $item['id'] ?>', '<?php // echo $item['rowid'] ?>');" class="delete_item col s12 m3 btn waves-effect red lighten-2">REMOVE</button> -->
                                            </div>
                                    </div>
                                    <!-- Modal Structure -->
                                        <div id="modal_<?php echo $item["id"];?>" class="modal modal-fixed-footer">
                                            <div class="modal-content">
                                                <div class="col m6">
                                                    <img data-src="<?php echo $product_info["photo"]?>" class="responsive-img z-depth-1" alt="">
                                                </div>
                                                <div class="col m6">

                                                    <h5><?php echo $item['name']; ?></h5>

                                                    <p>Product ID: <?php echo $item['id']; ?></p>
                                                    <p class="book-price">Product price: <?php echo "N".number_format( $item['price']); ?></p>

                                                    <label> <h5>Quantity</h5></label>
                                                    <select id="item_qty_<?php echo $item['rowid']; ?>" class="browser-default">
                                                        <option value="" disabled selected>Choose your option</option>
                                                        <option value="1"> 1</option>
                                                        <option value="2"> 2</option>
                                                        <option value="3"> 3</option>
                                                        <option value="4"> 4</option>
                                                        <option value="5"> 5</option>
                                                    </select>
                                                </div>
                                                <div id="<?php echo $item['rowid'];?>" class="right col m6 cart-btn">
                                                    <button class="updateBtn btn waves-effect large">Update Item  <i class="material-icons">update</i></button>
                                                </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
                                            </div>
                                        </div>
                                    <!-- Modal Structure -->
                               <?php }?> 
                            <?php endif;?>
                            <?php if($cart->total_items() === 0):?>
                        
                                <div class="center" style="margin:100px 0px;">
                                    <hr>
                                    <h2>Sorry, No item in cart!</h2>
                                    <a href="book-store.php" style="margin-top:50px;" class="btn btn-large white-text">
                                        <i class="fa fa-angle-double-left"></i> Go to store
                                    </a>
                                </div>    
                            <?php endif;?>              
                       </div>
                       <div class="col s12 m12 l3">
                            <h2 class="teal white-text summary-header">Summary</h2>
                             <h5>Subtotal: <span class="green-text" id="subtotal"></span> </h5>
                               <div class="divider"></div>
                             <h5>Shipping: <span class="green-text" id="shipping"></span>  </h5>
                               <div class="divider"></div>
                             <h5>VAT: <span class="green-text" id="vat"></span> </h5>
                               <div class="divider"></div>
                             <h3>Total: <span class="green-text" id="total"></span></h3>
                             <a href="checkout.php#cart_title" style="margin-top:20px;" class="btn green btn-md white-text">
                                To Checkout <i class="fa fa-credit-card"></i> 
                            </a>
                       </div>
                       
                    </div>

                </div>
            </div>
        </section>
        
        <!-- <div class="fixed-action-btn horizontal click-to-toggle">
            <div><p class="flow-text teal-text" style="margin-bottom: 0px; font-weight: bold;">2</p></div>
            <a href="check-out.html" class="btn-floating btn-large pulse">
                <i class="large material-icons">shopping_cart</i>  
            </a>
        </div> -->
        <?php include_once("includes/footer.php")?>
    </div>
    
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script> 
    <script type="text/javascript" src="js/materialize.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <script type="text/javascript" src="js/cartAction.js"></script>
</body>
</html>