<?php
ob_start();
session_start();


//database credentials
define('DBHOST','localhost');
define('DBUSER','mgrace');
define('DBPASS','Soriano');
define('DBNAME','missyfeasts');

//application address
define('DIR','http://localhost:8081/blogsample/login/');
define('SITEEMAIL','missyfeasts@gmail.com');

try {

	//create PDO connection
	$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}
function __autoload($class) {

    $class = strtolower($class);

    //if call from within assets adjust the path
    $classpath = 'classes/class.'.$class . '.php';
    if ( file_exists($classpath)) {
        require_once $classpath;
    }

    //if call from within admin adjust the path
    $classpath = '../classes/class.'.$class . '.php';
    if ( file_exists($classpath)) {
        require_once $classpath;
    }

    //if call from within admin adjust the path
    $classpath = '../../classes/class.'.$class . '.php';
    if ( file_exists($classpath)) {
        require_once $classpath;
    }

}

//include the user class, pass in the database connection
include('classes/user.php');
include('classes/phpmailer/mail.php');
$user = new User($db);
?>
