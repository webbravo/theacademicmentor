<?php 

Class Blog
{         

            private   $error_msg;
            public    $table_name     = "blog";
            public    $photo_path     =  SITE_ROOT."/"."public"."/"."admin"."/"."uploads"."/"."blog"."/"; 
            public    $photo_db_path  = "admin"."/"."uploads"."/"."blog"."/";


            public function validate($blogTitle, $blogStory)
            {
                # code...
                $title_len = strlen($blogTitle); 
                $story_len = strlen($blogStory);

                if ($title_len >= 200) {
                    return "titleTooLong";
                }else if($title_len <= 10){
                    return "titleTooShort";
                } elseif ($story_len < 20) {
                    return "storyTooShort";
                }
            }


            public function add($blogTitle, $blogPhoto, $blogStory)
            {
                # THIS METHOD ADDS A BLOG POST
                  global $database;
                  global $image_uploader;
                 
                // Try to upload the Photo to the Webserver and Return the Photo's new name
                  $uploadPhoto =  $image_uploader->upload_single_photo($blogPhoto, $this->photo_path);
                  if($uploadPhoto == false) {echo "Photo Upload failed"; exit;}

                // New Image path R = Renamed
                  $blogPhotoR = $this->photo_db_path.$uploadPhoto; 
                   
                try{  
                      // Insert Into the Database
                      $sql = "INSERT INTO $this->table_name (blogPhoto, blogTitle, blogStory, dateAdded)
                               VALUES(:blogPhoto, :blogTitle, :blogStory, :dateAdded )";
                      $insert = $database->db->prepare($sql);
                      $insert->bindParam(':blogPhoto', $blogPhotoR);     
                      $insert->bindParam(':blogTitle', $blogTitle);     
                      $insert->bindParam(':blogStory', $blogStory);
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
                     $select_blog = "SELECT * FROM $this->table_name ORDER BY id DESC LIMIT {$pagination->per_page} OFFSET {$pagination->offset()} ";
                     $select_blog = $database->db->query($select_blog);
                   //Check for error from the Query
                     $errorInfo = $select_blog->errorInfo();
                     if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
                  //$select_blog->fetch();
                     if($select_blog) return $select_blog;
                }catch(Expection $e){
                     $this->error_msg = $e->getMessage();
                }
                   
            }
            
            

            public function count_blog()
            { 
                global $database;
                
                try{
                    $select          = "SELECT COUNT(id) FROM $this->table_name ";
                    $result_set      =  $database->db->query($select); 
                    $numbers_of_post =  $result_set->fetch();
                    return !empty($numbers_of_post) ? array_shift($numbers_of_post) : false;
                    //Check for error from the Query
                    $errorInfo = $result_set->errorInfo(); if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
                }catch(Expection $e){
                    $this->error_msg = $e->getMessage();
                }    
            }
            

            public function get_blog_by_id($id = null)
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


            public function getFeaturedPost()
            {
                global $database;
                try{
                    $sql     =  "SELECT * FROM $this->table_name ORDER BY RAND() LIMIT 1";
                    $select  =  $database->db->prepare($sql);
                    // $select->bindParam(':id', $id);
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


            public function update($id, $blogTitle2, $blogPhoto2, $blogStory2)
            {                 
                global $image_uploader;
                global $database;
                

                # Update DB without photo
                if (empty($blogPhoto2["name"])) {
                    try{
                        $sql = "UPDATE $this->table_name SET blogTitle = :blogTitle2, blogStory = :blogStory2 WHERE id = :id ";
                        $update = $database->db->prepare($sql);
                        $update->bindParam(':blogTitle2', $blogTitle2);
                        $update->bindParam(':blogStory2', $blogStory2);
                        $update->bindParam(':id', $id);
                        return ($update->execute() === true) ? true : false;
                    }catch(Expection $e){
                        $this->error_msg = $e->getMessage();
                    }     
                } 
                else if (isset($blogPhoto2)){

                   # 1. Upload the photo to the server
                   $uploadPhoto =  $image_uploader->upload_single_photo($blogPhoto2, $this->photo_path);
                   if($uploadPhoto == false) {echo "Photo Upload failed"; exit;}

                   // New Image path R = Renamed
                    $blogPhotoR = $this->photo_db_path.$uploadPhoto; 

                    try{
                        $sql = "UPDATE $this->table_name SET blogPhoto = :blogPhotoR, blogTitle = :blogTitle2, blogStory = :blogStory2 WHERE id = :id ";
                        $update = $database->db->prepare($sql);
                        $update->bindParam(':blogPhotoR', $blogPhotoR);
                        $update->bindParam(':blogTitle2', $blogTitle2);
                        $update->bindParam(':blogStory2', $blogStory2);
                        $update->bindParam(':id', $id);
                        return ($update->execute() === true) ? true : false;
                    }catch(Expection $e){
                        $this->error_msg = $e->getMessage();
                    }     

                }
                

            } 
            
            
            // public function getProductDetails($product_id, $merchant_id ){
            //     # THIS METHOD FETCH A PRODUCT AND RETURN IT AS A PRODUCT OBJECT.
                   
            //        global $database;
                   
            //       if(!isset($product_id) && empty($merchant_id) ) echo "Not Product for the Merchant"; 
            //          $product_id  = (int)$product_id;
            //          $merchant_id = (int)$merchant_id;

            //          $select_product = "SELECT * FROM $this->table_name 
            //                            WHERE id = '$product_id' AND merchant_id = '$merchant_id'  LIMIT 1  "; 

            //          $select_product = $database->query($select_product);  
            //          if($select_product == true) return $database->fetch_array( $select_product );                
            // }

            // public function filter_product_list ($name, $price, $brandname, $stock, $merchant_id, $status, $pagination){
            //     # THIS METHOD FETCH A MERCHANT'S PRODUCT by Certain QUERY.

            //     global $database;
                
            //     if(!isset($merchant_id) || intval($merchant_id) == 0 || empty($merchant_id) ){
            //         die(" INVALID MERCHANT KEY: NULL ID ");
            //     }


            //         $filtered_list = "SELECT * FROM $this->table_name INNER JOIN product_photo ON products.id = product_photo.product_id";
            //                 $conditions = array();
            //                 if($name !="") {
            //                     $conditions[] = "name='$name'";
            //                 }
            //                 if($price !="" && $price != 0) {
            //                     $conditions[] = "price='$price'";
            //                 }
            //                 if($brandname !="") {
            //                     $conditions[] = "brandname='$brandname'";
            //                 }
            //                 if($stock !="") {
            //                     $conditions[] = "stock='$stock'";
            //                 }
            //                 if($status !="" && $status != 'Choose') {
            //                     $conditions[] = "status='$status'";
            //                 }
                        
            //             if(count($conditions) > 0){
            //                 $filtered_list .= " WHERE merchant_id =  '$merchant_id' AND  ". implode(' OR ', $conditions) .
            //                                   " LIMIT {$pagination->per_page} OFFSET {$pagination->offset()} "  ;
            //                 // echo $filtered_list; exit;
            //             }
                        
            //     $product_result = $database->query($filtered_list); 
            //     return $product_result; 
            // } 


            // public function count_filtered_product_list ($name, $price, $brandname, $stock, $merchant_id, $status){
            //     # THIS METHOD FETCH A MERCHANT'S PRODUCT by Certain QUERY.

            //     global $database;
                
            //     if(!isset($merchant_id) || intval($merchant_id) == 0 || empty($merchant_id) ){
            //         die(" INVALID MERCHANT KEY: NULL ID ");
            //     }


            //         $filtered_list = "SELECT * FROM $this->table_name INNER JOIN product_photo ON products.id = product_photo.product_id";
            //                 $conditions = array();
            //                 if($name !="") {
            //                     $conditions[] = "name='$name'";
            //                 }
            //                 if($price !="" && $price != 0) {
            //                     $conditions[] = "price='$price'";
            //                 }
            //                 if($brandname !="") {
            //                     $conditions[] = "brandname='$brandname'";
            //                 }
            //                 if($stock !="") {
            //                     $conditions[] = "stock='$stock'";
            //                 }
            //                 if($status !="" && $status != 'Choose') {
            //                     $conditions[] = "status='$status'";
            //                 }
                        
            //             if(count($conditions) > 0){
            //                 $filtered_list .= " WHERE merchant_id =  '$merchant_id' AND  ". implode(' OR ', $conditions) ;
                                            
            //                 //echo $filtered_list; exit;
            //             }
                        
            //     $product_result = $database->query($filtered_list); 
            //     return $database->num_rows($product_result); 
            // } 

            
            // public function get_merchant_product ($merchant_id, $pagination){
            //     # THIS METHOD FETCH A MERCHANT'S PRODUCT AND RETURN IT AS A PRODUCT OBJECT.

            //     global $database;

            //     if(!isset($merchant_id) || intval($merchant_id) == 0 || empty($merchant_id) ){
            //         die(" INVALID MERCHANT KEY: NULL ID ");
            //     }

               
            //     $select = "SELECT DISTINCT * FROM (  SELECT * FROM $this->table_name INNER JOIN product_photo 
            //                ON products.id = product_photo.product_id
            //                WHERE merchant_id =  '$merchant_id' ORDER BY products.id DESC  LIMIT {$pagination->per_page}
            //                OFFSET {$pagination->offset()}) AS Arch GROUP BY product_id";

                            
            //   /* $select = "SELECT * FROM $this->table_name INNER JOIN product_photo 
            //                 ON products.id     = product_photo.product_id
            //                 WHERE merchant_id  =  '$merchant_id' 
            //                 ORDER BY products.id DESC  
            //                 LIMIT {$pagination->per_page} 
            //                 OFFSET {$pagination->offset()}"; */

            //     $product_result = $database->query($select); 
            //     return $product_result; 
            // }


            // public function update_product ($product_info = array(), $id)
            // {
            //     # THIS METHOD UPDATES A PRODUCT AND RETURN A BOOL.
                
            // }

            // public function delete_product ($id)
            // {
            //     # THIS METHOD DELETE A PRODUCT AND RETURN A BOOL.
                
                
            // }
            
  }

  $blog = new Blog();
  
?>
