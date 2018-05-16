<?php require('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset="utf-8"/>
<meta name="description" content="description"/>
<meta name="keywords" content="keywords"/> 
<meta name="author" content="author"/> 
<link rel="stylesheet" type="text/css" href="style/default.css" media="screen"/>
<link rel="stylesheet" href="style/main.css">
    <title>mgs. - Food Reviews</title>
</head>
<body>

<div class="container">
	
	<div class="main">

		<div class="header">
		
			<div class="title">
				<h1>Melissa-Grace Soriano</h1>
				<br>
		        <h3>&nbsp; Undergrad - Writer - Foodie </h3>
			</div>

		</div>

		<?php
			try {

				$stmt = $db->query('SELECT foodID, foodTitle, foodDesc, foodDate FROM food_reviews ORDER BY foodID DESC');
				while($row = $stmt->fetch()){
					
					echo '<div class="content">';
					echo '<div class="item">';
						echo '<h1><a href="viewfood.php?id='.$row['foodID'].'">'.$row['foodTitle'].'</a></h1>';
						echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['foodDate'])).'</p>';
						echo '<p>'.$row['foodDesc'].'</p>';				
						echo '<p><a href="viewfood.php?id='.$row['foodID'].'">Read More</a></p>';				
					echo '</div>';
					echo '</div>';

				}

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}
		?>

	</div>
	
			<div class="sidenav">

			<h1>Users</h1>
			<ul>
				<li><a href='admin/login.php'>Admin Sign-in</a></li> 
				<li><a href='login/login.php'>Member Sign-in</a></li>
				<li><a href='login/index.php'>New User</a></li>
			</ul>

			<h1>Blogs</h1>
			<ul>
				<li><a href='food.index.php'>Food Reviews</a></li>
				<li><a href='index.php'>Blog</a></li>
				<li><a href='index.php'>Gallery</a></li>
			</ul>

			<h1>Contact</h1>
			<ul>
				<li><a href="/index.php">About Me</a></li>
				<li><a href="https://www.instagram.com/missyfeasts/">Instagram</a></li>
				<li><a href="login/memberpage.php">Email</a></li>
			</ul>

			<h1>Search</h1>
			<form action="index.html">
			<div>
				<input type="text" name="search" class="styled" /> <input type="submit" value="" class="button" />
			</div>
			</form>

		</div>
	
		<div class="clearer"><span></span></div>

	</div>

	<div class="footer">Melissa-Grace &copy; 2017
	</div>


</body>
</html>