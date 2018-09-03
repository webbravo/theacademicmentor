<?php require_once("../../core/initialize.php");?>
<?php  if($session->is_logged_in() == false){ redirect_to("login.php"); }?>
<?php date_default_timezone_set("Africa/Lagos");?>
<?php 
    // global DATABASE VARIABLE;
     global $database; 

     $orderID  = (int)$_GET["orderID"]; 

    // THE CURRENT PAGE NUMBER current_page()
    if(checkid($orderID) == false) die("Update Execution failed"); 
    
    if (isset($orderID) ) {
        // BUILD THE update QUERY 
          $sql  = "UPDATE orders SET status = '0' WHERE id = '{$orderID}' LIMIT 1";
          $update  =  $database->db->prepare($sql);
          if($update->execute()){
              $loc = $_SERVER["HTTP_REFERER"];
              redirect_to($loc); 
          }
        
    }

    
?>
   