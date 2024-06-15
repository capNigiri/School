<?php
/**
 * init.php
 *
 * Initialization file
 *
 * @version    1.2 2011-02-03
 * @package    Smithside Auctions
 * @copyright  Copyright (c) 2011 Smithside Auctions
 * @license    GNU General Public License
 * @since      Since Release 1.0
 */
 // starts new or resumes existing session
//define('MAGIC_QUOTES_ACTIVE', get_magic_quotes_gpc()); 
// include required files
require_once 'includes/functions.php';

// Initialize message coming in

 

/**
 * Auto load the class files
 * @param string $class_name
 */
  function myautoloader($class_name) {
      try {
          $class_file = 'includes/classes/' . strtolower($class_name) . '.php';
          if (is_file($class_file)) {
              require_once $class_file;
          } else {
              throw new Exception("Unable to load class $class_name in file $class_file.");
          }
      } catch (Exception $e) {
          echo 'Exception caught: ',  $e->getMessage(), "\n";
      }
  }
  spl_autoload_register('myautoloader');
  
  session_start();
  
  $message = '';
  
  if (isset($_SESSION['message'])) {
  $message = htmlentities($_SESSION['message']);
  unset($_SESSION['message']);
}