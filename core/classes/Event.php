<?php 

  Class Event 
  {
            public    $table_name     = "event";
            public    $photo_path     =  SITE_ROOT."/"."public"."/"."admin"."/"."uploads"."/"."events"."/"; 
            public    $photo_db_path  = "admin"."/"."uploads"."/"."events"."/";
            public    $time_zone      = "Africa/Lagos"; 
            Public    $error_msg;


            public function formatEventDate($timeStamp)
            {
                # code...
                $startTime =  strftime($timeStamp);
                return $startTime =  date("M d Y h:ia", $startTime);
            }

            
            // Covert the event's UNIX TS to html5 datetime value
            public function covert_datetime_locale($timeStamp)
            {
                # code...
                 $htmlDate = date("Y-m-d H:i", $timeStamp);
                 return str_replace(" ", "T" , $htmlDate);
            }



            public function validate($id, $eventTitle, $eventLocation,  $eventStartDate, $eventEndDate,  $eventStory)
            {

                //$eventStory; 
                $title_len      =  strlen($eventTitle); 
                $story_len      =  strlen($eventStory); 
                $eventLocation  =  strlen($eventLocation);
                $eventStartDate =  strtotime($eventStartDate);
                $eventEndDate   =  strtotime($eventEndDate);

                // CHECK EVENT DATE FOR DUPLICATE ENTRY
                $checkDate = $this->check_event_date( $id, $eventStartDate, $eventEndDate ) ; 

                if ($title_len >= 200)
                 {
                    return   '<div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                Title too long (200 max char)
                            </div>';
                }
                else if($eventLocation <= 25)
                {
                    return   '<div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                Enter center address too short
                             </div>';
                } 
                else if($title_len <= 15)
                {
                    return   '<div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                Title too short (10 min char)
                             </div>';
                } 
                elseif ($story_len < 100) 
                {
                    return '<div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                               Event details too short (20 min char)
                            </div>';
                }
                
                elseif ($checkDate == false) {
                    # code...
                    return "DuplicateDate";
                }

                elseif ($eventStartDate > $eventEndDate) 
                {
                    # code...
                    return  '<div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                The event Start date greater than End date!
                            </div>';
                }

                elseif ($eventStartDate < time() - 10) 
                {
                    # code...
                    return  '<div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                Please choose a date in the future(start event).
                            </div>';
                }
                
                elseif ($eventEndDate < time() - 10) {
                    # code...
                    return '<div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                Please choose a date in the future(end event).
                            </div>';
                }
                else{
                    return ;
                }
            }


            private function check_event_date(int $id,  $eventStartDate,  $eventEndDate)
            {
                global $database;
                try{
                    $sql = "SELECT COUNT(id) FROM $this->table_name WHERE startDate = :eventStartDate AND 
                             endDate = :eventEndDate AND startDate >= UNIX_TIMESTAMP() AND id <> :id LIMIT 1";
                    $check = $database->db->prepare($sql);

                    $check->bindParam(":id", $id);
                    $check->bindParam(":eventStartDate", $eventStartDate);
                    $check->bindParam(":eventEndDate", $eventEndDate);

                    $check->execute();

                    $result = $check->fetch();
                    $num    = array_shift($result);

                    return ($num === 1 ) ? false : true;
                }catch(Expection $e){
                    $this->error_msg = $e->getMessage();
                }
               
            }


            public function add($eventTitle,  $eventLink, $eventLocation,  $eventPhoto,  $eventStartDate, $eventEndDate, $eventStory){
                # THIS METHOD ADDS A PRODUCT

                global $image_uploader;
                global $database;
                

                // Remove the "T" from the dateTime String
                   $eventStartDate = str_replace("T", " ", $eventStartDate);
                   $eventEndDate   = str_replace("T", " ", $eventEndDate);

                   
                // WHEN THE EVENT & END TIME ARE THE SAME add 3 HRS
                   if ($eventStartDate == $eventEndDate) {
                       $addTime = 3 * 60 * 60;
                       $eventStartDate += $addTime;
                       $eventEndDate   += $addTime;
                   }   

                // The Defaukt Time Zone   
                   $timezone = $this->time_zone;
                 
                   // Try to upload the Photo to the Webserver and Return the Photo's new name
                   $uploadPhoto =  $image_uploader->upload_single_photo($eventPhoto, $this->photo_path);
                   if($uploadPhoto == false) {echo "Photo Upload failed"; exit;}

                 // New Image path R = Renamed
                    $eventPhotoR = $this->photo_db_path.$uploadPhoto; 

                    // echo $eventPhotoR." ".$eventStartDate." ".$eventEndDate; exit;
                
                    try
                    {
                        $sql = "INSERT INTO $this->table_name (eventPhoto, eventTitle,  eventLink  , eventLocation, startDate, endDate, eventStory, timeZone, dateAdded)
                        VALUES(:eventPhotoR, :eventTitle, :eventLink, :eventLocation, :eventStartDate, :eventEndDate, :eventStory,  :timezone,  :dateAdded )";
        
                        $add_event = $database->db->prepare($sql);
                        
                        $add_event->bindParam(":eventPhotoR",     $eventPhotoR);            
                        $add_event->bindParam(":eventTitle",      $eventTitle);            
                        $add_event->bindParam(":eventLink",       $eventLink);            
                        $add_event->bindParam(":eventLocation",   $eventLocation);            
                        $add_event->bindValue(":eventStartDate",  strtotime($eventStartDate));            
                        $add_event->bindValue(":eventEndDate",    strtotime($eventEndDate));            
                        $add_event->bindParam(":eventStory",      $eventStory);            
                        $add_event->bindParam(":timezone",        $timezone);            
                        $add_event->bindValue(":dateAdded",       time());            
                        
                       // Check IF the EVENTS WAS ENTERED TO THE DATABASE
                        if($add_event->execute() === true){
                            return true;
                        }else{
                            return false; 
                        }
                    }catch(Expection $e){
                        $this->error_msg = $e->getMessage();
                    }
                   
                        

            }

    
            // The get All method
            public function get_all(Pagination $pagination)
            {
                global $database;
                try{
                //Build Query String
                    $select_events = "SELECT * FROM $this->table_name WHERE startDate > UNIX_TIMESTAMP() ORDER BY startDate ASC LIMIT {$pagination->per_page} OFFSET {$pagination->offset()} ";
                    $select_events = $database->db->query($select_events);
                //Check for error from the Query
                    $errorInfo = $select_events->errorInfo();
                    if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
                //$select_events->fetch();
                    if($select_events) return $select_events;
                }catch(Expection $e){
                    $this->error_msg = $e->getMessage();
                }
                    
            }
            

            public function AjaxEventRequest($id)
            {
                # code...
                // Get events by ID
                $event       =  $this->get_event_by_id($id);
                if(!empty($event) && is_array($event) && $event !== false){
                    $summary     =  $event["eventTitle"];
                    $location    =  $event["eventLocation"];
                    $description =  $event["eventStory"];
                    $start       =  $event["startDate"];
                    $end         =  $event["startEnd"];
                    $timeZone    =  $event["timeZone"];
                    
                        $eventArray =    array(
                                              'summary' => $summary,
                                              'location' => $location,
                                              'description' => $description,
                                              'start' => array(
                                                 'dateTime' => $start,
                                                 'timeZone' => $timeZone,
                                              ),
                                             'end' => array(
                                                 'dateTime' => $end,
                                                 'timeZone' => $timeZone,
                                              ),
                                              'reminders' => array(
                                                 'useDefault' => FALSE,
                                                 'overrides' => array(
                                                     array('method' => 'email', 'minutes' => 24 * 60),
                                                     array('method' => 'popup', 'minutes' => 10),
                                                 ),
                                              )  
    
                                            );

                       
                        return json_encode($eventArray);

                } else{
                    return json_encode("error => Event ID not found");
                }
    
  
            }
            

            public function count_event()
            { 
                global $database;
                
                try{
                    # THIS METHOD COUNTS ALL THE PRODUCT THE BELONGS TO THIS MERCHANT.
                    $select = "SELECT COUNT(id) FROM $this->table_name WHERE startDate >= UNIX_TIMESTAMP()";
                    // $select          = "SELECT COUNT(id) FROM $this->table_name ";
                    $result_set      =  $database->db->query($select); 
                    $numbers_of_events =  $result_set->fetch();
                    return !empty($numbers_of_events) ? array_shift($numbers_of_events) : false;
                    //Check for error from the Query
                    $errorInfo = $select_events->errorInfo(); if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
                }catch(Expection $e){
                    $this->error_msg = $e->getMessage();
                }    
            }
            

            public function get_event_by_id($id = null)
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


            public function update($id, $eventTitle2, $eventLink2, $eventLocation2, $eventPhoto2, $eventStartDate2, $eventEndDate2, $eventStory2)
            { 
                global $image_uploader, $database;


                // Remove the "T" from the dateTime String
                   $eventStartDate2 = str_replace("T", " ", $eventStartDate2);
                   $eventEndDate2   = str_replace("T", " ", $eventEndDate2);

                
                 # No photo update # Update DB without photo
                if (empty($eventPhoto2["name"])) {
                    try{
                        $sql = "UPDATE $this->table_name SET eventTitle = :eventTitle2, eventLink = :eventLink2,  eventLocation = :eventLocation2,
                                startDate = :eventStartDate2, endDate = :eventEndDate2, eventStory = :eventStory2  WHERE id = :id ";
                        $update = $database->db->prepare($sql);
                        $update->bindParam(':eventTitle2',      $eventTitle2);
                        $update->bindParam(':eventLink2',       $eventLink2);
                        $update->bindParam(':eventLocation2',   $eventLocation2);
                        $update->bindValue(':eventStartDate2',  strtotime($eventStartDate2));
                        $update->bindValue(':eventEndDate2',    strtotime($eventEndDate2));
                        $update->bindParam(':eventStory2',      $eventStory2);
                        $update->bindParam(':id', $id);
                        return ($update->execute() === true) ? true : false;
                    }catch(Expection $e){
                        $this->error_msg = $e->getMessage();
                    }     
                } 

                else if (!empty($eventPhoto2)){
                 
                 #  An update With a photo
                   
                     # 1. Upload the photo to the server
                      $uploadPhoto =  $image_uploader->upload_single_photo($eventPhoto2, $this->photo_path);
                      if($uploadPhoto == false) {echo "Photo Upload failed"; exit;}

                     // New Image path R = Renamed
                        $eventPhotoR = $this->photo_db_path.$uploadPhoto; 
                     
                        try{
                            $sql = "UPDATE $this->table_name SET eventPhoto = :eventPhotoR, eventTitle = :eventTitle2, eventLink = :eventLink2, eventLocation = :eventLocation2,
                            startDate = :eventStartDate2, endDate = :eventEndDate2, eventStory = :eventStory2  WHERE id = :id ";
                            $update = $database->db->prepare($sql);
                            $update->bindParam(':eventPhotoR',      $eventPhotoR);
                            $update->bindParam(':eventTitle2',      $eventTitle2);
                            $update->bindParam(':eventLink2',       $eventLink2);                            
                            $update->bindParam(':eventLocation2',   $eventLocation2);
                            $update->bindValue(':eventStartDate2',  strtotime($eventStartDate2));
                            $update->bindValue(':eventEndDate2',    strtotime($eventEndDate2));
                            $update->bindParam(':eventStory2',      $eventStory2);
                            $update->bindParam(':id', $id);
                            return ($update->execute() === true) ? true : false;
                        }catch(Expection $e){
                            $this->error_msg = $e->getMessage();
                        }     

                }
                

            } 
            
            

  }

  $event = new Event();
  
?>
