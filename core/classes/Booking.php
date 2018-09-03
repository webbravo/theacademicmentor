<?php
   

    class Booking 
    {
        
        private  $error_msg;
        public   $table_name      = "booking";        
        private  $notificationMsg = "Good day! Admin one booking request just came in from TAM's website, please click here to login https://theacademicmentor.com/admin/";

        public function checkForPendingBooking(String $ph, $em, $dt)
        {
            # code..
            global $database;

            try {
                $sql    =  "SELECT COUNT(id) FROM booking WHERE phone = :phone AND email = :email AND event_date = :date AND booking_status = :status LIMIT 1";
                $check  =  $database->db->prepare($sql);
                $check->bindParam(':phone', $ph);
                $check->bindParam(':email', $em);
                $check->bindParam(':date',  $dt);
                $check->bindValue(':status',  'active');
                $check->execute();
                $row = $check->fetch();
                $result = (isset($row) ? array_shift($row) : '0') >= 1 ? true : false ;
                $errorInfo = $check->errorInfo();
                if (isset($errorInfo[2]))  $this->error_msg = $errorInfo[2];
            }catch(Expection $e){
                $this->error_msg = $e->getMessage();
            }    
            return $result;
        }

        public function createBooking(Array $formData)
        {
            global $database;
            global $message;
            $columns  =  implode("," , array_keys($formData));
            $values   =  implode("','", array_values($formData));
            $sql      =  "INSERT INTO `booking` ($columns) VALUES('{$values}')";
            $insert   =  $database->db->prepare($sql);
            if($insert->execute() === true){
               // We Send notification message to send admin via SMS or Email
                  $message->sendsms($this->notificationMsg, $formData['phone']);
               // After the message it sent, we Return true (Async)
                  return true;
            }else{
                return false;
            }    
        }



        public function countBooking(String $type)
        { 
            global $database;
            try{
                # THIS METHOD COUNTS ALL THE PRODUCT THE BELONGS TO THIS MERCHANT.
                $select          = "SELECT COUNT(id) FROM $this->table_name WHERE booking_status = '{$type}'";
                $result_set      =  $database->db->query($select); 
                $numbers_of_booking =  $result_set->fetch();
                return !empty($numbers_of_booking) ? array_shift($numbers_of_booking) : false;
                //Check for error from the Query
                $errorInfo = $select_blog->errorInfo(); if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
            }catch(Expection $e){
                $this->error_msg = $e->getMessage();
            }    
        }

        // The get All method
        public function getBooking(String $type, Pagination $pagination)
        {
            global $database;
            try{
               //Build Query String
                 $select_booking = "SELECT * FROM $this->table_name WHERE booking_status = '{$type}' ORDER BY id DESC LIMIT {$pagination->per_page} OFFSET {$pagination->offset()} ";
                 $select_booking = $database->db->query($select_booking);
               //Check for error from the Query
                 $errorInfo = $select_booking->errorInfo();
                 if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
              //$select_booking->fetch();
                 if($select_booking) return $select_booking;
            }catch(Expection $e){
                 $this->error_msg = $e->getMessage();
            }
               
        }


        public function get_booking_by_id(int $id = null, String $type )
        {
            global $database;
            try{
                $sql     =  "SELECT * FROM $this->table_name WHERE id = :id AND booking_status = :status LIMIT 1";
                $select  =  $database->db->prepare($sql);
                $select->bindParam(':id', $id);
                $select->bindParam(':status', $type);
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

        public function error()
        {
            return isset($this->error_msg) ? $this->error_msg : null ;
        }

    }

    $booking = new Booking();
  
?>