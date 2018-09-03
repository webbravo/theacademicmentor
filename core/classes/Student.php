<?php
    class Student
    {
        public  $table_name = "student";
        public  $cp_table = "careerpossibility";
        private $careerInterest;
        private $name; 
        private $email;


        public function saveCareerInterest(string $name, $email, $careerInterest) 
        {
               global $database;
            
            // Save the student career interest to the database.
                $this->careerInterest  =   $careerInterest;
                $this->name            =   $name;
                $this->email           =   $email;


            // Save the student career interest to the database.
                try{
                    $sql = "UPDATE $this->table_name SET careerInterest = :careerInterest WHERE name = :name AND  email = :email";
                    $update = $database->db->prepare($sql);
                    $update->bindParam(':careerInterest', $careerInterest);
                    $update->bindParam(':name', $name);
                    $update->bindParam(':email', $email);
                    return ($update->execute() === true) ? true : false;
                }catch(Expection $e){
                    $this->error_msg = $e->getMessage();
                }     
               
        }

        
        public function count_student()
        { 
            global $database;
            
            try{
                $select          = "SELECT COUNT(id) FROM $this->table_name ";
                $result_set      =  $database->db->query($select); 
                $numbers_of_student =  $result_set->fetch();
                return !empty($numbers_of_student) ? array_shift($numbers_of_student) : false;
                //Check for error from the Query
                $errorInfo = $result_set->errorInfo(); if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
            }catch(Expection $e){
                $this->error_msg = $e->getMessage();
            }    
        }


         // The get All method
        public function getStudent($pagination)
        {
             global $database;
             try{
                //Build Query String
                  $select_student = "SELECT * FROM $this->table_name ORDER BY id DESC LIMIT {$pagination->per_page} OFFSET {$pagination->offset()} ";
                  $select_student = $database->db->query($select_student);
                //Check for error from the Query
                  $errorInfo = $select_student->errorInfo();
                  if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
               //$select_student->fetch();
                  if($select_student) return $select_student;
             }catch(Expection $e){
                  $this->error_msg = $e->getMessage();
             }
                
        }


        public function getCareerInterest(string $name, $email)
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

        public function getCareerInterestFromSession()
        {
            # code...
            if (!isset($_SESSION['careerInterest'])) {
                # Fetch the Career Interest from the Database
                $name  =  $_SESSION['name'];
                $email =  $_SESSION['email'];
                $careerInterest = $this->getCareerInterest($name, $email);
            } else {
                # Fetch the Career Interest from the SESSION file
                $careerInterest = $_SESSION['careerInterest'];
            }

            
            // RETURNS AN ARRAY OF CAREER INTEREST
            $careerInterest = (empty($careerInterest)) ?  "I could not get the careertest" : (explode("," , $careerInterest)) ;
            if(is_array($careerInterest)) return $careerInterest;
            
        }

        public function getListOfCareerPossibilities($careerInterest)
        {

            $careerInterest = strtolower($careerInterest);
            global $database;
            try{
                $sql     =  "SELECT career_options FROM $this->cp_table WHERE personality = :careerInterest LIMIT 1";
                $select  =  $database->db->prepare($sql);
                $select->bindParam(':careerInterest', $careerInterest);
                $select->execute();
                $array_result =  $select->fetch();
                
                // Check for errors 
                $errorInfo = $select->errorInfo(); if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
                
                // Return the list of career options to the user
                // return $array_result = ;
                return  is_array($array_result) ? explode(",", array_shift($array_result)) : false;
            }catch(Expection $e){
                $this->error_msg = $e->getMessage();
            }    
        }

        public function saveStudentCareerOption($firstOption, $secondOption, $name, $email) 
        {
            global $database;

                try{
                    $sql = "UPDATE $this->table_name SET firstOption = '{$firstOption}', secondOption = '{$secondOption}' 
                    WHERE name = '{$name}' AND  email = '{$email}' ";
                    $update = $database->db->query($sql);
                    $errorInfo = $update->errorInfo(); if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
                    return ($update == true) ? true : $errorInfo ;
                }catch(Expection $e){
                    $this->error_msg = $e->getMessage();
                }     
               
        }

    }
  

  $student = new Student();
  
?>