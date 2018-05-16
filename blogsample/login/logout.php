<?php require('includes/config.php');

//logout
$user->logout(); 

//logged in return to index
header('Location: index.php');
exit;
?>