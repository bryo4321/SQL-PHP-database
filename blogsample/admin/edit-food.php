<?php //include config
require_once('../includes/config.php');

//if not logged in redirect to login page
//if(!$user->is_logged_in()){ header('Location: login.php'); }

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Edit Post</title>
  <link rel="stylesheet" href="../style/normalize.css">
  <link rel="stylesheet" href="../style/main.css">
  <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
  <script>
          tinymce.init({
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
  </script>
</head>
<body>

<div id="wrapper">

	<?php include('menu.php');?>
	<p><a href="admin/food_reviews.php">Food Review Admin Index</a></p>

	<h2>Edit Food Review</h2>

	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		$_POST = array_map( 'stripslashes', $_POST );

		//collect form data
		extract($_POST);

		//very basic validation
		if($foodID ==''){
			$error[] = 'This post is missing a valid id!.';
		}

		if($foodTitle ==''){
			$error[] = 'Please enter the title.';
		}

		if($foodDesc ==''){
			$error[] = 'Please enter the description.';
		}

		if($foodCont ==''){
			$error[] = 'Please enter the content.';
		}

		if(!isset($error)){

			try {

				//insert into database
				$stmt = $db->prepare('UPDATE food_reviews SET foodTitle = :foodTitle, foodDesc = :foodDesc, foodCont = :foodCont, foodZip = :foodZip WHERE foodID = :foodID') ;
				$stmt->execute(array(
					':foodTitle' => $foodTitle,
					':foodDesc' => $foodDesc,
					':foodCont' => $foodCont,
					':foodID' => $foodID,
					':foodZip' => $foodZip
				));

				//redirect to index page
				header('Location: food.php?action=updated');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	?>


	<?php
	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo $error.'<br />';
		}
	}

		try {

			$stmt = $db->prepare('SELECT foodID, foodTitle, foodDesc, foodCont FROM food_reviews WHERE foodID = :foodID') ;
			$stmt->execute(array(':foodID' => $_GET['id']));
			$row = $stmt->fetch(); 

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}

	?>

	<form action='' method='post'>
		<input type='hidden' name='foodID' value='<?php echo $row['foodID'];?>'>

		<p><label>Name</label><br />
		<input type='text' name='foodTitle' value='<?php echo $row['foodTitle'];?>'></p>

		<p><label>Address & Description</label><br />
		<textarea name='foodDesc' cols='60' rows='10'><?php echo $row['foodDesc'];?></textarea></p>

		<p><label>Content</label><br />
		<textarea name='foodCont' cols='60' rows='10'><?php echo $row['foodCont'];?></textarea></p>
		
		<p><label>Zip Code</label><br />
		<input type='int' name='foodZip' value='<?php if(isset($error)){ echo $_POST['foodZip'];}?>'></p>

		<p><input type='submit' name='submit' value='Update'></p>

	</form>

</div>

</body>
</html>	


