<?php
	// Connect to Oracle
	 /* Set oracle user login and password info */
	$dbuser = "sfullard"; /* your deakin login */
	$dbpass = "database"; /* your oracle access password */
	$db = "SSID";
	$connect = OCILogon($dbuser, $dbpass, $db);

	if (!$connect)
		{
			echo "Error connecting to database";
			exit;
		}
		
	$query .="INSERT INTO following VALUES ('".$fname."','".$lname."','".$email."')";
	
	$stmt = OCIParse($connect, $query);

	if(!$stmt) {
	echo "An error occurred in parsing the sql string.\n";
	exit;
	}
	
	OCIExecute($stmt);
?>