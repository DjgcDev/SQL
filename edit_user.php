<!doctype html> 
<html lang="en">
<head>
	<title>Edit User Information</title>
	<meta charset = "utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	
</head>
<body>
	<div id="container">
		<?php include('header.php'); ?>
		<?php include('nav.php'); ?>
		<?php include('info-col.php'); ?>
		
		<div id='edit_user'>
			<h2>Edit User Record</h2>
			<?php
				//checking lang kung valid id 
				if((isset($_GET['id'])) && (is_numeric($_GET['id']))){
					$id = $_GET['id'];
				}elseif((isset($_POST['id'])) && (is_numeric($_POST['id']))){
					$id = $_POST['id'];
				}else{//oh no.. id not found
					echo '<p class="error">This page has been accessed by mistake.</p>';
					echo '<a href="register-view-users.php">Go back</a>';
					exit();
				}
				require('mysqli_connect.php');
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					$errors = array();
					//check first name, last name, and email
					if(empty($_POST['fname'])) { //fname
						$errors[] = 'Please input your first name.';
					}else{
						$fn = trim($_POST['fname']);
					}
					if(empty($_POST['lname'])) { //lname
						$errors[] = 'Please input your last name.';
					}else{
						$ln = trim($_POST['lname']);
					}
					//may email ba?
					if(empty($_POST['email'])) { //email
						$errors[] = 'Please input your email.';
					}else{
						$e = trim($_POST['email']);
					}
					if(empty($errors)){
						$q = "UPDATE users SET fname='$fn', lname='$ln', email='$e' WHERE user_id = '$id' LIMIT 1"; // sanity checking
						$result = @mysqli_query($dbcon,$q);
						if(mysqli_affected_rows($dbcon) == 1){
							echo'<h3>Successful Update: User data is edited';
							echo '<a href="register-view-users.php">Go back</a>';
							
						}else{ 
							echo'<h3>Unsuccessful Update: User data is not edited</h3>';
							echo'<p>'.mysqli_error($dbcon).'</p>';
						}
					}else{
						echo'<h2>Error!</h2><p class="error">The following 
						error(s) occured:<br/>';
						foreach($errors as $msg){
							echo " - $msg<br/>\n";
						}
						echo '<h3>Please try again.</h3><br/><br/>';
					}
				}
				$q  = "SELECT fname, lname, email FROM users where user_id=$id";
				$result = @mysqli_query($dbcon,$q);
				if(mysqli_num_rows($result) == 1){ //user_id is valid
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
					//create form
					echo '
						<form action="edit_user.php" method="post">

							<p><label class="label" for="fname">First Name: </label>
							<input type="text" id="fname" name="fname" size="30" maxlength="40"
							value="'.$row['fname'].'">
							</p>

							<p><label class="label" for="lname">Last Name: </label>
							<input type="text" id="lname" name="lname" size="30" maxlength="40"
							value="'.$row['lname'].'">
							</p>

							<p><label class="label" for="email">Email Address: </label>
							<input type="text" id="email" name="email" size="30" maxlength="50"
							value="'.$row['email'].'">
							</p>

							<p><input type="submit" id="submit" name="submit" value="edit"></p>
							<p><input type="hidden" name="id" value="'.$id.'"></p>
						
						</form>
					';
				}else{
					//no valid id
					echo '<h3>User does not exist</h3>';
					//tell the user to register instead
					echo '<p>Not yet registered? <a href="register.php">Register here</a></p>';

				}
				mysqli_close($dbcon);
			?>
		</div>
	</div>
	<?php include('footer.php'); ?>
</body>

</html>