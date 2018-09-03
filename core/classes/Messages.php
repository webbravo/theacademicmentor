<?php 
  
 /**
  * MESSAGE 
  */
 class Messages 
 {
        private $table_name = "messages";

        public function sendmail($useremail, $subject, $body )
        {
            # code...

               global $mail;

              //echo $useremail." " . $subject." ". $body; exit;

                $email = 'no-reply@dachmarket.com';
                $name  = 'Dach Market Admin';

                // SMTP SETTINGS
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPSecure = 'tls';    // Enable TLS encryption
                // $mail->Port = 587;    
                $mail->Username = "4natcom@gmail.com";
                $mail->Password = "hi2nate1992";
                // Also Remember to Change the STMP to Web Server Setting; 
                
                // Set Reply eMail Address
                 # $mail->addReplyTo('raj.amalw@gmail.com', 'Raj Amal W');
                
                // Set Word Wrap 
                 # $mail->WordWrap = 50;

                // Type of email
                $mail->isHTML(true);

                // Set where we are Sending the email to
                $mail->addAddress($useremail);

                //Set who is sending the email 
                $mail->setFrom($email, $name);

                // Set email Subject 
                $mail->Subject = $subject;

             

                // The email body  
                $mail->Body = $body;



                if($mail->Send() == true){
                     //echo "The Mail was sent"; exit;
                    return true;
                
                }else{
                    //  echo "The Mail was not sent <br/>"; 
                    //  echo 'Mailer Error: ' . $mail->ErrorInfo;
                    //  exit;
                    return false;
                }


        }

        public function sendsms($sms_msg, $phone){
          # We want to send this $phone(Number) this Message  
             return true;
                if(!empty($sms_msg) && !empty($phone)){
                    # Now we can confidently Send the User the The Msg
                    
                    //  http://api.bulksmsvilla.com/?type=send-sms&email=muyicks@gmail.com&sub-account=dachmarket&subaccount-password=baller&sender-id=Dachmarket&message=Testing&phone-number=2347069659429&msg-type=1

                    // Set the attributes for the SMS API
                        $type     = "send-sms";
                        $email  = "muyicks@gmail.com";
                        $sub_account = "dachmarket";
                        $subaccount_password = "baller";
                        $sender_id      = "Dachmarket";
                        $sms_msg;
                        $phone_number =  trim($phone);
                        $msg_type = 1;
                        // Build the URL to send the message to. Make sure the 
                        // message text and Sender ID are URL encoded. You can
                        // use HTTP or HTTPS
                    $sms_api = "http://api.bulksmsvilla.com/?" .
                            "type=" . $type . "&" .
                            "email=" . $email . "&" .
                            "sub-account="  . $sub_account . "&" .
                            "subaccount-password=" . $subaccount_password . "&" .
                            "sender-id="  . $sender_id . "&" .
                            "message="  . urlencode($sms_msg) . "&" .
                            "phone-number=" . urlencode($phone_number) . "&" .
                            "msg-type="       . $msg_type;

                
                        //  create a new cURL resource
                                $ch = curl_init($sms_api);
                        
                        // set URL and other appropriate options
                            curl_setopt($ch, CURLOPT_URL, $sms_api);
                    
                        // We want to return the data we got
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                            curl_setopt($ch, CURLOPT_HEADER, 0);

                        // grab URL and pass it to the browser
                            $reponse = curl_exec($ch);
                    
                        // Checking what our transfer was [OK] 1 2349055144202
                        if(!curl_error($ch)){
                                return true; //$message = "SMS verification code was Sent to ".$phone;
                        }else{
                                echo "We have a cURL Error ".curl_error($ch);
                                exit();
                        }
                        // close cURL resource, and free up system resources
                            curl_close($ch);

                }


        }
     
 }

 $message = new Messages();
 
?>