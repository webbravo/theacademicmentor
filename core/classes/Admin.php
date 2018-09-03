<?php 

      Class Admin{
        
        
      public  $table_name = "admin";
      public $error_msg;
      private $image_path = "../../public/img/admin/";


      private function check_user_existence($phone, $email){
                global $database;  
                // This Function Can
                # 1. Will check If Phone/Email Is Registered Before. 

                  #1.1 Query the Database 
                    $check_query = " SELECT * FROM ".$this->table_name." WHERE phone = '{$phone}' OR  email = '{$email}' ";
                      
                  # 1.2 Return result Set 
                    $check_query = $database->query($check_query);
                    $check_result = mysqli_num_rows($check_query);
                    
                    if($check_result > 0){
                        return true;
                    }else{
                      return false;

                    }
                    
      }

      public function create_new_admin($first_name, $last_name, $email, $phone, $password){
            # Code..
              global $database;  
            $signup_date = date("M d Y", time());
            # PREPARE THE DATABASE Query
                    $update_query = "INSERT INTO  ".$this->table_name." 
                                    (first_name, last_name, phone, email, password, signup_date, status)
                                    VALUES('$first_name','$last_name','$phone','$email','$password','$signup_date', '1')";
                                    
                          # Check IF Query Was Sucessful
                          if($database->query($update_query)){
                            return true;
                          }else{
                            return true;
                          } 
      }  
      

      private function comparePass($oldPass, $user_id)
      {   
          try{
              global $database;
              // Get the Old password for the data
                $select  =  "SELECT hashedPassword FROM $this->table_name WHERE id = '{$user_id}' LIMIT 1";
                $select  =  $database->db->query($select);
                $pass    =  $select->fetch();
                $hashedPassword =  array_shift($pass) ; 
                //  COMPARE  PASSWORD
                return (password_verify($oldPass , $hashedPassword) == true) ? true : false ;
                $errorInfo = $result_set->errorInfo(); if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];            
          }catch(Expection $e){
              $this->error_msg = $e->getMessage();          
          }
      } 


      public function validate($oldPass, $newPass, $conPass)
      {
              # code...
          if(!isset($oldPass) || !isset($newPass)){
              return "empty";
          }elseif (strlen($newPass) < 5) {
              # code...
              return "tooShort";
          }else if($newPass !== $conPass){ 
            //echo  "The Password Do match"; exit;
              return "misMatch";
          }

      }
    
      
      public function changePassword($newPass, $oldPass)
      {  
        global $database;
        
            # code...
              $user_id = 1;

              $newPass = password_hash($newPass, PASSWORD_DEFAULT);

              $comparePass = $this->comparePass($oldPass, $user_id);
          
          if($comparePass == false){
                return false;
          }else{
              // Update The password field+
                try{
                    $sql = "UPDATE $this->table_name SET hashedPassword = :newPass WHERE id = :user_id LIMIT 1";
                    $update = $database->db->prepare($sql);            
                    $update->bindParam(':newPass', $newPass);
                    $update->bindParam(':user_id', $user_id);
                    return ($update->execute() === true) ? true : false;
                }catch(Expection $e){
                    $this->error_msg = $e->getMessage();
                }   


          }


      }	
      

    }

   $admin = new Admin();
?>