<?php
ob_start();
session_start();

//database credentials
define('DBHOST','localhost');
define('DBUSER','mgrace');
define('DBPASS','Soriano');
define('DBNAME','missyfeasts');

$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


date_default_timezone_set('America/Chicago');


function __autoload($class) {
   
   $class = strtolower($class);


   $classpath = 'classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
    }     
    

   $classpath = '../classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
    }
    

   $classpath = '../../classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
    }         
     
}

$user = new User($db); 
?>