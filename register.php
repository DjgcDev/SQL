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
		<?php include ('Nav_register.php');?>
		<?php include ('info-col.php');?>
		
		<div id= 'Registerbox'>
		<?php
				if ($_SERVER['REQUEST_METHOD'] == 'POST'){
					// error array
					$errors = array();

					// may first name?
					if (empty($_POST['fname'])) {
						$errors[] = "Please input your first name.";
					} else {
						$fn = trim($_POST['fname']);
					}
					
					// may last name?
					if (empty($_POST['lname'])) {
						$errors[] = "Please input your last name.";
					} else {
						$ln = trim($_POST['lname']);
					}

					// may email?
					if (empty($_POST['email'])) {
						$errors[] = "Please input your email.";
					} else {
						$e = trim($_POST['email']);
					}

					// same ba yung password?
					/* 
						include a password validation
						if password < 8 characters
						password does not have capital letters
						password does not contain numbers
						password does not contain symbols

						example solution:
						if(password.len < 8)
							invalidate_login()
						}
						if(!password.containsCapital()){}
							invalidate_login()
						}	
					*/
					if (!empty($_POST['psword1'])) {
						if ($_POST['psword1'] != $_POST['psword2']) {
							$errors[] = "Passwords do not match.";
						} else {
							$p = trim($_POST['psword1']);
						}
					} else {
						$errors[] = "Please input your password.";
					}

					if (empty($errors)) { 
						require('mysqli_connect.php');
						$hashedPassword = hash ('sha256',$p);
						$q = "insert into users(fname,lname,email,psword,registration_date, user_level)values ('$fn', '$ln', '$e', '$hashedPassword', NOW(), 0);";
						$result = @mysqli_query($dbcon, $q);
					
						if ($result){
							header("location: register-success.php");
							exit();
						}else{
							echo'<h2>System Error</h2>
							<p class = "error">Your registration failed due to an unexpected error. Sorry for the inconvenience</p>';

							echo '<p>'.mysqli_error($dbcon).'</p>';	
						}
						mysqli_close(($dbcon));
						include('footer.php');
						exit();
					} else { // may errors huhu
						echo '<h4>Error!</h4>
						<p class="error">The following error(s) occured: <br/>';
						foreach($errors as $msg){
							echo " - $msg<br/>\n";
						}
						echo '</p><h3>Please try again</h3><br/>';
					}
				}
			?>
			<h2>Registration Page</h2>
				<form action="register.php" method="post">
					<p class="inputs">
						<label class="label" for="fname">First Name:</label>
						<input type="text" id="fname" name="fname" size="30" maxlength="40" value="<?php if (isset($_POST['fname'])) echo $_POST['fname'];?>">
					</p>

					<p class="inputs">
						<label class="label" for="lname">Last Name:</label>
						<input type="text" id="lname" name="lname" size="30" maxlength="40" value="<?php if (isset($_POST['lname'])) echo $_POST['lname'];?>">
					</p>

					<p class="inputs">
						<label class="label" for="email">Email Address:</label>
						<input type="text" id="email" name="email" size="30" maxlength="50" value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>">
					</p>

					<p class="inputs">
						<label class="label" for="psword1">Password:</label>
						<input type="password" id="psworsd1" name="psword1" size="20" maxlength="40" value="<?php if (isset($_POST['psword1'])) echo $_POST['psword1'];?>">
					</p>

					<p class="inputs">
						<label class="label" for="psword2">Repeat Password:</label>
						<input type="password" id="psword2" name="psword2" size="20" maxlength="40" value="<?php if (isset($_POST['psword2'])) echo $_POST['psword2'];?>">
					</p>

					<p class="inputs">
						<input type="submit" id="submit" name="submit" value="Register">
					</p>
				
				
				
				
			
			</form>
			
		</div>
		
	</div>
	<?php include ('footer.php');?>
</body>
</html>