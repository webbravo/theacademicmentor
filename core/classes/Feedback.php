<?php 
Class Feedback
  {
            public $table_name  = "feedback";


            public function validate($feedback)
            {
            
                $feedback_len   =    strlen($feedback);

                if($feedback_len <= 10) {
                    return "feedbackTooShort";
                }
            }


            public function add($feedback){

                // Insert Into the Database
                global $database;
                
                    try{
                        $sql = "INSERT INTO $this->table_name (feedback) VALUES(:feedback )";
                        $add_feedback = $database->db->prepare($sql);
                        $add_feedback->bindParam(":feedback", $feedback);
                        return $add_feedback->execute() === true ? true : false;
                    }catch(Expection $e){
                         echo $this->error_msg = $e->getMessage();                    
                    }
                           

            }

              // The get All method
            public function get_all($pagination)
            {
                  global $database;
                  try{
                     //Build Query String
                       $select_feedback = "SELECT * FROM $this->table_name ORDER BY id DESC LIMIT {$pagination->per_page} OFFSET {$pagination->offset()} ";
                       $select_feedback = $database->db->query($select_feedback);
                     //Check for error from the Query
                       $errorInfo = $select_feedback->errorInfo();
                       if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
                    //$select_feedback->fetch();
                       if($select_feedback) return $select_feedback;
                  }catch(Expection $e){
                       $this->error_msg = $e->getMessage();
                  }
            }     
            


            public function count_feedback()
            { 
                global $database;
                
                try{
                    $select          = "SELECT COUNT(id) FROM $this->table_name ";
                    $result_set      =  $database->db->query($select); 
                    $numbers_of_feedback =  $result_set->fetch();
                    return !empty($numbers_of_feedback) ? array_shift($numbers_of_feedback) : false;
                    //Check for error from the Query
                    $errorInfo = $result_set->errorInfo(); if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
                }catch(Expection $e){
                    $this->error_msg = $e->getMessage();
                }    
            }
            


           public function get_feedback_by_id($id)
            {
                global $database;
                try{
                    $sql     =  "SELECT * FROM $this->table_name WHERE id = :id LIMIT 1";
                    $select  =  $database->db->prepare($sql);
                    $select->bindParam(':id', $id);
                    $select->execute();
                    $array_result =  $select->fetch();
                    
                    // Check for errors 
                    $errorInfo = $select->errorInfo(); if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
                    
                    // Return the array of result to the user
                    return  is_array($array_result) ? $array_result : false;
                }catch(Expection $e){
                    $this->error_msg = $e->getMessage();
                }      

            }



            public function update($id, $feedback)
            { 
                global $database;
                try{
                    $update       =  "UPDATE $this->table_name SET feedback = :feedback WHERE id = :id ";
                    $update       =   $database->db->prepare($update);
                    $update->bindParam(':id', $id);
                    $update->bindParam(':feedback', $feedback);
                    return ($update->execute() === true) ? true : false;
                    $errorInfo = $select->errorInfo(); if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
                }catch(Expection $e){
                    $this->error_msg = $e->getMessage();
                }      
            

            } 
            

  }

  $feedback = new Feedback();
  
?>
