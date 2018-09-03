<?php require_once("../../core/initialize.php");?>
<?php  if($session->is_logged_in() == false){ redirect_to("login.php"); }?>
<?php date_default_timezone_set("Africa/Lagos");?>
<?php 
    // global DATABASE VARIABLE;
     global $database; 

     $booking_id  = (int)$_GET["id"]; 
     $action      = $_GET["action"]; 

    // THE CURRENT PAGE NUMBER current_page()
    if(checkid($booking_id) == false) die("Update Execution failed"); 
    
    if (isset($booking_id) && !empty($action)) {
        // BUILD THE update QUERY 
          $sql  = "UPDATE booking SET booking_status = '{$action}' WHERE id = '{$booking_id}' LIMIT 1";
          $update  =  $database->db->prepare($sql);
          if($update->execute()){
              $loc = $_SERVER["HTTP_REFERER"];
              redirect_to($loc); 
          }
        
    }

    global $photo;

    if(isset($_POST['ajaxRequest']) && !empty($_POST['ajaxRequest'])) {
      // THE CURRENT PAGE NUMBER current_page()
          $file_id     =  $database->prep_value((int)$_POST['ajaxRequest']); 
          
         // echo $file_id; exit;
          if(checkid($file_id) == false) die("Delete Execution failed");

      // BUILD THE DELETE QUERY 
          $delete = "DELETE FROM $photo->table_name WHERE id = '{$file_id}' ";
          
      // IF THE DELETE WAS SUCCESSFUL REDIRECT TO REFERRER  
          if($database->query($delete) == true){
             echo "deleted";
             exit;
          }

  }  

    
?>
   