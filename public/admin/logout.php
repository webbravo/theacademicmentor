<?php require_once("../../core/functions.php"); ?>
<?php require_once("../../core/classes/Session.php"); ?>
<?php
		// Four steps to closing a session
		// (i.e. logging out)

		// 1. Find the session
		session_start();
		
		// 2. Unset all the session variables
		$_SESSION = array();
		

        // 3 unset the session vairable
		global $admin_id;
      
        $session->logout($admin_id);  
		// 3. Destroy the session cookie
		if(isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-42000, '/');
		}

		// 4. Destroy the session
		session_destroy();

		redirect_to("login.php");
		
		
?>