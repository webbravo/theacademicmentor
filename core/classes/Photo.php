<?php 
require_once("constant.php");
//   This Product class
//   1. ADD 
//   2. FETCH
//   3. UPDATE 
//   4. DELETE etc

Class Photo extends File
  {
            public    $table_name            = "photoGallery";
            public    $slider_table          = "sliderphoto";

            public    $photo_path            =  SITE_ROOT."/"."public"."/"."admin"."/"."uploads"."/"."photographs"."/";
            public    $slider_photo_path     =  SITE_ROOT."/"."public"."/"."admin"."/"."uploads"."/"."sliders"."/";
            
            public    $photo_db_path  = "admin"."/"."uploads"."/"."photographs"."/";
            public    $slider_db_path  = "admin"."/"."uploads"."/"."sliders"."/";
            


            public function add($galleryPhoto){
                # THIS METHOD ADDS A PRODUCT
                   global $database;
                 
                // Try to upload the Photo to the Webserver and Return the Photo's new name
                   $uploadPhoto =  $this->upload_single_photo($galleryPhoto, $this->photo_path);
                   if($uploadPhoto == false) {echo "Photo Upload failed"; exit;}

                // New Image path
                    $galleryPhoto = $this->photo_db_path.$uploadPhoto; 
                
                // Insert Into the Database
                    $add_photo = "INSERT INTO $this->table_name (photoName) VALUES('$galleryPhoto' )";
                    //echo $add_photo; exit;
                // Check IF the Photo WAS ENTERED TO THE DATABASE
                    if($database->query($add_photo) == true){
                        return true;
                    }else{
                        return false;   
                    }
                        

            }


            public function addSliderPhoto($sliderPhoto){
                # THIS METHOD ADDS A PRODUCT
                   global $database;

                // Try to upload the Photo to the Webserver and Return the Photo's new name
                   $uploadPhoto =  $this->upload_single_photo($sliderPhoto, $this->slider_photo_path);
                   if($uploadPhoto == false) {
                       echo "Slider photo Upload failed "; 
                       exit;
                    }else{
                         // New Image path
                            $sliderPhoto = $this->photo_db_path.$uploadPhoto; 
                        
                        // Insert Into the Database
                            $add_slider = "INSERT INTO $this->slider_table(photoName) VALUES('$sliderPhoto' )";

                        // Check IF the Photo WAS ENTERED TO THE DATABASE
                            if($database->query($add_slider) == true){
                                return true;
                            }else{
                                return false; 
                            }
                    }

                        

            }
            
            

            public function count_photo(){

                # THIS METHOD COUNTS ALL THE UPCOMING EVENTS
                global $database;
                $select = "SELECT COUNT(*) FROM $this->table_name ";
                $numbers_of_photos   =  $database->query($select); 
                $numbers_of_photos  =   $database->fetch_array($numbers_of_photos);
                return !empty($numbers_of_photos) ? array_shift($numbers_of_photos) : false; 
            }

            
            
            public function get_all($pagination)
            {
                // GET ALL THE GALLERY PHOTOS

                global $database;   
                $select_event = " SELECT * FROM $this->table_name ORDER BY id DESC LIMIT {$pagination->per_page} OFFSET {$pagination->offset()} " ;
                $select_event = $database->query($select_event);

                // Return PHOTO Array
                   if($select_event == true) return $select_event; 
            }
            
            

            public function get_photo_by_id($id = null)
            {
                # REMEMBER THAT THE CLASS.EVENT EXTENDS THE DATABASE CLASS
                $var          =  $this->prep_value($id);
                $select       =  "SELECT * FROM $this->table_name WHERE id = '{$id}' ";
                $result       =  $this->query($select);
                $array_result =  $this->fetch_array($result);

                return  is_array($array_result) ? $array_result : false;
            }


           
            
            

  }

  $photo = new Photo();
  
?>
