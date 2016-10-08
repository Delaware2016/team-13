<?php
	// if cookie already stored, check if it contains a valid username/password combination.
	// if it does, redirect to quiz page
	if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
		$fileptr = fopen("users.txt", "r+");

	    if (flock($fileptr, LOCK_SH)) { 
	        while ($users = fgetss($fileptr)) {
		    	$userList = explode("#", trim($users));

		    	if (isset($_GET["logout"])) {
		    		setcookie("username");
		    	}

		    	// check if username/password combination is in the system
		    	else if (strcmp($_COOKIE["username"], $userList[0]) == 0 && strcmp($_COOKIE["password"], $userList[1]) == 0
		    		&& !in_array($_POST["username"], explode(",", $_COOKIE["taken"]))) {
		    		// redirect
		    		header("Location: quiz.php");
		    		break;
		    	}
			}
            flock($fileptr, LOCK_UN);
            fclose($fileptr);
	   	}
	}
?>


<!DOCTYPE html> 
<html>
	<head>
		<title>Login</title>
		<style type="text/css">
			.textbox
			{ 
				color: #FF0000; 
				height: 25px; 
				width: 218px; 
				padding: 2px 5px 2px 5px; 
				border-style: solid; 
				background-color: #FFFFFF;
				font-family: courier; 
				font-size: 14px;
			}
		</style>
	</head>

	<body>
	<center>
		<h3>Login</h3>
		<form action="quiz.php" method="POST">
			Username: <br><input type="text" name="username" class="textbox"> <br><br>
			Password: <br><input type="password" name="password" class="textbox"> <br><br>
			<input type="checkbox" name="keeploggedin"> Keep Me Logged In <br>
			<input type="submit" value="Submit"> &nbsp;&nbsp; <input type="submit" name="adduser" value="Add User">
	</center>
	</body>
</html>