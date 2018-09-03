<?php 

Class Video
{         

            private   $error_msg;
            public    $table_name     = "video";
            public    $photo_path     =  SITE_ROOT."/"."public"."/"."admin"."/"."uploads"."/"."blog"."/"; 
            public    $photo_db_path  = "admin"."/"."uploads"."/"."blog"."/";


            public function validate($videoTitle, $videoCaption)
            {
                # code...
                $title_len = strlen($videoTitle); 
                $story_len = strlen($videoCaption);

                if ($title_len >= 200) {
                    return "titleTooLong";
                }else if($title_len <= 10){
                    return "titleTooShort";
                } elseif ($story_len < 20) {
                    return "storyTooShort";
                }
            }


            public function add($videoTitle, $videoCaption, $videoURL)
            {
                # THIS METHOD ADDS A VIDEO
                  global $database;
            
                try{  
                      // Insert Into the Database
                      $sql = "INSERT INTO $this->table_name (videoTitle, videoCaption, videoURL, dateAdded)
                               VALUES(:videoTitle, :videoCaption, :videoURL, :dateAdded )";
                      $insert = $database->db->prepare($sql);
                      $insert->bindParam(':videoTitle', $videoTitle);     
                      $insert->bindParam(':videoCaption', $videoCaption);     
                      $insert->bindParam(':videoURL', $videoURL);
                      $insert->bindValue(':dateAdded', time());
                      $result = $insert->execute();
                      return $result === true ? true : false;
                      // Check if there is any error and then log the error
                      $errorInfo = $insert->errorInfo();
                      if (isset($errorInfo[2])) echo $this->error_msg = $errorInfo[2]; 
                }catch(Expection $e){
                      echo $this->error_msg = $e->getMessage();;
                }
                
            }


            // The get All method
            public function get_all($pagination)
            {
                global $database;
                try{
                   //Build Query String
                     $select_video = "SELECT * FROM $this->table_name ORDER BY id DESC LIMIT {$pagination->per_page} OFFSET {$pagination->offset()} ";
                     $select_video = $database->db->query($select_video);
                   //Check for error from the Query
                     $errorInfo = $select_video->errorInfo();
                     if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
                  //$select_video->fetch();
                     if($select_video) return $select_video;
                }catch(Expection $e){
                     $this->error_msg = $e->getMessage();
                }
                   
            }
            
            

            public function count_video()
            { 
                global $database;
                
                try{
                    # THIS METHOD COUNTS ALL THE PRODUCT THE BELONGS TO THIS MERCHANT.
                    $select          = "SELECT COUNT(id) FROM $this->table_name ";
                    $result_set      =  $database->db->query($select); 
                    $numbers_of_post =  $result_set->fetch();
                    return !empty($numbers_of_post) ? array_shift($numbers_of_post) : false;
                    //Check for error from the Query
                    $errorInfo = $select_video->errorInfo(); if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
                }catch(Expection $e){
                    $this->error_msg = $e->getMessage();
                }    
            }
            

            public function get_video_by_id($id = null)
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



            public function update($id, $videoTitle, $videoCaption, $videoURL )
            {                 
                global $database;               
                try{
                    $sql = "UPDATE $this->table_name SET videoTitle = :videoTitle, videoCaption = :videoCaption, videoURL = :videoURL WHERE id = :id ";
                    $update = $database->db->prepare($sql);
                    $update->bindParam(':videoTitle', $videoTitle);
                    $update->bindParam(':videoCaption', $videoCaption);
                    $update->bindParam(':videoURL', $videoURL);
                    $update->bindParam(':id', $id);
                    return ($update->execute() === true) ? true : false;
                }catch(Expection $e){
                    $this->error_msg = $e->getMessage();
                }     
            
            } 
            

            
  }

  $video = new Video();
  
?>
