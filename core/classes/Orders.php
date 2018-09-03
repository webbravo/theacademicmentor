<?php
    class Orders
    {
        public  $table_name = "orders";
    
        
        public function count_orders($status)
        { 
            global $database;
            
            try{
                # THIS METHOD COUNTS ALL THE PRODUCT THE BELONGS TO THIS MERCHANT.
                $select          = "SELECT COUNT(id) FROM $this->table_name WHERE status = '{$status}' ";
                $result_set      =  $database->db->query($select); 
                $numbers_of_order =  $result_set->fetch();
                return !empty($numbers_of_order) ? array_shift($numbers_of_order) : false;
                //Check for error from the Query
                $errorInfo = $result_set->errorInfo(); if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
            }catch(Expection $e){
                $this->error_msg = $e->getMessage();
            }    
        }


         // The get All method
        public function get_orders($status, $pagination)
        {
             global $database;
             try{
               
                  $select_orders = "SELECT orders.id AS orderID, orders.ref_code, orders.total_price AS amount_paid, orders.created AS created, orders.status, customers.name AS customer_name FROM $this->table_name, customers  WHERE orders.status='{$status}' AND orders.customer_id = customers.id ORDER BY orders.id DESC LIMIT {$pagination->per_page} OFFSET {$pagination->offset()} ";
                  $select_orders = $database->db->query($select_orders);
                //Check for error from the Query
                  $errorInfo = $select_orders->errorInfo();
                  if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
               //$select_orders->fetch();
                  if($select_orders) return $select_orders;
             }catch(Expection $e){
                  $this->error_msg = $e->getMessage();
             }
                
        }

       public function viewOrders(int $id = null)
       {
           # SELECT order_items.quantity, products.id, products.name, products.photo, order_items.order_id FROM order_items, products WHERE order_items.order_id = '21' AND order_items.product_id = products.id 

           global $database;
           try{
               $sql = "SELECT order_items.quantity AS quantity, products.id AS id, products.name AS name, products.price AS price, products.photo AS photo, order_items.order_id AS order_id FROM order_items, products WHERE order_items.order_id = :id AND order_items.product_id = products.id";
            //   echo  $sql;
               $select_orders  =  $database->db->prepare($sql);
               $select_orders->bindParam(':id', $id);
               $select_orders->execute();
               //$array_result =  $select->fetch();
               
               // Check for errors 
               $errorInfo = $select_orders->errorInfo(); if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
               
               // Return the array of result to the user
               if($select_orders) return $select_orders;
               //return  is_array($array_result) ? $array_result : false;
           }catch(Expection $e){
               $this->error_msg = $e->getMessage();
           }  
       }



       



    }
  

  $orders = new Orders();
  
?>