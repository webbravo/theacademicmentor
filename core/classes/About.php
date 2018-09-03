<?php
  Class About
  {
        public $table_name  = "abouttam";
           
        public function get_about_tam()
        {
            global $database;
            
            try{
                $select       =  "SELECT * FROM $this->table_name WHERE id = '1' ";
                $select       =   $database->db->query($select);
                $array_result =   $select->fetch();
                return $array_result ;
                $errorInfo = $select->errorInfo(); if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
            }catch(Expection $e){
                $this->error_msg = $e->getMessage();
            }      

        }


        public function update(String $about_tam)
        {
            global $database;
            
            try{
                $update       =  "UPDATE $this->table_name SET about = :about_tam WHERE id = '1' ";
                $update       =   $database->db->prepare($update);
                $update->bindParam(':about_tam', $about_tam);
                return ($update->execute() === true) ? true : false;
                $errorInfo = $select->errorInfo(); if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
            }catch(Expection $e){
                $this->error_msg = $e->getMessage();
            }      

        }

  }

  $about = new About();
  
?>