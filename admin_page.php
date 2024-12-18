<?php
	session_start();
	if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] !=1)){
		header(header: "location: admin_page.php");
		exit();
	}
?>

<!doctype html>
<html lang= "en">
<head>
	<title>catli</title>
	<meta charset = "utf-8">
	<link rel = "stylesheet" type =" text/css" href ="style.css">

	
</head>
<body>
	<div id= "container">
		<?php include ('header.php');?>
		<?php include ('Nav.php');?>

		<div id= 'dashboard'>
			<h2> Dashboard my Ninja</h2>
			<img id= dash src="dashboard.png">
				
			
		</div>
	</div>
	<?php include ('footer.php');?>
</body>
</html>