
<!DOCTYPE html> 
<html>
<head>
	<title>Invalid Login</title>
</head>
<body>
<?php
	$validLogin = false;
	if (isset($_POST["username"]) && isset($_POST["password"])) {
		$fileptr = fopen("users.txt", "r+");

	    if (flock($fileptr, LOCK_SH)) { 
	        while ($users = fgetss($fileptr)) {
		    	$userList = explode("#", trim($users));

		    	if (strcmp($_POST["username"], $userList[0]) == 0 && strcmp($_POST["password"], $userList[1]) == 0) {
		    		$validLogin = true;
		    		break;
		    	}
			}
			echo "hello";
	    	if (!$validLogin) {
	    		echo "Invalid login.\n";
	    		echo "<a href='login.html'>Try again</a>";
	    	}
                
            else {
            	header ("Location: profileInfo.html");
            }
                

            flock($fileptr, LOCK_UN);
            fclose($fileptr);
	   	}
	}

?>
</body>
</html>