<?php require_once("../core/initialize.php");?>
<?php  global $product, $cart; ?>
<?php 
  if (empty($cart->contents())) {
      redirect_to("cart.php#cart_title");
  }
?>
<?php 

      

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
   <title>Cart Checkout - The Academic Mentor</title>  

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
            <h2> Check out Page </h2>
            <div class="shippingStatus">
                
            </div>
            <?php 
            //   if (isset($_SESSION["customer_id"])) {
            //       echo '<h3 class="flow-text">
            //                Welcome Customer hope you had a good shopping experince?
            //             </h3>';
            //   } else {
            //     echo '<h3 class="flow-text red-text">
            //             Welcome Customer we do not your shipping details, please add one 
            //         </h3>';
            //     echo '<a  href="#loginModal" style="margin-top:20px;" class=" modal-trigger btn green btn-md white-text">
            //                 Add shipping details <i class="fa fa-user"></i> 
            //             </a>';
            //   }
              
            ?>
        </div> 
       
        <section id="book-feed">
            <div class="content-wrapper">
                <div class="content-body" style="padding-left:10px">
                    <div class="row">
                       <div class="col s12 m12 l12">
                            <h2 class="teal white-text summary-header">Summary</h2>
                             <h5>Subtotal: <span class="green-text" id="subtotal"></span> </h5>
                               <div class="divider"></div>
                             <h5>Shipping: <span class="green-text" id="shipping"></span>  </h5>
                               <div class="divider"></div>
                             <h5>VAT: <span class="green-text" id="vat"></span> </h5>
                               <div class="divider"></div>
                             <h3>Total: <span class="green-text" id="total"></span></h3>
                             <a onclick="payWithPaystack()" style="margin-top:20px;" class="checkoutBtn disabled btn green btn-lg white-text">
                                PAY NOW <i class="fa fa-credit-card"></i> 
                            </a>
                       </div>
                       
                    </div>

                </div>
            </div>
        </section>
        
        <!-- Modal Structure -->
            <div id="loginModal" class="modal modal-fixed-footer">
                    <div class="modal-content">
                        <div id="booking-content">
                        <h2>Add Shipping details</h2>
                            <form class="login-form">
                            <div class="input-field col m12 s12">
                                    <input type="text" id="customer_name" name="customer_name" class="validate" minlength="6"  required>
                                    <label class="active" for="customer_name" data-error="name too short" data-success=""><i class="fa fa-industry left"></i>Full name *</label>
                                </div>

                                <div class="input-field col m12 s12">
                                    <input type="email" id="customer_email" name="customer_email" class="validate" minlength="5" required>
                                    <label for="customer_email" data-error="Email too short" data-success=""><i class="fa fa-user left"></i> Enter Email *</label>
                                </div>
                    
                                <div class="input-field col m12 s12">
                                    <input type="text" id="customer_phone" name="customer_phone" class="validate" minlength="6" required>
                                    <label for="customer_phone" data-error="phone too short" data-success=""><i class="fa fa-phone left"></i>Phone number (+234)  *</label>
                                </div>
                                
                                <div class="input-field col m12 s12">
                                    <input type="text" id="customer_address" name="customer_address" class="validate" minlength="10" required>
                                    <label for="customer_address" data-error="Enter full address" data-success=""><i class="fa fa-home left"></i>Your address *</label>
                                </div>
                                <div class="input-field col m12 s12">
                                    <button type="submit" name="add_details" class="btn green btn-large signin_btn"><i class="large material-icons right">send</i>Add Details</button>              
                                </div>
                            </form>
                        </div>    
                    </div>
                    <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
                    </div>
            </div>
        <!-- Modal Structure -->


        <!-- Modal Structure -->
            <div id="editLoginModal" class="modal modal-fixed-footer">
                    <div class="modal-content">
                        <div id="booking-content">
                        <h2>Edit shipping details</h2>
                            <form class="login-form editForm">
                            <div class="input-field col m12 s12">
                                    <input type="text" id="customer_name" name="customer_name" class="validate" minlength="6"  required>
                                    <label class="active" for="customer_name" data-error="name too short" data-success=""><i class="fa fa-industry left"></i>Full name *</label>
                                </div>

                                <div class="input-field col m12 s12">
                                    <input type="email" id="customer_email" name="customer_email" class="validate" minlength="5" required>
                                    <label class="active" for="customer_email" data-error="Email too short" data-success=""><i class="fa fa-user left"></i> Enter Email *</label>
                                </div>
                    
                                <div class="input-field col m12 s12">
                                    <input type="text" id="customer_phone" name="customer_phone" class="validate" minlength="6" required>
                                    <label class="active" for="customer_phone" data-error="phone too short" data-success=""><i class="fa fa-phone left"></i>Phone number (234)  *</label>
                                </div>
                                
                                <div class="input-field col m12 s12">
                                    <input type="text" id="customer_address" name="customer_address" class="validate" minlength="10" required>
                                    <label class="active" for="customer_address" data-error="Enter full address" data-success=""><i class="fa fa-home left"></i>Your address *</label>
                                </div>
                                <div class="input-field col m12 s12">
                                    <button type="submit" name="add_details" class="btn green btn-large signin_btn"><i class="large material-icons right">update</i>Update Details</button>              
                                </div>
                            </form>
                        </div>    
                    </div>
                    <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
                    </div>
            </div>
        <!-- Modal Structure -->



        <!-- Modal for payment successful -->
        <div id="success" class="modal modal-fixed-footer">
            <div class="modal-content">
                <h4 class="green-text center">Payment Was successful <i class="fa fa-check"></i></h4>
                <p class="flow-text center">
                    Thank you, your order was received!, hope your buying experience was great?
                   An email your email address. <b><?php if(isset($_SESSION['customer_email'])){ echo $_SESSION['customer_email'];}?></b>, 
                </p>
                <p class="center">Your Transaction referece code is <span id="refCode" class="green-text"></span>, please keep it safe for future use.</p>
                <p class="flow-text center"> You can also reach the admin on 
                    <a title="click to send a whatsapp message" href="https://api.whatsapp.com/send?phone=2348036969390&text=Hello,%20I%20saw%20the%20website%20you%20did%20on%20theacademicmentor.com%20" >
                        +234 803 696 9390
                    </a>
                </p>
                <p class="flow-text center"> Return to homepage
                    <a href="index.php" >
                       click here.
                    </a>
                </p>
            </div>
            <div class="modal-footer">
              <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </div>
        <!-- Modal for payment successful -->

        

        <form>
           <input type="hidden" id="firstName" value="">
           <input type="hidden" id="lastName" value="">
           <input type="hidden" id="phone" value="">
           <input type="hidden" id="email" value="">
           <input type="hidden" id="amount" value="">
        </form>
        <?php include_once("includes/footer.php")?>
    </div>
    <script src="js/jquery-2.1.4.min.js"></script> 
    <script src="js/materialize.js"></script>
    <script defer src="js/custom.js"></script>
    <script defer src="js/cartAction.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script> 
    <script src="js/payStack.js"></script>
    <script src="js/shipping.js"></script>
    
</body>
</html>