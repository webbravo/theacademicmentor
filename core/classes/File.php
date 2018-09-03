<?php
  class File{

    private $supportted_format = ['image/jpg','image/jpeg', 'image/png', 'mp4']; 
   
    private function resizeImage($target, $newcopy, $w, $h, $ext)
    {
        # code...
        list($w_orig, $h_orig) = getimagesize($target);
        $scale_ratio = $w_orig / $h_orig;

        if (($w / $h) > $scale_ratio) {
              $w = $h * $scale_ratio;
        } else {
              $h = $w / $scale_ratio;
        }

        $img = "";
        $ext = strtolower($ext);

        if ($ext == "gif"){ 
          $img = imagecreatefromgif($target);
        } else if($ext =="png"){ 
          $img = imagecreatefrompng($target);
        } else { 
          $img = imagecreatefromjpeg($target);
        }

        $tci = imagecreatetruecolor($w, $h);
        // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
        imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
        $imageJpeg = imagejpeg($tci, $newcopy, 80);
        if($imageJpeg == true){
           return true;
        }else{
          echo $target."<br/>";
          echo $newcopy."<br/>";
          echo $w."<br/>";
          echo $h."<br/>";
          echo $ext."<br/>";
          exit;
           
        }
    }

    public function upload_single_photo($file, $path){
        # 1. First Check is if the Image is Actually a Jpeg Image
        # 2. We want check the File Size
        # 3. Sanitize the File with prep_value
        # 4. Update photo field of the User_id/ Driver_id
          
          $type = $file['type'] ;
          $size = $file['size'] / 1024;
          $name = $file['name'];
          $tmp  = $file['tmp_name'];
          $max_file_size = 4000; # 2MB
 
          if(count($file['name']) > 0){
                  
            if(in_array($type, $this->supportted_format) && $size <= $max_file_size){
                  # File Supported
                  $photoRenamed =  time().md5_file($tmp).$name;
                  //echo $path.$photoRenamed; exit;
                if(move_uploaded_file($tmp, $path.$photoRenamed) == true){
                   return $photoRenamed;
                }
                else{
                   return false;
                }
            }
            else{
              return false;
            }

          }

    }



    public function upload_multiple_photo($photos, $path){
      # code...
        if(isset($photos)){

          // Create a new foldr with the Merchant's id, to store his product photo 

            $type  = $photos['type'];
            $size  = $photos['size'] / 1024;
            $photo = $photos['name'];
            $tmp   = $photos['tmp_name'];
            $max_file_size = 2000; # 2MB   

              $num  = count($tmp);

              for ($i=0; $i < $num; $i++) { 
                  # code...
                   // check if there is a file in the array
                   if(!is_uploaded_file($tmp[$i])){
                        echo "No file upload";
                    }else{
                        
                        if(in_array($type[$i], $this->supportted_format) && $size[$i] <= $max_file_size){

                             //SINCE THE FILE IS SUPPORTED & FILE IS <= 2mb WE UPLOAD. 
                             $move_file = move_uploaded_file($tmp[$i], $path.time().$photo[$i]);  
                               if($move_file == true){
                                  // Get all the Other product details
                                   echo "File Uploaded!";
                               }
                        }
                   
                    }
                

              } // For loop
           
        }
    }   



}

  $image_uploader = new File();
?>