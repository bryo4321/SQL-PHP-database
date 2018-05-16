<?php //include config
require_once('../includes/config.php');

//if not logged in redirect to login page
//if(!$user->is_logged_in()){ header('Location: login.php'); }


?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Add Food Review</title>
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
	<p><a href="admin/food.php">Food Review Admin Index</a></p>

	<h2>Add Food Review</h2>

	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		$_POST = array_map( 'stripslashes', $_POST );

		//collect form data
		extract($_POST);

		//very basic validation
		if($foodTitle ==''){
			$error[] = 'Please enter the title.';
		}

		if($foodDesc ==''){
			$error[] = 'Please enter the description.';
		}

		if($foodCont ==''){
			$error[] = 'Please enter the content.';
		}
		
		if($foodZip ==''){
		$error[] = 'Please enter the zip code.';
		}

		if(!isset($error)){

			try {

				//insert into database
				$stmt = $db->prepare('INSERT INTO food_reviews (foodTitle,foodDesc,foodCont,foodDate, foodZip) VALUES (:foodTitle, :foodDesc, :foodCont, :foodDate, 
				:foodZip)') ;
				$stmt->execute(array(
					':foodTitle' => $foodTitle,
					':foodDesc' => $foodDesc,
					':foodCont' => $foodCont,
					':foodDate' => date('Y-m-d H:i:s'),
					':foodZip' => $foodZip
				));

				//redirect to index page
				header('Location: food.php?action=added');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo '<p class="error">'.$error.'</p>';
		}
	}
	?>

	<form action='' method='post'>

		<p><label>Title</label><br />
		<input type='text' name='foodTitle' value='<?php if(isset($error)){ echo $_POST['foodTitle'];}?>'></p>

		<p><label>Description</label><br />
		<textarea name='foodDesc' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['foodDesc'];}?></textarea></p>

		<p><label>Content</label><br />
		<textarea name='foodCont' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['foodCont'];}?></textarea></p>
		
		<p><label>Zip Code</label><br />
		<input type='int' name='foodZip' value='<?php if(isset($error)){ echo $_POST['foodZip'];}?>'></p>

		<p><input type='submit' name='submit' value='Submit'></p>

	</form>

</div>
