<?php require_once("../../core/initialize.php");?>
<?php  if($session->is_logged_in() == false){ redirect_to("login.php"); }?>
<?php date_default_timezone_set("Africa/Lagos");?>
<?php 

    // global DATABASE VARIABLE;
     global $database; 

     $file_id     = (int)$_GET["fid"]; 
     $table_name  =  $_GET["tbl"];

    // THE CURRENT PAGE NUMBER current_page()
    if(checkid($file_id) == false) die("Delete Execution failed"); 
    
    if (isset($file_id) && !empty($table_name)) {
        // BUILD THE DELETE QUERY 
          $sql  = "DELETE FROM $table_name WHERE id = '{$file_id}' ";
          $delete  =  $database->db->prepare($sql);
          if($delete->execute()){
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
   