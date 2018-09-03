<?php

require_once('database.php');
// require_once('functions.php'); 

class Session {
    
    private  $admin_logged_in     = false;
    private  $merchant_logged_in  = false;
    private  $user_logged_in      = false;
    
    public  $user_id;
  	public  $merchant_id;
    public  $admin_id;
    
    private   $error_msg;
    
    function __construct(){
        session_start();
        $this->check_login();
    }
    
     public function is_logged_in(){
        # code...
        if($this->admin_logged_in == true){

            return $this->admin_logged_in;

        }elseif ($this->merchant_logged_in == true) {

            return $this->merchant_logged_in;

        }elseif($this->user_logged_in == true){

            return $this->user_logged_in;
        }else {
            return false;
        }
        
     }



    public function login_user($user_unique_id, $password)
    {
         // Database Should find user based on username / hashed password
           global $database;
           try{
                $sql     =  "SELECT id, hashedPassword FROM users WHERE phone = :phone OR email = :email LIMIT 1";
                $select  =  $database->db->prepare($sql);
                $select->bindParam(':phone', $user_unique_id);
                $select->bindParam(':email', $email);
                $select->execute();
                $result_set = !empty($select->fetch()) ? $select->fetch() : 'No record!';
                $user_id          =  $result_set["id"];
                $hashed_password  =  $result_set['hashedPassword'];
                
                // Check if the Paasword and email matches
                if(!empty($user_id) && password_verify($password, $hashed_password) == true){
                    $this->user_id = $_SESSION['user_id'] = $user_id;  
                    $this->user_logged_in = true; 
                    // So We return true that a Member was logged In , 
                    return true;
                } else{
                    return false;
                }
                // Check if there is an error in sql execution 
                $errorInfo = $select->errorInfo(); if (isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
           }catch(Expection $e){
               $this->error_msg = $e->getMessage();
           }
         
        
    }




    public function login_admin($admin_unique_id, $password)
    {
            global $database;
            
            try{
                $sql = " SELECT id, hashedPassword FROM admin WHERE phone = :phone OR email = :email LIMIT 1";
                $select = $database->db->prepare($sql);
                $select->bindParam(':phone', $admin_unique_id);
                $select->bindParam(':email', $admin_unique_id);
                $select->execute();
                $row = $select->fetch();
                $result_set = !empty($row) ? $row : 'No record!';
                // Check if the Paasword and email matches
                if(!empty($result_set["id"]) && password_verify($password, $result_set['hashedPassword']) === true){
                    $this->admin_id = $_SESSION['admin_id'] = $result_set["id"];  
                    $this->admin_logged_in = true; 
                // So We return true that the admin was logged In ,
                    return true;
                } else{
                    return false;
                }
                // Check if there is an error in sql execution 
                $errorInfo = $select->errorInfo(); if (isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
            }catch(Expection $e){
                echo $this->error_msg = $e->getMessage();
            }

    }
  


    public function logout($user_id){
        # code...
       if(isset($this->user_id)){
            unset($this->user_id);
            $this->user_id = " ";
            $this->logged_in = false;

       }elseif(isset($this->driver_id)){

            unset($this->driver_id);
            $this->driver_id = " ";
            $this->logged_in = false;

       }elseif(isset($this->admin_id)){

            unset($this->admin_id);
            $this->admin_id = " ";
            $this->logged_in = false;
         
       }/*else{
           echo "Could not Destory";
           exit();
       }*/
    }




    public function check_login(){
        # code...
        if(isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
            $this->user_logged_in = true;
        } else if(isset($_SESSION['merchant_id'])){
            $this->merchant_id = $_SESSION['merchant_id'];
            $this->merchant_logged_in = true;
        } else if(isset($_SESSION['admin_id'])){
            $this->admin_id = $_SESSION['admin_id'];
            $this->admin_logged_in = true;
        }    
          else{
              unset($this->admin_id);
              unset($this->user_id);
			  unset($this->driver_id);
              $this->logged_in = false;
        }
    }



}
$session = new Session();
?>