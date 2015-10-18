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
 	<h1>Find Users</h1>
 </header>
	<!-- Start Content -->
 	<div id="container">
 		<div id="profile" class="ui-body-d tablist-content">
 		<a href="index.php" class="ui-btn ui-icon-user ui-btn-icon-left ui-corner-all">Return to Profile</a>
 		<?php		
			$query = "SELECT * FROM GoalTracker WHERE Firstname LIKE '%".$search."%' OR Lastname LIKE '%".$search."%' OR Email LIKE '%".$search."%'";	
			
			 $stmt = OCIParse($connect, $query); 
			//echo "SQL: $query<br>";
			 if(!$stmt) {
			 echo "An error occurred in parsing the sql string.\n"; 
			 exit; 
			 }

			 OCIExecute($stmt);	
			 
			 echo('<p>Search for: '.$search.'</p>');
			 
			 while (OCIFetch($stmt))
			{
				//get and store data from results of query				

				$fname = OCIResult($stmt,"FIRSTNAME");
				$lname = OCIResult($stmt,"LASTNAME");
				
				echo('<div class = "find">');
				echo('<img src ="images/UserImage.jpg" alt = "UserImage" class = "findImg"/>');
				echo('<p>'.$fname.' '.$lname.'</p>');
				echo('<a href="index.php" class="ui-btn ui-icon-eye ui-btn-icon-left ui-corner-all" id="follow">Follow</a>');
				echo('</div>');
			}		
			OCILogOff ($connect);		
		?>	
 			
 		</div>
 	</div>
	<!-- End Content -->

   <footer data-role="footer" data-position="fixed"><h1>Goal Tracker</h1></footer>  
</section>
<!-- End First Page --> 