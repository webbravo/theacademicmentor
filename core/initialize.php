<?php 
 // LOAD UP ALL THE CLASSESS & FUNCTIONS

 # Directory Separator for Windows or Linux 
defined("DS") ? null : DEFINE('DS', DIRECTORY_SEPARATOR);

# // Define the absolute paths to make sure that require_once works as expected
defined('SITE_ROOT') ? null : define('SITE_ROOT', 'E:'.DS.'xampp'.DS.'htdocs'.DS.'theAcademicMentor');  


// Define Core Function Directory
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'core');

// DEFINE THE CLASSES FOLDER
defined('CLASS_FOLDER') ? null : define('CLASS_FOLDER', LIB_PATH.DS.'classes');

// Auto Load al the classes

# 0. load config file first
require_once(CLASS_FOLDER.DS.'config.php');

// # 1. Require the session File
require_once(CLASS_FOLDER.DS."Session.php");

// # 2. Require the session File
require_once(LIB_PATH.DS."functions.php");

# 3. Require the database File
require_once(CLASS_FOLDER.DS."Database.php");

# 4. Require the BOOKING File
require_once(CLASS_FOLDER.DS."Booking.php");

# 5. Require the Messages File
require_once(CLASS_FOLDER.DS."Messages.php");

# 6. Require the Blog File
require_once(CLASS_FOLDER.DS."Blog.php");

# 7. Require the PHOTO File
require_once(CLASS_FOLDER.DS."File.php");

# 8. Require the Pagination File
require_once(CLASS_FOLDER.DS."Pagination.php");

# 9. THE GOOGLE API FILE File
require_once("google-api-php-client-2.2.1/vendor/autoload.php");

require_once("google-api-php-client-2.2.1/app/classes/GoogleAuth.php");

# 10. Require the Student File
require_once(CLASS_FOLDER.DS."Student.php");

# 11. Require the Video File
require_once(CLASS_FOLDER.DS."Video.php");

# 12. Require the Event File
require_once(CLASS_FOLDER.DS."Event.php");

# 13. Require the About File
require_once(CLASS_FOLDER.DS."About.php");

# 14. Require the Feedback File
require_once(CLASS_FOLDER.DS."Feedback.php");

# 15. Require the Admin File
require_once(CLASS_FOLDER.DS."Admin.php");

# 16. Require the Cart File
require_once(CLASS_FOLDER.DS."Cart.php");

# 17. Require the Product File
require_once(CLASS_FOLDER.DS."Product.php");

# 18. Require the Product File
require_once(CLASS_FOLDER.DS."Customer.php");

# 19. Require the Product File
require_once(CLASS_FOLDER.DS."Orders.php");