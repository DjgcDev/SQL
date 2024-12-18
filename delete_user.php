<!doctype html>
<html lang= "en">
<head>
	<title>Deleting user</title>
	<meta charset = "utf-8">
	<link rel = "stylesheet" type =" text/css" href ="style.css">

	
</head>
<body>
	<div id= "container">
		<?php include ('header.php');?>
		<?php include ('nav.php');?>
		<?php include ('info-col.php');?>


		<div id= 'delete_user'>
		<h2>Deleting Record</h2>
        <img id= cry src="cry.gif">
                <?php
                    if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
                        $id = $_GET['id'];
                    }elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
                        $id = $_POST['id'];
                    }else {
                        echo '<p class="error">This page has been accessed by mistake</p>';
                        include('footer.php');
                        exit();
                    }
                    require('mysqli_connect.php');
                    if($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if($_POST['sure'] == 'Yes'){
                            $q = "DELETE FROM users WHERE user_id = '$id'";
                            $result = @mysqli_query($dbcon, $q);
                            if (mysqli_affected_rows($dbcon) == 1){
                                echo '<h3>The record has been deleted</h3>';
                            }else{
                                echo '<h3>Record is not Deleted</h3>';
                        }
                    } else{
                        echo '<h3> The record has NOT been deleted</h3>';
                    }
                }else {
                    //hotdog
                    $q = "SELECT CONCAT(fname, ' ', lname) from users where user_id = $id";
                    $result = @mysqli_query($dbcon, $q);
                    if(mysqli_affected_rows($dbcon) == 1) {
                        $row = mysqli_fetch_array($result, MYSQLI_NUM);
                            echo "<h3>Are you sure you want to permanently delete $row[0]?</h3>";
                            //uwu
                            echo '
                            <form action="delete_user.php" method="post">
                            <input id="submit-yes" type="submit" name="sure"
                            value="Yes">
                            <input id="submit-no" type="submit" name="sure"
                            value="No">
                            <input type="Hidden" name="id" value="'.$id.'">
                            </form>
                            ';
                    }else {
                        echo 'Error: Unidentified User';
                    }
                }
                mysqli_close($dbcon);
                ?>
		</div>
		
	</div>
	<?php include ('footer.php');?>
</body>
</html>