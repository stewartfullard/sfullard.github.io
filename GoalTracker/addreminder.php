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

	$query ="INSERT INTO Reminders VALUES ('".$email."','".$remindername."','".$time."','".$timeType."','".$tags."','".$description."','".$publicPrivate."')";
	
	$stmt = OCIParse($connect, $query);

	if(!$stmt) {
	echo "An error occurred in parsing the sql string.\n";
	exit;
	}
	
	OCIExecute($stmt);
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Goal Tracker</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!-- Css Files -->
	<link rel="stylesheet" href="themes/Assignment2.min.css" />
	<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
	<link rel="stylesheet" type="text/css" media="only screen and (min-width:50px) and (max-width:500px)" href="css/goalTracker_small.css" />
	<link rel="stylesheet" type="text/css" media="only screen and (min-width:501px) and (max-width:800px)" href ="css/goalTracker_medium.css" />
	<link rel="stylesheet" type="text/css" href="css/goalTracker_large.css" />
	
	<!-- Jquery Mobile file -->
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
	
</head>
<body>

<!-- Begin First Page -->
<section id="startpage" data-role="page" data-theme="d">
 <header data-role="header">
 	<h1>Reminder Added</h1>
 </header>
	<!-- Start Content -->
 	<div id="container">
 		<div id="profile" class="ui-body-d tablist-content">
 		<?php
 			echo('<p>Username: '.$email.'</p>');
 			echo('<p>Reminder: '.$remindername.'</p>');
 			echo('<p>Time: '.$time.' '.$timeType.'</p>');
 			echo('<p>Tags: '.$tags.'</p>');
 			echo('<p>Description: '.$description.'</p>');
 			echo('<p>Privacy: '.$publicPrivate.'</p>');
 			?>
 			<a href="index.php" class="ui-btn ui-icon-user ui-btn-icon-left ui-corner-all">Return to Profile</a>
 		</div>
 	</div>
	<!-- End Content -->

   <footer data-role="footer" data-position="fixed"><h1>Goal Tracker</h1></footer>  
</section>
<!-- End First Page --> 