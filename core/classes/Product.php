<?php 
   class Product
   {
       // Add Product
       // Edit Product
       // View Product
       // Delete Product
       
       private   $error_msg;
       public    $table_name     = "products";
       public    $photo_path     =  SITE_ROOT."/"."public"."/"."admin"."/"."uploads"."/"."products"."/"; 
       public    $photo_db_path  = "admin"."/"."uploads"."/"."products"."/";

       public function validate($product_name, $description)
       {
           # code...
           $product_name = strlen($product_name); 
           $description  = strlen($description);

           if ($product_name >= 200) {
               return "Name too Long";
           }else if($product_name <= 10){
               return "Name too short";
           } elseif ($description < 20) {
               return "Product description too short";
           }
       }

 

       public function add($product_name, $product_type, $brand, $price, $product_photo, $description)
       {

            global $image_uploader;
            global $database;

            // Try to upload the Photo to the Webserver and Return the Photo's new name
                $uploadPhoto =  $image_uploader->upload_single_photo($product_photo, $this->photo_path);
                if($uploadPhoto == false) {echo "Photo Upload failed"; exit;}

            // New Image path R = Renamed
                $productPhotoR = $this->photo_db_path.$uploadPhoto; 


           try
            {
                $sql = "INSERT INTO $this->table_name (name, product_type, brand, price, photo, description, created, modified, status)
                VALUES(:product_name, :product_type, :brand, :price, :productPhotoR, :description,  :created,  :modified, :status )";

                $add_product = $database->db->prepare($sql);
                
                $add_product->bindParam(":product_name",   $product_name);            
                $add_product->bindParam(":product_type",   $product_type);            
                $add_product->bindParam(":brand",          $brand);            
                $add_product->bindParam(":price",          $price);            
                $add_product->bindParam(":productPhotoR",  $productPhotoR);            
                $add_product->bindParam(":description",    $description);            
                $add_product->bindValue(":created",        date("Y-m-d H:i:s", time() ) );  // 2018-06-27 01:06:00          
                $add_product->bindValue(":modified",       date("Y-m-d H:i:s", time() ) );            
                $add_product->bindValue(":status",         1);        
                
                // Check if the Product was added to the database.
                if($add_product->execute() === true){
                    return true;
                }else{
                    return false; 
                }
            }catch(Expection $e){
                $this->error_msg = $e->getMessage();
            }

       }



       public function update($id, $product_name, $product_type, $brand, $price, $product_photo, $description)
       {                 
           global $image_uploader;
           global $database;
           
        //    echo $description; exit;
           # Update DB without photo
           if (empty($product_photo["name"])) {
               try{
                   $sql = "UPDATE $this->table_name SET name = :product_name, product_type = :product_type,
                    brand = :brand, price =:price,  description = :description, modified = :modified
                    WHERE id = :id ";
                   $update = $database->db->prepare($sql);
                   $update->bindParam(':product_name', $product_name);
                   $update->bindParam(':product_type', $product_type);
                   $update->bindParam(':brand',        $brand);
                   $update->bindParam(':price',        $price);
                   $update->bindParam(':description',  $description);
                   $update->bindValue(':modified',  date("Y-m-d H:i:s", time() ) );
                   $update->bindParam(':id',  $id);
                //    echo $sql; exit;
                   return ($update->execute() === true) ? true : false;
               }catch(Expection $e){
                   $this->error_msg = $e->getMessage();
               }     
           } 
           else if (isset($product_photo)){

              # 1. Upload the photo to the server
              $uploadPhoto =  $image_uploader->upload_single_photo($product_photo, $this->photo_path);
              if($uploadPhoto == false) {echo "Photo Upload failed"; exit;}

              // New Image path R = Renamed
               $productPhotoR = $this->photo_db_path.$uploadPhoto; 
               
               try{
                   $sql = "UPDATE $this->table_name SET name = :product_name, product_type = :product_type, brand = :brand, price = :price, photo = :photo, description = :description
                   WHERE id = :id ";
                   $update = $database->db->prepare($sql);
                   $update->bindParam(':product_name', $product_name);
                   $update->bindParam(':product_type', $product_type);
                   $update->bindParam(':brand',        $brand);
                   $update->bindParam(':price',        $price);
                   $update->bindParam(':photo',        $productPhotoR);
                   $update->bindParam(':description',  $description);
                   $update->bindValue(':modified',     date("Y-m-d H:i:s", time() ) );
                   $update->bindParam(':id', $id);
                   return ($update->execute() === true) ? true : false;
               }catch(Expection $e){
                   $this->error_msg = $e->getMessage();
               }     

           }
           

       } 


       public function count_product()
       { 
            global $database;
            try{
                $select          = "SELECT COUNT(id) FROM $this->table_name ";
                $result_set      =  $database->db->query($select); 
                $numbers_of_product =  $result_set->fetch();
                return !empty($numbers_of_product) ? array_shift($numbers_of_product) : false;
                //Check for error from the Query
                $errorInfo = $result_set->errorInfo(); if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
            }catch(Expection $e){
                $this->error_msg = $e->getMessage();
            }    
       }


       public function count_product_by_type($type)
       { 
            global $database;
            try{
                $select          = "SELECT COUNT(id) FROM $this->table_name WHERE product_type = '{$type}' ";
                $result_set      =  $database->db->query($select); 
                $numbers_of_product =  $result_set->fetch();
                return !empty($numbers_of_product) ? array_shift($numbers_of_product) : false;
                //Check for error from the Query
                $errorInfo = $result_set->errorInfo(); if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
            }catch(Expection $e){
                $this->error_msg = $e->getMessage();
            }    
       }


       public function get_all($pagination)
       {
           global $database;
           try{
              //Build Query String
                $select_product  = "SELECT * FROM $this->table_name ORDER BY id DESC LIMIT {$pagination->per_page} OFFSET {$pagination->offset()} ";
                $select_product  = $database->db->query($select_product);
              //Check for error from the Query
                $errorInfo = $select_product->errorInfo();
                if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
             //$select_product->fetch();
                if($select_product) return $select_product;
           }catch(Expection $e){
                $this->error_msg = $e->getMessage();
           }
              
       }


       public function get_product_by_type($type, $pagination)
       {
           global $database;
           try{
              //Build Query String
                $select_product  = "SELECT * FROM $this->table_name WHERE product_type = '{$type}' ORDER BY id DESC LIMIT {$pagination->per_page} OFFSET {$pagination->offset()} ";
                $select_product  = $database->db->query($select_product);
              //Check for error from the Query
                $errorInfo = $select_product->errorInfo();
                if(isset($errorInfo[2])) $this->error_msg = $errorInfo[2];
             //$select_product->fetch();
                if($select_product) return $select_product;
           }catch(Expection $e){
                $this->error_msg = $e->getMessage();
           }
              
       }


       public function get_product_by_id($id = null)
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



   }
   

   $product = new Product();
?>