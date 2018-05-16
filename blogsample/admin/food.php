<?php
//include config
require_once('../includes/config.php');

//if not logged in redirect to login page
//if(!$user->is_logged_in()){ header('Location: login.php'); }

//show message from add / edit page
if(isset($_GET['delpost'])){ 

	$stmt = $db->prepare('DELETE FROM food_reviews WHERE foodID = :foodID') ;
	$stmt->execute(array(':foodID' => $_GET['delpost']));

	header('Location: food.php?action=deleted');
	exit;
} 

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - food reviews</title>
  <link rel="stylesheet" href="../style/normalize.css">
  <link rel="stylesheet" href="../style/main.css">
  <script language="JavaScript" type="text/javascript">
  function delpost(id, title)
  {
	  if (confirm("Are you sure you want to delete '" + title + "'"))
	  {
	  	window.location.href = 'food.php?delpost=' + id;
	  }
  }
  </script>
</head>
<body>

	<div id="wrapper">

	<?php include('menu.php');?>

	<?php 
	//show message from add / edit page
	if(isset($_GET['action'])){ 
		echo '<h3>Food Review '.$_GET['action'].'.</h3>'; 
	} 
	?>

	<table>
	<tr>
		<th>Title</th>
		<th>Date</th>
		<th>Action</th>
	</tr>
	<?php
		try {

			$stmt = $db->query('SELECT foodID, foodTitle, foodDate FROM food_reviews ORDER BY foodID DESC');
			while($row = $stmt->fetch()){
				
				echo '<tr>';
				echo '<td>'.$row['foodTitle'].'</td>';
				echo '<td>'.date('jS M Y', strtotime($row['foodDate'])).'</td>';
				?>

				<td>
					<a href="edit-food.php?id=<?php echo $row['foodID'];?>">Edit</a> | 
					<a href="javascript:delpost('<?php echo $row['foodID'];?>','<?php echo $row['foodTitle'];?>')">Delete</a>
				</td>
				
				<?php 
				echo '</tr>';

			}

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
	?>
	</table>

	<p><a href='add-food.php'>Add Food Review</a></p>

</div>

</body>
</html>
