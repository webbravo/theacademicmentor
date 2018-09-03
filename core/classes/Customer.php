<?php
    class Customers
    {
        public $table_name = "customers";
        private $fullname;
        private $email;
        private $phone;
        private $address;

        public function saveCustomers(String $fullname, $email, $phone, $address) 
        {
               global $database;
            
            // Save the customers career interest to the database.
                $this->fullname  =   $fullname;
                $this->email     =   $email;
                $this->phone     =   $phone;
                $this->address   =   $address;


            // Save the customers career interest to the database.
                try{
                    $sql = "INSERT INTO $this->table_name (name, email, phone, address, created, modified, status)
                                  VALUES(:fullname, :email, :phone, :address, :created,  :modified, :status) ON DUPLICATE KEY UPDATE id = id";
                                   
                    $add_customer = $database->db->prepare($sql);
                    $add_customer->bindParam(':fullname', $fullname);
                    $add_customer->bindParam(':email',    $email);
                    $add_customer->bindParam(':phone',    $phone);
                    $add_customer->bindParam(':address',  $address);
                    $add_customer->bindValue(":created",  date("Y-m-d H:i:s", time() ) );  // 2018-06-27 01:06:00          
                    $add_customer->bindValue(":modified", date("Y-m-d H:i:s", time() ) );            
                    $add_customer->bindValue(":status",   1); 
                    if($add_customer->execute() === true){
                        $_SESSION['customer_id']     = $database->db->lastInsertid();
                        $_SESSION['customer_email']  = $email;
                        $_SESSION['customer_phone']  = $phone;
                        $nameStr = explode(" ", $fullname);
                        $_SESSION['customer_firstName'] = $nameStr[0];
                        $_SESSION['customer_lastname']  = $nameStr[1];

                        // Check if the customer_id is Set
                        return isset($_SESSION['customer_id']) ? true : false;
                    }
                }catch(Expection $e){
                    return $this->error_msg = $e->getMessage();
                }     
               
        }


        public function updateCustomers(String $fullname, $email, $phone, $address) 
        {
               global $database;
            
            // Save the customers career interest to the database.
                $this->fullname  =   $fullname;
                $this->email     =   $email;
                $this->phone     =   $phone;
                $this->address   =   $address;


            // Save the customers career interest to the database.
                try{
                    $sql = "UPDATE $this->table_name SET name = :fullname WHERE name = :name AND  email = :email";
                    $update = $database->db->prepare($sql);
                    $update->bindParam(':fullname', $fullname);
                    $update->bindParam(':name', $name);
                    $update->bindParam(':email', $email);
                    $update->bindParam(':email', $email);
                    return ($update->execute() === true) ? true : false;
                }catch(Expection $e){
                    $this->error_msg = $e->getMessage();
                }     
               
        }



        
        public function count_customers()
        { 
            global $database;
            
            try{
                # THIS METHOD COUNTS ALL THE PRODUCT THE BELONGS TO THIS MERCHANT.
                $select          = "SELECT COUNT(id) FROM $this->table_name ";
                $result_set      =  $database->db->query($select); 
                $numbers_of_customers =  $result_set->fetch();
                return !empty($numbers_of_customers) ? array_shift($numbers_of_customers) : false;
                //Check for error from the Query
                $errorInfo = $result_set->errorInfo(); if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
            }catch(Expection $e){
                $this->error_msg = $e->getMessage();
            }    
        }


         // The get All method
        public function getcustomers($pagination)
        {
             global $database;
             try{
                //Build Query String
                  $select_customers = "SELECT * FROM $this->table_name ORDER BY id DESC LIMIT {$pagination->per_page} OFFSET {$pagination->offset()} ";
                  $select_customers = $database->db->query($select_customers);
                //Check for error from the Query
                  $errorInfo = $select_customers->errorInfo();
                  if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
               //$select_customers->fetch();
                  if($select_customers) return $select_customers;
             }catch(Expection $e){
                  $this->error_msg = $e->getMessage();
             }
                
        }


        public function getCareerInterest(String $name, $email)
        {
            global $database;
            try{
                $sql     =  "SELECT careerInterest FROM $this->table_name WHERE name = :name AND  email = :email LIMIT 1";
                $select  =  $database->db->prepare($sql);
                $select->bindParam(':name', $name);
                $select->bindParam(':email', $email);
                $select->execute();
                $array_result =  $select->fetch();
                
                // Check for errors 
                $errorInfo = $select->errorInfo(); if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
                
                // Return the array of result to the user
                return  is_array($array_result) ? array_shift($array_result) : false;
            }catch(Expection $e){
                $this->error_msg = $e->getMessage();
            }      

        }



    }
  

  $customers = new Customers();
  
?>