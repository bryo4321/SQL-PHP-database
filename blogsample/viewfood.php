<?php require('includes/config.php'); 

$stmt = $db->prepare('SELECT foodID, foodTitle, foodCont, foodDate FROM food_reviews WHERE foodID = :foodID');
$stmt->execute(array(':foodID' => $_GET['id']));
$row = $stmt->fetch();

//if post does not exists redirect user.
if($row['foodID'] == ''){
	header('Location: ./food.index.php');
	exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Food Reviews -<?php echo $row['foodTitle'];?></title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

	<div id="wrapper">

		<h1>Food Reviews</h1>
		<hr />
		<p><a href="./food.index.php">Food Review Index</a></p>


		<?php	
			echo '<div>';
				echo '<h1>'.$row['foodTitle'].'</h1>';
				echo '<p>Posted on '.date('jS M Y', strtotime($row['foodDate'])).'</p>';
				echo '<p>'.$row['foodCont'].'</p>';				
			echo '</div>';
		?>

	</div>

</body>
</html>