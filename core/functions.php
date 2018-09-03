<?php

function strip_zeros_from_date( $marked_string="" ) {
  // first remove the marked zeros
  $no_zeros = str_replace('*0', '', $marked_string);
  // then remove any remaining marks
  $cleaned_string = str_replace('*', '', $no_zeros);
  return $cleaned_string;
}



function redirect_to( $location = NULL ) {
     
   if ($location != NULL && !headers_sent()) {
       header("Location: {$location}");
       exit;
    }
    /* else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$location.'";';
        echo '</script>';
   } */
}


function output_message($message="") {
  if (!empty($message)) { 
    return "<p class=\"message\">{$message}</p>";
  } else {
    return "";
  }
}


function hasValue($tested_variable)
{
  # code...
    if(isset($tested_variable) && !empty($tested_variable)){
       return true;
    }else{
       return false; 
    }
}



   

    function time_ago( $time )
    {
        define( TIMEBEFORE_NOW,         'now' );
        define( TIMEBEFORE_MINUTE,      '{num} minute ago' );
        define( TIMEBEFORE_MINUTES,     '{num} minutes ago' );
        define( TIMEBEFORE_HOUR,        '{num} hour ago' );
        define( TIMEBEFORE_HOURS,       '{num} hours ago' );
        define( TIMEBEFORE_YESTERDAY,   'yesterday' );
        define( TIMEBEFORE_FORMAT,      '%e %b' );
        define( TIMEBEFORE_FORMAT_YEAR, '%e %b, %Y' );

        $out    = ''; // what we will print out
        $now    = time(); // current time
        $diff   = $now - $time; // difference between the current and the provided dates

        if( $diff < 60 ) // it happened now
            return TIMEBEFORE_NOW;

        elseif( $diff < 3600 ) // it happened X minutes ago
            return str_replace( '{num}', ( $out = round( $diff / 60 ) ), $out == 1 ? TIMEBEFORE_MINUTE : TIMEBEFORE_MINUTES );

        elseif( $diff < 3600 * 24 ) // it happened X hours ago
            return str_replace( '{num}', ( $out = round( $diff / 3600 ) ), $out == 1 ? TIMEBEFORE_HOUR : TIMEBEFORE_HOURS );

        elseif( $diff < 3600 * 24 * 2 ) // it happened yesterday
            return TIMEBEFORE_YESTERDAY;

        else // falling back on a usual date format as it happened later than yesterday
            return strftime( date( 'Y', $time ) == date( 'Y' ) ? TIMEBEFORE_FORMAT : TIMEBEFORE_FORMAT_YEAR, $time );
    }


    function checkid($id)
    {
       # code...
      switch ($id) {
          case !isset($id):
              return false;
              break;
         case empty($id):
              return false;
              break;     
          case !is_numeric($id):
              return false;
              break;
          case strlen($id) > 5:
              return false;
              break;    
          default:
              # code...
              return true;
              break;
      }
    }


    function autoloader($classname){
        $class_name = strtolower($classname);
        $path = LIB_PATH.DS."{$class_name}.php";
        if(file_exists($path)){
            require_once($path);
        }else{
            die("The File <strong>{$class_name}.php</strong> could not be Found");
        }
    }

spl_autoload_register('autoloader');






?>