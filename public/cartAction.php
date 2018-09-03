<?php require_once("../core/initialize.php");?>
<?php
global $database, $cart, $customers;
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){

    // ADD ITEM TO THE CART LIST
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){
        $productID = $_REQUEST['id']; 
        $quantity  = !empty($_REQUEST['qty']) ? $_REQUEST['qty'] : "1";
        // get product details
        $sql = "SELECT id, name, price FROM products WHERE id = :id LIMIT 1";
        $select  =  $database->db->prepare($sql);
        $select->bindParam(':id', $productID);
        $select->execute();
        $row =  $select->fetch();
        $itemData = array(
            'id'    => $row['id'],
            'rowid' => $row['id'],
            'name'  => $row['name'],
            'price' => $row['price'],
            'qty'   => $quantity
        );
        $insertItem = $cart->insert($itemData);
        if($insertItem){
            $cartItem = $cart->total_items();
            echo !empty($cartItem) ? $cartItem : "0";
        }
    }

    // COUNT ITEM ON THE CART    
    elseif($_REQUEST['action'] == 'countCartItem'){
        $cartItem = $cart->total_items();
        echo !empty($cartItem) ? $cartItem : "0";
    }


    // COMPUTE THE SUBTOTAL    
     elseif($_REQUEST['action'] == 'computeSubtotal'){
        $sub_total = $cart->total();
        echo !empty($sub_total) ? number_format($sub_total) : "0";
    }

    // COMPUTE THE SUBTOTAL    
    elseif($_REQUEST['action'] == 'getTotal'){
        $sub_total = $cart->total();
        if($sub_total === 0){ $cartTotal = 0;}else if($sub_total >= 1){$cartTotal = $sub_total + 200 + 0.00;}
        echo !empty($cartTotal) ? number_format($cartTotal) : "0";
    }

    // UPDATE ITEM ON THE CART
    elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        $quantity  = !empty($_REQUEST['qty']) ? $_REQUEST['qty'] : "1";
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty'   => $quantity
        );
        $updateItem = $cart->update($itemData);
        if($updateItem){
            $cartItem = $cart->total_items();
            echo !empty($cartItem) ? $cartItem : "0";
        }
    }
    
    // ADD SHIPPING DETAILS && CAPTURE THE CUSTOMER DETAILS IN SESSION VARIBALE
    elseif ($_REQUEST['action'] == 'addShippingDetails' && !empty($_REQUEST['fullname']) && !empty($_REQUEST['email'])  && !empty($_REQUEST['phone'])  && !empty($_REQUEST['address'])) {

        $save = $customers->saveCustomers($_REQUEST['fullname'], $_REQUEST['email'], $_REQUEST['phone'], $_REQUEST['address']);
        // echo $save." ".$_SESSION['customer_id'];
        if(isset($save)){echo "true";}else{echo "false";}
        
        
    }

    // DELETE THE ITEM FROM THE CART
    elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id']))
    {
       if( $cart->remove($_REQUEST['id']) ){echo "true";}else{echo "false";}
    }
    

    // GET ALL IMPORTANT INFO TO PROCESS THE PAYMENT
    elseif($_REQUEST['action'] == 'getPaymentDetails')
    {  
       $amt  =  $sub_total = $cart->total();

       $firstName  =  $_SESSION['customer_firstName'];
       $lastName   =  $_SESSION['customer_lastname'];
       $email      =  $_SESSION['customer_email'];
       $phone      =  $_SESSION['customer_phone'];
       $amount     =  $amt + 200.00 + 0.00;
       $paymentDetails =   [
                            "firstName" =>  $firstName,
                            "lastName"  =>  $lastName, 
                            "email"     =>  $email,
                            "phone"     =>  $phone, 
                            "amount"    =>  $amount
                        ];
       echo json_encode($paymentDetails); exit;
    }

    elseif($_REQUEST['action'] == 'placeOrder' && $_REQUEST['ref_code']  && $cart->total_items() > 0 && !empty($_SESSION['customer_id'])){
        // insert order details into database
        $insertOrder = $database->db->query("INSERT INTO orders (ref_code , customer_id, total_price, created, modified) 
        VALUES ('".$_REQUEST['ref_code']."', '".$_SESSION['customer_id']."', '".$cart->total()."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')");
        
        if($insertOrder){
            $orderID = $database->db->lastInsertid();
            $sql = '';
            // get cart items
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
                $sql .= "INSERT INTO order_items (order_id, product_id, quantity) VALUES ('".$orderID."', '".$item['id']."', '".$item['qty']."');";
            }
            // insert order items into database
            $insertOrderItems = $database->db->query($sql);
            
            if($insertOrderItems){
                 if($cart->destroy()){
                     echo true;
                     exit;
                 }
                //header("Location: orderSuccess.php?id=$orderID");
            }else{
                echo "this na place order wahala  ".$insertOrderItems;
                exit;
            }
        }else{
            header("Location: checkout.php");
            exit;
        }
    }else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}