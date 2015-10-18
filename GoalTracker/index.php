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
 <div class="show-menu" id="show-menu"><p class="ui-btn ui-corner-all ui-icon-bars ui-btn-icon-notext" id="menu-button">Menu</p> <!-- Menu Button --></div>
 	<h1><img src ="images/GoalTracker.png" alt ="GoalTracker"/></h1>
 </header>
	<!-- Start Content -->
 	<div id="container">
		<div data-role="tabs">
			<!-- Start Menu Content -->
			<div class="sliding-menu slide out">
				<ul data-role="listview" data-inset="true" class="tablist-left" id="menu">
					<li><a href="#profile" data-ajax="false" class="ui-btn ui-icon-user ui-btn-icon-left" id="sideMenu">Profile</a></li>
					<li><a href="#newsfeed" data-ajax="false" class="ui-btn ui-icon-comment ui-btn-icon-left">NewsFeed</a></li>
					<li><a href="#following" data-ajax="false" class="ui-btn ui-icon-eye ui-btn-icon-left">Following</a></li>
					<li><a href="#find" data-ajax="false" class="ui-btn ui-icon-search ui-btn-icon-left">Find</a></li>
					<li><a href="#video" data-ajax="false" class="ui-btn ui-icon-camera ui-btn-icon-left">Video</a></li>
					<li><a href="#logout" data-ajax="false" class="ui-btn ui-icon-delete ui-btn-icon-left">Logout</a></li>
				</ul>
			</div>
			<!-- End Menu Content -->
			
			<!-- Start Main Content -->
			<div id="profile" class="ui-body-d tablist-content">
				<img src ="images/UserImage.jpg" alt="userImage" class="profilePicture" />
				<?php echo('<h4 class="profile">'.$fname.' '.$lname.'</h4>');?>
				<h5 class="profile"></h5>
				<div data-role="controlgroup" data-inset="true" class="listManager">
					<a href="#myGoals" data-transition="slide" class="ui-btn ui-icon-bullets ui-btn-icon-left">My Goals</a>
					<a href="#myProgress" data-transition="slide" class="ui-btn ui-icon-gear ui-btn-icon-left">My Progress</a>
					<a href="#myReminders" data-transition="slide" class="ui-btn ui-icon-alert ui-btn-icon-left">My Reminders</a>
					<a href="completed.php" data-transition="slide" class="ui-btn ui-icon-check ui-btn-icon-left">Completed</a>
					<a href="#editProfile" data-transition="slide" class="ui-btn ui-icon-edit ui-btn-icon-left">Edit Profile</a>
				</div>
			</div>
			<div id="result"></div>
 
			<div id="newsfeed" class="ui-body-d tablist-content">
				<h3>NewsFeed</h3>
					<p>NewsFeed of users and groups appears here</p>
					
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
					
						$query = "SELECT goalname, description FROM Goals";
						
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
							$description = OCIResult($stmt,"DESCRIPTION");

							echo('<img src ="images/UserImage.jpg" alt = "UserImage" class = "findImg"/>');
							echo('<h3>fname lname</h3>');
							echo('<h4>'.$goalname.'</h4>');
							echo('<p>'.$description.'</p>');

						}	
						OCILogOff ($connect);
					?>
			</div>
			<div id="following" class="ui-body-d tablist-content">
				<h3>Following</h3>
					<p>Followed users and groups appears here</p>
					
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
						$query = "SELECT Firstname,Lastname FROM Following";
						
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

							$fname = OCIResult($stmt,"FIRSTNAME");
							$lname = OCIResult($stmt,"LASTNAME");
				
							echo('<div class = "find">');
							echo('<img src ="images/UserImage.jpg" alt = "UserImage" class = "findImg"/>');
							echo('<p>'.$fname.' '.$lname.'</p>');
							echo('</div>');
						}	
						OCILogOff ($connect);
						
					?>
			</div>
			<div id="find" class="ui-body-d tablist-content">
				<h3>Find</h3>
				<p>Find Users or Groups</p>
				<form method="post" action="find.php">
					<div class="ui-field-contain">
						<label for="search">Search:</label>
						<input type="search" name="search" id="search" placeholder="Search for users or groups..." />
					</div>
				<input type="submit" data-inline="true" value="Find" />
				</form>
				<p>Warning! Case Sensitive!</p>
			</div>
			<div id="video" class="ui-body-d tablist-content">
				<h3>Video</h3>
				<video width="400" controls>
					<source src="videos/GoalTracker.mp4" type="video/mp4">
					Your browser does not support HTML5 video.
				</video>
			</div>
			<div id="logout" class="ui-body-d tablist-content">
				<h3>Logout</h3>
			</div>
			<!-- End Menu Content -->
		</div>
	</div>
	<!-- End Content -->

   <footer data-role="footer" data-position="fixed"> <h1><img src ="images/GoalTracker.png" alt ="GoalTracker"/></h1></footer>  
</section>
<!-- End First Page --> 

<!-- Start Goals Section -->
<section id="myGoals" data-role="page" data-theme="d">
 <header data-role="header">
 	<a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext">back</a>
 	<h1>Goal Tracker</h1>
 </header>
 <div id="container">
	 <div class="ui-body-d tablist-content">
		<h3>My Goals</h3>
		<div data-role="controlgroup" data-inset="true" class="listManager">
			<a href="goals.php" data-transition="slide" class="ui-btn ui-icon-bullets ui-btn-icon-left">Goals</a>
			<a href="#addGoal" data-transition="slide" class="ui-btn ui-icon-bullets ui-btn-icon-left">Add Goal</a>
		</div>
	</div>
 </div>
</section>
<!-- End Goals Section -->

<!-- Start Progress Section -->
<section id="myProgress" data-role="page" data-theme="d">
 <header data-role="header">
 	<a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext">back</a>
 	<h1>Goal Tracker</h1>
 </header>
 <div id="container">
 	<div class="ui-body-d tablist-content">
 		<h3>My Progress</h3>
 		<div data-role="controlgroup" data-inset="true" class="listManager">
 			<a href="progress.php" data-transition="slide" class="ui-btn ui-icon-gear ui-btn-icon-left">Progress</a>
			<a href="#editProgress" data-transition="slide" class="ui-btn ui-icon-gear ui-btn-icon-left">Edit Progress</a>
		</div>
 	</div>
 </div>
</section>
<!-- End Progress Section -->

<!-- Start Reminders Section -->
<section id="myReminders" data-role="page" data-theme="d">
 <header data-role="header">
 	<a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext">back</a>
 	<h1>Goal Tracker</h1>
 </header>
 <div id="container">
 	<div class="ui-body-d tablist-content">
 		<h3>My Reminders</h3>
 		<div data-role="controlgroup" data-inset="true" class="listManager">
 			<a href="reminder.php" data-transition="slide" class="ui-btn ui-icon-alert ui-btn-icon-left">Reminders</a>
			<a href="#addReminder" data-transition="slide" class="ui-btn ui-icon-alert ui-btn-icon-left">Add Reminder</a>
		</div>
 	</div>
 </div>
</section>
<!-- End Reminders Section -->


<!-- Start Add Goal Section -->
<section id="addGoal" data-role="page" data-theme="d">
   <header data-role="header">
 	<a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext">back</a>
	   <h1>Add Goal</h1>
   </header>
   <div id="container">
   		<div class="ui-body-d tablist-content">
			<form action="addgoal.php" method="post" id="addGoal">
			  
			   <div>
			<!-- Input space -->
			<fieldset name="LocalStorage" id="ls">
				<label for="goalname">Goal Name:</label>
				<input type="text" name="goalname" id="goalname" class="required" placeholder="Eat better by Chistmas" />
					<label for="time">Completion Date:</label>
					<fieldset class="ui-field-contain">
					<select  name="time" id="time" class="required">
						<option value="1">One</option>
						<option value="2">Two</option>
						<option value="3">Three</option>
						<option value="4">Four</option>
						<option value="5">Five</option>
						<option value="6">Six</option>
						<option value="7">Seven</option>
					</select>
				</fieldset>
				<fieldset class="ui-field-contain">
					<select name="timeType" id="timeType" class="required" >
						<option value="day">Day(s)</option>
						<option value="week">Week(s)</option>
						<option value="month">Month(s)</option>
						<option value="year">Year(s)</option>
					</select>
				</fieldset>
				<label for="tags">Tags:</label>
				<input type="text" name="tags" id="tags" class="required" placeholder="#weightloss #learn5timestables #eatHealthy;" />
				<label for="description">Description:</label>
				<textarea name="description" id="description" class="required" ></textarea>
				<fieldset data-role="controlgroup" data-type="horizontal">
				<label for="public">Public</label>
				<input type="radio" name="publicPrivate" id="public" value="public" />
				<label for="private">Private</label>
				<input type="radio" name="publicPrivate" id="private" value="private" />	
				</fieldset>

			<p> * All fields required </p>
	   
			<!-- Set of Button link to the function to  save, edit or delete data in local storage -->
				<input id="save" name="submit" type="submit" value="Save" onclick="storeLocalContent(
						document.querySelector('#goalname').value,
						document.querySelector('#time').value,
						document.querySelector('#timeType').value,
						document.querySelector('#tags').value,
						document.querySelector('#description').value,
						document.querySelector('#publicPrivate').value"/>
				<input id="clear" name="clear" type="reset" value="Clear" />
				<a href="#startpage" class="ui-btn ui-corner-all">Cancel</a>
				</fieldset>
			   </div>
			</form>
		</div>
	 </div>
  </section>
<!-- End Add Goal Section -->

<!-- Start Edit Profile Section -->
<section id="editProfile" data-role="page" data-theme="d">
   <header data-role="header">
 	<a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext">back</a>
	   <h1>Edit User</h1>
   </header>
   <div id="container">
   		<div class="ui-body-d tablist-content">
			<form action="editprofile.php" method="post" id="editUser">
			   <div>
			<!-- Input space -->
				<fieldset name="LocalStorage" id="ls">
					<label for="fname">First Name:</label>
					<input type="text" name="fname" id="fname" class="required" />
					<label for="lname">Last Name:</label>
					<input type="text" name="lname" id="lname" class="required" />
					<label for="dateOfBirth">Date of Birth:</label>
					<fieldset class="ui-field-contain">
						<label for="day">Day:</label>
						<select name="day" id="day" class="required" >
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							<option value="19">19</option>
							<option value="20">20</option>
							<option value="21">21</option>
							<option value="22">22</option>
							<option value="23">23</option>
							<option value="24">24</option>
							<option value="25">25</option>
							<option value="26">26</option>
							<option value="27">27</option>
							<option value="28">28</option>
							<option value="29">29</option>
							<option value="30">30</option>
							<option value="31">31</option>
						</select>
					</fieldset>
					<fieldset class="ui-field-contain">
						<label for="month">Month:</label>
						<select  name="month" id="month" class="required" >
							<option value="january">January</option>
							<option value="february">February</option>
							<option value="march">March</option>
							<option value="april">April</option>
							<option value="may">May</option>
							<option value="june">June</option>
							<option value="july">July</option>
							<option value="august">August</option>
							<option value="september">September</option>
							<option value="october">October</option>
							<option value="november">November</option>
							<option value="december">December</option>
						</select>
					</fieldset>
					<fieldset class="ui-field-contain">
						<label for="year">Year:</label>
						<select  name="year" id="year" class="required">
							<!--1950 -->
							<optgroup label="1950s">
								<option value="1950">1950</option>
								<option value="1951">1951</option>
								<option value="1952">1952</option>
								<option value="1953">1953</option>
								<option value="1954">1954</option>
								<option value="1955">1955</option>
								<option value="1956">1956</option>
								<option value="1957">1957</option>
								<option value="1958">1958</option>
								<option value="1959">1959</option>
							</optgroup>
							<!--1960-->
							<optgroup label="1960s">
								<option value="1960">1960</option>
								<option value="1961">1961</option>
								<option value="1962">1962</option>
								<option value="1963">1963</option>
								<option value="1964">1964</option>
								<option value="1965">1965</option>
								<option value="1966">1966</option>
								<option value="1967">1967</option>
								<option value="1968">1968</option>
								<option value="1969">1969</option>
							</optgroup>
							<!--1970-->
							<optgroup label="1970s">
								<option value="1970">1970</option>
								<option value="1971">1971</option>
								<option value="1972">1972</option>
								<option value="1973">1973</option>
								<option value="1974">1974</option>
								<option value="1975">1975</option>
								<option value="1976">1976</option>
								<option value="1977">1977</option>
								<option value="1978">1978</option>
								<option value="1979">1979</option>
							</optgroup>
							<!--1980-->
							<optgroup label="1980s">
								<option value="1980">1980</option>
								<option value="1981">1981</option>
								<option value="1982">1982</option>
								<option value="1983">1983</option>
								<option value="1984">1984</option>
								<option value="1985">1985</option>
								<option value="1986">1986</option>
								<option value="1987">1987</option>
								<option value="1988">1988</option>
								<option value="1989">1989</option>
							</optgroup>
							<!--1990-->
							<optgroup label="1990s">
								<option value="1990">1990</option>
								<option value="1991">1991</option>
								<option value="1992">1992</option>
								<option value="1993">1993</option>
								<option value="1994">1994</option>
								<option value="1995">1995</option>
								<option value="1996">1996</option>
								<option value="1997">1997</option>
								<option value="1998">1998</option>
								<option value="1999">1999</option>
							</optgroup>
							<!--2000-->
							<optgroup label="2000s">
								<option value="2000">2000</option>
								<option value="2001">2001</option>
								<option value="2002">2002</option>
								<option value="2003">2003</option>
								<option value="2004">2004</option>
								<option value="2005">2005</option>
								<option value="2006">2006</option>
								<option value="2007">2007</option>
								<option value="2008">2008</option>
								<option value="2009">2009</option>
							</optgroup>						
						</select>
					</fieldset>
					<label for="email">Email Address:</label>
					<input type="text" name="email" id="email" class="required" placeholder="e.g. user@email.com" />
					<fieldset data-role="controlgroup" data-type="horizontal">
					<legend>Choose your gender:</legend>
					<label for="male">Male</label>
					<input type="radio" name="gender" id="male" value="male" ></input>
					<label for="female">Female</label>
					<input type="radio" name="gender" id="female" value="female" ></input>
					</fieldset>
				<p> * All fields required </p>
	   
				<!-- Set of Button link to the function to  save, edit or delete data in local storage -->
					<input id="save" name="submit" type="submit" value="Save" onclick="storeLocalContent(
						document.querySelector('#fname').value,
						document.querySelector('#lname').value,
						document.querySelector('#day').value,
						document.querySelector('#month').value,
						document.querySelector('#year').value,
						document.querySelector('#email').value,
						document.querySelector('#gender').value,)" />
					<input id="clear" name="clear" type="reset" value="Clear" />
					<a href="#startpage" class="ui-btn ui-corner-all">Cancel</a>
				</fieldset>
				</div>
			</form>
		</div>
	 </div>
  </section>
<!-- End Edit Profile Section -->

<!-- Start Add Reminder Section -->
<section id="addReminder" data-role="page" data-theme="d">
   <header data-role="header">
 	<a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext">back</a>
	   <h1>Add Reminder</h1>
   </header>
   <div id="container">
   		<div class="ui-body-d tablist-content">
			<form action="addreminder.php" method="post" id="addReminder">
			   <div>
			<!-- Input space -->
			<fieldset name="LocalStorage" id="ls">
				<label for="remindername">Reminder Name:</label>
				<input type="text" name="remindername" id="remindername" class="required" placeholder="Go for 30 min walk" />
					<label for="time">On Date:</label>
					<fieldset class="ui-field-contain">
						<label for="day">Day:</label>
						<select  day="day" id="day" class="required" >
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							<option value="19">19</option>
							<option value="20">20</option>
							<option value="21">21</option>
							<option value="22">22</option>
							<option value="23">23</option>
							<option value="24">24</option>
							<option value="25">25</option>
							<option value="26">26</option>
							<option value="27">27</option>
							<option value="28">28</option>
							<option value="29">29</option>
							<option value="30">30</option>
							<option value="31">31</option>
						</select>
					</fieldset>
					<fieldset class="ui-field-contain">
						<label for="month">Month:</label>
						<select  name="month" id="month" class="required" >
							<option value="january">January</option>
							<option value="february">February</option>
							<option value="march">March</option>
							<option value="april">April</option>
							<option value="may">May</option>
							<option value="june">June</option>
							<option value="july">July</option>
							<option value="august">August</option>
							<option value="september">September</option>
							<option value="october">October</option>
							<option value="november">November</option>
							<option value="december">December</option>
						</select>
					</fieldset>
					<fieldset class="ui-field-contain">
						<label for="year">Year:</label>
						<select  name="year" id="year" class="required">
							<option value="2000">2015</option>
							<option value="2001">2016</option>
							<option value="2002">2017</option>
							<option value="2003">2018</option>
							<option value="2004">2019</option>
							<option value="2005">2020</option>
							<option value="2006">2021</option>
							<option value="2007">2022</option>
							<option value="2008">2023</option>
							<option value="2009">2024</option>
							<option value="2009">2025</option>				
						</select>
					</fieldset>
				<label for="tags">Tags:</label>
				<input type="text" name="tags" id="tags" class="required" placeholder="#weightloss #walking #lifestyle;" />
				<label for="description">Description:</label>
				<textarea name="description" id="description" class="required" ></textarea>
				<fieldset data-role="controlgroup" data-type="horizontal">
				<label for="public">Public</label>
				<input type="radio" name="publicPrivate" id="public" value="public" />
				<label for="private">Private</label>
				<input type="radio" name="publicPrivate" id="private" value="private" />	
				</fieldset>

			<p> * All fields required </p>
	   
			<!-- Set of Button link to the function to  save, edit or delete data in local storage -->
				<input id="save" name="submit" type="submit" value="Save" onclick="storeLocalContent(
						document.querySelector('#goalname').value,
						document.querySelector('#time').value,
						document.querySelector('#timeType').value,
						document.querySelector('#tags').value,
						document.querySelector('#description').value,
						document.querySelector('#publicPrivate').value"/>
				<input id="clear" name="clear" type="reset" value="Clear" />
				<a href="#startpage" class="ui-btn ui-corner-all">Cancel</a>
				</fieldset>
			   </div>
			</form>
		</div>
	 </div>
  </section>
<!-- End Add Reminder Section -->

<!-- Start Edit Progress Section -->
<section id="editProgress" data-role="page" data-theme="d">
   <header data-role="header">
 	<a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext">back</a>
	   <h1>Edit Progress</h1>
   </header>
   <div id="container">
   		<div class="ui-body-d tablist-content">
			<form action="addprogress.php" method="post" id="editProgress">
			   <div>
			<!-- Input space -->
			<fieldset name="LocalStorage" id="ls">
				<label for="goalname">Select Goal:</label>
				<fieldset class="ui-field-contain">
						<select  day="Goal" id="Goal" class="required" >
							<option id="GenerateGoal"><!--Goal From Goal Table --></option>
						</select>
					</fieldset>
					<label for="time">On Date:</label>
					<fieldset class="ui-field-contain">
						<label for="day">Day:</label>
						<select  day="time" id="day" class="required" >
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							<option value="19">19</option>
							<option value="20">20</option>
							<option value="21">21</option>
							<option value="22">22</option>
							<option value="23">23</option>
							<option value="24">24</option>
							<option value="25">25</option>
							<option value="26">26</option>
							<option value="27">27</option>
							<option value="28">28</option>
							<option value="29">29</option>
							<option value="30">30</option>
							<option value="31">31</option>
						</select>
					</fieldset>
					<fieldset class="ui-field-contain">
						<label for="month">Month:</label>
						<select  name="month" id="month" class="required" >
							<option value="january">January</option>
							<option value="february">February</option>
							<option value="march">March</option>
							<option value="april">April</option>
							<option value="may">May</option>
							<option value="june">June</option>
							<option value="july">July</option>
							<option value="august">August</option>
							<option value="september">September</option>
							<option value="october">October</option>
							<option value="november">November</option>
							<option value="december">December</option>
						</select>
					</fieldset>
					<fieldset class="ui-field-contain">
						<label for="year">Year:</label>
						<select  name="year" id="year" class="required">
							<option value="2000">2015</option>
							<option value="2001">2016</option>
							<option value="2002">2017</option>
							<option value="2003">2018</option>
							<option value="2004">2019</option>
							<option value="2005">2020</option>
							<option value="2006">2021</option>
							<option value="2007">2022</option>
							<option value="2008">2023</option>
							<option value="2009">2024</option>
							<option value="2009">2025</option>				
						</select>
					</fieldset>
				<label for="tags">Tags:</label>
				<input type="text" name="tags" id="tags" class="required" placeholder="#weightloss #walking #lifestyle;" />
				<label for="description">Description:</label>
				<textarea name="description" id="description" class="required" ></textarea>
				<fieldset data-role="controlgroup" data-type="horizontal">
				<label for="public">Public</label>
				<input type="radio" name="publicPrivate" id="public" value="public" />
				<label for="private">Private</label>
				<input type="radio" name="publicPrivate" id="private" value="private" />	
				</fieldset>
				<fieldset data-role="controlgroup">
				<legend>Completed?</legend>
				  <label for="complete">Completed?</label>
				  <input type="checkbox" name="completed" id="completed" value="completed">
			  </fieldset>

			<p> * All fields required </p>
	   
			<!-- Set of Button link to the function to  save, edit or delete data in local storage -->
				<input id="save" name="submit" type="submit" value="Save" onclick="storeLocalContent(
						document.querySelector('#goalname').value,
						document.querySelector('#time').value,
						document.querySelector('#timeType').value,
						document.querySelector('#tags').value,
						document.querySelector('#description').value,
						document.querySelector('#publicPrivate').value"/>
				<input id="clear" name="clear" type="reset" value="Clear" />
				<a href="#startpage" class="ui-btn ui-corner-all">Cancel</a>
				</fieldset>
			   </div>
			</form>
		</div>
	 </div>
  </section>
<!-- End Edit Progress Section -->



<script type="text/javascript" src="script/goalTracker.js"  ></script>

</body>
</html>
