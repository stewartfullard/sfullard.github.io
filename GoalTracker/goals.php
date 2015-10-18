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
 	<h1>Goals</h1>
 </header>
	<!-- Start Content -->
 	<div id="container">
 		<div id="profile" class="ui-body-d tablist-content">
		<?php
				$query = "SELECT * FROM Goals";
				
				$stmt = OCIParse($connect, $query); 
				//echo "SQL: $query<br>";
				 if(!$stmt) {
				 echo "An error occurred in parsing the sql string.\n"; 
				 exit; 
				 }
				 OCIExecute($stmt);	
			 
				 while (OCIFetch($stmt))
				{
					//get and store data from results of query				

					$goalname = OCIResult($stmt,"GOALNAME");
					$time = OCIResult($stmt,"TIME");
					$timeType = OCIResult($stmt,"TIMETYPE");
					$tags = OCIResult($stmt,"TAGS");
					$description = OCIResult($stmt,"DESCRIPTION");
					$privacy = OCIResult($stmt,"PRIVACY");
					$completed = OCIResult($stmt,"COMPLETED");
			
					echo('<div class="data">');
					echo('<p>Goalname: '.$goalname.'</p>');
					echo('<p>Time: '.$time.' '.$timeType.'</p>');
					echo('<p>Tags: '.$tags.'</p>');
					echo('<p>Description: '.$description.'</p>');
					echo('<p>Privacy: '.$privacy.'</p>');
					echo('<p>Completed: '.$completed.'</p>');
					echo('</div>');
				}	
				OCILogOff ($connect);
			?>
		<a href="index.php" class="ui-btn ui-icon-user ui-btn-icon-left ui-corner-all" id = "profilebutton">Return to Profile</a>
 		</div>
 	</div>
	<!-- End Content -->

   <footer data-role="footer" data-position="fixed"><h1>Goal Tracker</h1></footer>  
</section>
<!-- End First Page -->