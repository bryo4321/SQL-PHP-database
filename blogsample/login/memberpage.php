

<?php require('includes/config.php'); 

//if not logged in redirect to login 
if(!$user->is_logged_in()){ header('Location: login.php'); } 

//define page title
$title = 'Members Page';

//include header template
require('layout/header.php'); 

?>

 
  


<div class="container">

	<div class="row">
		<form role="form" method="post" action="" autocomplete="off">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			
				<h2>Member only page - Welcome <?php echo $_SESSION['username']; echo $data ?></h2>
				<p><a href='logout.php'>Logout</a></p>
				<hr>
		</div>
			<div class="form-group">
				</div>	
					</div>	

<center>
<?php
$action=$_REQUEST['action'];
if ($action=="")    /* display the contact form */
    {
    ?>
    <form  action="" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="action" value="submit">
    Your name:<br>
    <input name="name" type="text" value="" size="30"/><br>
    Your email:<br>
    <input name="email" type="text" value="" size="30"/><br>
    Your message:<br>
    <textarea name="message" rows="7" cols="30"></textarea><br>
    <input type="submit" value="Send email"/>
    </form>
    <?php
    } 
else                /* send the submitted data */
    {
    $cName=$_POST['name'];
    $cEmail=$_POST['email'];
    $message=$_POST['message'];
    if (($cName=="")||($cEmail=="")||($message==""))
        {
        echo "All fields are required, please fill <a href=\"\">the form</a> again.";
        }
    else{        
      
			$subject = "Contact Inquiry";
			

			$mail = new Mail();
			$mail->setFrom(SITEEMAIL);
			$mail->addAddress(SITEEMAIL);
			$mail->subject($subject);
			$mail->body($message."\n".$cEmail."\n".$cName);
			$mail->send();
			echo "Email sent, expect a reply soon!";
        }
    }  
?>

<?php 
//include header template
require('layout/footer.php'); 
?>

