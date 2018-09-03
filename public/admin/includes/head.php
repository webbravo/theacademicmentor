<?php require_once("../../core/initialize.php");?>
<?php  if($session->is_logged_in() == false){ redirect_to("login.php"); }?>
<!DOCTYPE html>
<html lang="en">
  <head>
        <meta charset="utf-8" />
        <title><?php echo $page_title; ?> - The Academic Mentor </title>
        <meta http-equiv="refresh" content="<?php if(isset($redirect)){ echo $redirect; }?>">
        <meta name="keywords" content=" The Academic Mentor - Admin " />
        <meta name="description" content="" />
        <meta name="Author" content=" The Academic Mentor - Admin " />

        <!-- mobile settings -->
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

        <!-- WEB FONTS : use %7C instead of | (pipe) -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />

        <!-- CORE CSS -->
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/metis-menu/metisMenu.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/simple-line-icons-master/css/simple-line-icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/summernote.css" rel="stylesheet">
        <link href="assets/css/summernote-bs3.css" rel="stylesheet">


        <!-- THEME CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/theme/dark.css" rel="stylesheet" type="text/css" />

     
        <!-- PAGE LEVEL SCRIPTS -->

  </head>