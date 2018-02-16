<?php
	session_start();

	function db_connect() {
		global $db;
		$db = new mysqli('localhost', 'root', '', 'AcceleratedParking');
		//Returns an error code value. Zero if no error occurred.
		if (mysqli_connect_errno()) 
		{
			// echo "<p>Could not connect to database</p>";
		} else {
			// echo "<p>Connected to AcceleratedParking</p>";	
		}
	}

	function registerUser(){
		echo "<p>hello</p>";
		global $db;
		db_connect();
		//Collecting the user inputs and assigning them.
		$Username = $_POST['username'];
		$Email = $_POST['email'];
		$Password = $_POST['password'];
		//Picking up on the users password and hashing it so that it is stored securely.
		$hashed_password = password_hash($Password, PASSWORD_DEFAULT);
		

		//Checking that all the required feilds are set.
		if (!isset($Username) || !isset($Email) || !isset($Password))
		{
			//Error message telling the user something isn't filled in correctly.
			echo "<p>You have not entered all the required details.<br />
			Please go back and try again.</p>";
			exit;
		}else{		
			/*	This commented code is unsafe from SQL Injection.
				It has been included into the code to show an alternative way of
				adding items into a database.
			

				//Unsafe item inclusion.
				$query = "INSERT INTO users (Firstname, Surname, Username, Password) 
				VALUES ('$Firstname', '$Surname', '$Username', '$Password')";		
				if($db->query($query) === TRUE){
					echo "Info inserted";
				}else{
					echo "Error";
				}		
				$db->close();
			*/
			
			$sql = "SELECT UserID, Username, EmailAddress, CreationDate FROM User WHERE Username = '$Username'";
			$result = $db->query($sql);
			
			//Checking that the number of results returned by the sql is greater than 0. If it is then can't create user.
			if($result->num_rows > 0){
				//Error message for the user as the username they've chosen already exists.
				$Header = "UNSUCCESSFUL";
				$SubHead = "Please choose a different Username";
				$Message = "<p>Click <a href='register.php'>here</a> to go back and try again</p>";
			}else{
				//Creating a new user in the database.
				$query = "INSERT INTO user (Username, EmailAddress, Password) VALUES (?, ?, ?)";
			
				$stmt = $db->prepare($query);
				$stmt->bind_param('sss', $Username, $Email, $hashed_password);
				if(false === $stmt){
					echo "Prepare Failed";
					exit;
				}		
				$stmt->execute();
				
				//Checking that the new user has been inputted.
				if ($stmt->affected_rows > 0)
				{
					$query = "SELECT * FROM User WHERE Username = '" . $Username ."'";
					$tbl = $db->query($query);
					$user = $tbl->fetch_assoc();
					$_SESSION["UserID"] = $user["UserID"];
					/*dumps information from database*/
					//var_dump($user);

}
				//Checking that the username exists in the database.
				if(mysqli_num_rows($tbl)>0){
					header('Location: account.php');
				} else {
					header('Location: register.php');
				}
			}
			
			//Closing the Database connection.
			$db->close();
		}
	}

	function createSession($user_id){
		$_SESSION['UserID'] = $user_id;
		header("Location: account.php");
	}

	function login($Username, $Password){

		global $db;
		db_connect();

		//Collecting the user inputs and assigning them.
		$Username = $_POST['userName'];
		$Password = $_POST['password'];
		$errors = '';
		//Checking that all the required feilds are set.
		if (!isset($Username) || !isset($Password))
		{
			//Error message telling the user something isn't filled in correctly.
			$errors = "<p>You have not entered all the required details.<br />
			Please go back and try again.</p>";
			exit;
		}else{
			//Stripping HTML and PHP tags from a string. Then escapes special characters in a string for use in an SQL statement.
			$Username = strip_tags(mysqli_real_escape_string($db, trim($Username)));
			$Password = strip_tags(mysqli_real_escape_string($db, trim($Password)));
			
			$query = "SELECT * FROM User WHERE Username = '" . $Username ."'";
			$tbl = $db->query($query);
			$user = $tbl->fetch_assoc();
			
			/*dumps information from database*/
			//var_dump($user);


			//Checking that the username exists in the database.
			if(mysqli_num_rows($tbl)>0){
				//If the username exists then check that the password is correct.
				//$row = mysqli_fetch_array($tbl);
				$password_hash = $user['Password'];
				if(password_verify($Password, $password_hash)){
					//If we are here it means the passwords match.				
					$sql = "SELECT UserID, Username, EmailAddress, CreationDate FROM User";
					$result = $db->query($sql);
			
					if($result->num_rows > 0){
						while($row = $result->fetch_assoc()){
							$UserID = $row["UserID"];
							$Username = $row["Username"];
							$Email = $row["EmailAddress"];
							$CreationDate = $row["CreationDate"];													}
					}else{
						//Error message for the user as the login was unsuccessful.
						$FullName = "Unsuccessful";
						$Message = "Please go back and attempt to log in again";			
					}
				}else{
					$errors = "Password Incorrect";
				}		
			}else{
				$errors = "Please go back and attempt to log in again";
			}

			if(!empty($errors)){
				echo $errors;
			}else{
				$user_id = $user['UserID'];
				createSession($user_id);
			}
			
			$db->close();
		}	
	}

	function db_result_to_array($result) {
	   $res_array = array();

	   for ($count=0; $row = $result->fetch_assoc(); $count++) {
	     $res_array[$count] = $row;
	   }

	   return $res_array;
	}


	function getHeadTag(){
		echo "<link rel='shortcut icon' type='image/png' href='img/icons/favicon.ico'/>
			

			<!-- start: Meta -->
			<meta charset='utf-8'>
			<meta name='description' content='Accelerated Parking by Pearce Feeley'/>
			<meta name='keywords' content='Parking, Booking, Belfast, Quick, Easy' />
			<meta name='author' content='Pearce Feeley'/>
			<!-- end: Meta -->
			
			<!-- start: Mobile Specific -->
			<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
			<!-- end: Mobile Specific -->
			
		    <!-- start: CSS -->
		    <link rel='stylesheet' type='text/css' media='all'
      href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/smoothness/jquery-ui.css'/>
			<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
		    <link href='css/bootstrap.min.css' rel='stylesheet'>
		    <link href='css/bootstrap-responsive.min.css' rel='stylesheet'>
			<link href='css/style.css' rel='stylesheet'>
			<link href='css/slider1.css' rel='stylesheet'>
			<link href='css/slider2.css' rel='stylesheet'>
			<link href='css/slider3.css' rel='stylesheet'>
			<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700'>
			<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Droid+Serif'>
			<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Boogaloo'>
			<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Economica:700,400italic'>

		    <link href='css/container.css' rel='stylesheet'>
		    <link href='css/parking-spaces.css' rel='stylesheet'>
		    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css'>
			<!-- end: CSS -->
		";
	}

	function getNavBar(){
		global $Username;		

		global $db;
		db_connect();
		if(isset($_SESSION['UserID'])){
			$user_id = $_SESSION['UserID'];
			$adminCheck = "";
			$sql = "SELECT UserTypeID FROM User WHERE UserID = $user_id AND UserTypeID = 1";
			$result = $db->query($sql);

			if ($result->num_rows > 0) {
				$adminCheck = "<li><a href='admin.php'>Admin</a></li>";
			}
		}
		

		if(!loggedIn()){
			$userSignIn = "<li><a href='signin.php' class='home'>Sign In</a> | <a href='register.php' class='home'>Register</a></li>";
		}else{
			$userSignIn = "<li class='dropdown'>
								<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>" . $Username . "</a>
								<ul class='dropdown-menu'>
									<li><a href='account.php' class='home'>My Account</a></li>
									<li><a href='quickBook.php'>Quick Book</a></li>". $adminCheck .
									"<li><a href='logout.php'>Logout</a></li>
								</ul>
							</li>";
		}
		echo "<!--start: Container -->
			<style type='text/css'>
				body{
					font-family: 'Crimson Text', serif !important;
					font-size: 20px;
				}
				.home{
					font-family: 'Crimson Text', serif !important;
					font-size: 20px;
				}
			</style>
			<div class='container'>

				<!--start: Row -->
				<div class='row-fluid'>

					<!--start: Navigation -->
					<div class='navigation'> 

						<div class='navbar navbar-fixed-top'>
							<div class='navbar-inner'>
								<a class='btn btn-navbar btnOverlay' data-toggle='collapse' data-target='.nav-collapse'>
								menu
								</a>
								<div class='nav-collapse collapse'>
									<ul class='nav'>
										<li><a href='index.php' class='home'>Home</a></li>
										<li class='dropdown'>
											<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Car Parks</a>
											<ul class='dropdown-menu'>
												<li><a href='citySide.php'>City Side</a></li>
												<li><a href='castleCourt.php'>Castle Court</a></li>
												<li><a href='victoriaSquare.php'>Victoria Square</a></li>
												<li><a href='sseArena.php'>SSE</a></li>				
												<li><a href='titanic.php'>Titanic</a></li>
											</ul>
										</li>
										<li><a href='services.php' class='services'>Services</a></li>
										<li><a href='pricing.php' class='pricing'>Pricing</a></li>
										<li><a href='about.php' class='about'>About</a></li>
										<li><a href='team.php' class='team'>Team</a></li>
										<li><a href='contact.php' class='contact'>Contact</a></li>
									</ul>
									<ul class='nav-right'>"
										. $userSignIn .
									"</ul>
								</div>
							</div>
						</div>
					</div>	
				<!--end: Navigation -->	
				</div>
			<!--end: Row -->
			</div>
			<!--end: Container-->";
	}

	function getFooter(){
		echo "
		<footer>		
			<div id='social'>
				<a href='https://www.facebook.com/pearce.feeley' rel='tooltip' title='Facebook' class='facebook' target='https://www.facebook.com/pearce.feeley'>Facebook</a>
				<a href='https://twitter.com/pearcefeeley' rel='tooltip' title='Twitter' class='twitter' target='https://twitter.com/pearcefeeley'>Twitter</a>
				<a href='http://BootstrapMaster.com/feed/' rel='tooltip' title='RSS' class='rss' target='https://www.rss.com/''>RSS</a>
				<a href='#' rel='tooltip' title='Github' class='github' target='https://github.com/''>Github</a>
				<a href='#' rel='tooltip' title='YouTube' class='youtube' target='https://www.youtube.com/''>YouTube</a>
			</div>				
		</footer>";
	}

	function getScripts(){
		getFooter();
		echo "
		<!-- start: Java Script -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>
		<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js'></script>
		<script type='text/javascript' src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script> 
		<script type='text/javascript' src='scripts/js/isotope.js'></script>
		<script type='text/javascript' src='scripts/js/jquery.imagesloaded.js'></script>
		<script type='text/javascript' src='scripts/js/bootstrap.min.js'></script>
		<script type='text/javascript' src='scripts/js/fancybox.js'></script>
		<script type='text/javascript' src='scripts/js/flexslider.js'></script>
		<script type='text/javascript' src='scripts/js/carousel.js'></script>
		<script type='text/javascript' src='scripts/js/twitter.js'></script>
		<script type='text/javascript' src='scripts/js/modernizr.custom.79639.js'></script>
		<script type='text/javascript' src='scripts/js/jquery.ba-cond.min.js'></script>
		<script type='text/javascript' src='scripts/js/jquery.slitslider.js'></script>
		<script type='text/javascript' src='scripts/js/excanvas.js'></script>
		<script type='text/javascript' src='scripts/js/jquery.flot.min.js'></script>
		<script type='text/javascript' src='scripts/js/jquery.flot.pie.min.js'></script>
		<script type='text/javascript' src='scripts/js/jquery.flot.stack.js'></script>
		<script type='text/javascript' src='scripts/js/jquery.flot.resize.min.js'></script>
		<script defer='defer' src='scripts/js/custom.js'></script>

		<!-- end: Java Script -->";
	}

	function session(){// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect("localhost", "root", "");
		// Selecting Database
		$db = mysql_select_db("company", $connection);
		session_start();// Starting Session
		// Storing Session
		$user_check=$_SESSION['login_user'];
		// SQL Query To Fetch Complete Information Of User
		$ses_sql=mysql_query("select username from login where username='$user_check'", $connection);
		$row = mysql_fetch_assoc($ses_sql);
		$login_session =$row['username'];
		if(!isset($login_session)){
			mysql_close($connection); // Closing Connection
			header('Location: index.php'); // Redirecting To Home Page
		}
	}

	function logout(){
		session_start();
		if(session_destroy()) // Destroying All Sessions
		{
		header("Location: index.php"); // Redirecting To Home Page
		}
	}

	function getUserCars(){
		global $db;
		db_connect();
		$user_id = $_SESSION['UserID'];
		$sql = "SELECT * FROM car WHERE UserID = $user_id";
		$result = $db->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				//echo "<div class='col-lg-12'><label>License Plate</label>" . $row["CarLicensePlate"]. "<br/>Car Model - " . $row["CarType"] ."</>";

				echo "<tr>
						<td>".$row["CarLicensePlate"]."</td>
						<td>".$row["CarType"]."</td>
						<td><form action='scripts/php/removeCar.php' method='post'>
						<input type='hidden' name='carLicensePlate' value='".$row["CarLicensePlate"]."'/>
						<input type='submit' class='btn btn-danger topMargin' value='X'/>
						</form></td>
						</tr>";

			}
		}
		$db->close();
		
	}

	function getUserCarsList(){
		global $db;
		db_connect();
		$user_id = $_SESSION['UserID'];
		$sql = "SELECT * FROM car WHERE UserID = $user_id";
		$result = $db->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row

			echo "<select class='form-control' id='carSelected' name='carSelected' required>
					<option value='' selected='true' disabled='disabled'>Choose from list";
					$count = 1;
			while($row = $result->fetch_assoc()) {
				echo "<option value='Car". $count. "'>" .$row["CarType"]. " - " . $row["CarLicensePlate"] . "</option>";
			}
			echo "</option>
				</select>";
		}
		$db->close();
		
	}

	function getUserFirstName(){
		global $db;
		db_connect();
		$user_id = $_SESSION['UserID'];
		$sql = "SELECT * FROM user WHERE UserID = $user_id";
		$result = $db->query($sql);


		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				//echo "<div class='col-lg-12'><label>License Plate</label>" . $row["CarLicensePlate"]. "<br/>Car Model - " . $row["CarType"] ."</>";

				if(empty($row["FirstName"])){
					echo "<p class='missingInfo'>*Please provide your first name*</p>";
				}else{
					echo "<tr>
						<td>".$row["FirstName"]."</td>
						</tr>";
				}
			}
		}else{
			echo "<tr>
						<td></td>
						</tr>";
		}
		$db->close();
		
	}

	function getUserLastName(){
		global $db;
		db_connect();
		$user_id = $_SESSION['UserID'];
		$sql = "SELECT LastName FROM user WHERE UserID = $user_id";
		$result = $db->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				//echo "<div class='col-lg-12'><label>License Plate</label>" . $row["CarLicensePlate"]. "<br/>Car Model - " . $row["CarType"] ."</>";
				if(empty($row["LastName"])){
					echo "<p class='missingInfo'>*Please provide your last name*</p>";
				}else{
					echo "<tr>
						<td>".$row["LastName"]."</td>
						</tr>";
				}				
			}
		}else{
			echo "<tr>
					<td></td>
					</tr>";
		}

		$db->close();
		
	}

	function getUserAddress(){
		global $db;
		db_connect();
		$user_id = $_SESSION['UserID'];
		$sql = "SELECT Address FROM user WHERE UserID = $user_id";
		$result = $db->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				//echo "<div class='col-lg-12'><label>License Plate</label>" . $row["CarLicensePlate"]. "<br/>Car Model - " . $row["CarType"] ."</>";
				if(empty($row["Address"])){
					echo "<p class='missingInfo'>*Please provide an address*</p>";
				}else{
					echo "<tr>
						<td>".$row["Address"]."</td>
						</tr>";
				}				
			}
		}else{
			echo "<tr>
					<td></td>
					</tr>";
		}

		$db->close();
		
	}

	function getUserContactNumber(){
		global $db;
		db_connect();
		$user_id = $_SESSION['UserID'];
		$sql = "SELECT ContactNumber FROM user WHERE UserID = $user_id";
		$result = $db->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				//echo "<div class='col-lg-12'><label>License Plate</label>" . $row["CarLicensePlate"]. "<br/>Car Model - " . $row["CarType"] ."</>";
				if(empty($row["ContactNumber"])){
					echo "<p class='missingInfo'>*Please provide a contact number*</p>";
				}else{
					echo "<tr>
						<td>".$row["ContactNumber"]."</td>
						</tr>";
				}				
			}
		}else{
			echo "<tr>
					<td></td>
					</tr>";
		}

		$db->close();
		
	}

	function register(){
		//Collecting the user inputs and assigning them.
		$Username = $_POST['username'];
		$Email = $_POST['email'];
		$Password = $_POST['password'];
		//Picking up on the users password and hashing it so that it is stored securely.
		$hashed_password = password_hash($Password, PASSWORD_DEFAULT);
		
		//Checking that all the required feilds are set.
		if (!isset($Username) || !isset($Email) || !isset($Password))
		{
			//Error message telling the user something isn't filled in correctly.
			echo "<p>You have not entered all the required details.<br />
			Please go back and try again.</p>";
			exit;
		}else{		
			/*	This commented code is unsafe from SQL Injection.
				It has been included into the code to show an alternative way of
				adding items into a database.
			

				//Unsafe item inclusion.
				$query = "INSERT INTO users (Firstname, Surname, Username, Password) 
				VALUES ('$Firstname', '$Surname', '$Username', '$Password')";		
				if($db->query($query) === TRUE){
					echo "Info inserted";
				}else{
					echo "Error";
				}		
				$db->close();
			*/
			
			$sql = "SELECT UserID, Username, EmailAddress, CreationDate FROM Users WHERE Username = '$Username'";
			$result = $db->query($sql);
			
			//Checking that the number of results returned by the sql is greater than 0. If it is then can't create user.
			if($result->num_rows > 0){
				//Error message for the user as the username they've chosen already exists.
				$Header = "Unsuccessful";
				$SubHead = "Username Already Exists";
				$Message = "<p>Please click <a href='SiginIn.php'>here</a> to go back and try again</p>";
			}else{
				//Creating a new user in the database.
				$query = "INSERT INTO users (Username, EmailAddress, Password) VALUES (?, ?, ?)";
			
				$stmt = $db->prepare($query);
				$stmt->bind_param('sss', $Username, $Email, $hashed_password);
				if(false === $stmt){
					echo "Prepare Failed";
					exit;
				}		
				$stmt->execute();
				
				//Checking that the new user has been inputted.
				if ($stmt->affected_rows > 0)
				{
				 //echo "<p>New User inserted into the database.</p>";
				}
				else
				{
				 //echo "<p>An error has occurred.<br/>		 The item was not added.</p>";
				}
				//Outputting the information to the screen for the user to see.
				$Header = "User Registration";
				$SubHead = "New User";
				$Message = "<p>Username: $Username</p>
							<p>Email: $Email</p>";
			}
			
			
			//Closing the Database connection.
			$db->close();
			
		}
	}

	function loggedIn(){
		if(isset($_SESSION['UserID']) && $_SESSION['UserID'] > 0){
			return true;
		}else{
			return false;
		}
	}

	if(isset($_SESSION['UserID'])){
		db_connect();
		$user_id = $_SESSION['UserID'];
		$sql = "SELECT * FROM user WHERE UserID = $user_id";
		$result = $db->query($sql);
		$user = $result->fetch_assoc();
		$Username = $user['Username'];
		$Email = $user['EmailAddress'];
		$CreationDate = $user['CreationDate'];
	}

	function getCarPark($CarParkID){

		
				global $db;
				db_connect();
				if(isset($_SESSION['UserID'])){					
					$user_id = $_SESSION['UserID'];

					//Getting Each floor depending on the carParkID
					$sql = "SELECT DISTINCT FloorNumber FROM space WHERE CarParkID = $CarParkID";
					$result = $db->query($sql);	
					if ($result->num_rows > 0) {
						// output data of each row
						echo "
	  						<ul class='nav nav-tabs topMargin'>";

	  					//Looping to find the amount floors in the carPark
						while($row = $result->fetch_assoc()) {
							echo "<li><a data-toggle='tab' href='#floor".$row["FloorNumber"]."'>Floor ".$row["FloorNumber"]."</a></li>";
						};

						echo "</ul>";

						//Turning the amount of floors into different tabs with different content for each floor.
						$sql = "SELECT DISTINCT FloorNumber FROM space WHERE CarParkID = $CarParkID";
						$result = $db->query($sql);	
						if($result->num_rows > 0) {

							echo "<div class='tab-content'>

								<div id='floor" . $row["FloorNumber"] . "' class='tab-pane active in home'>
									<img class='img-responsive' src='img/carparks/CastleCourt.jpg' alt='Castle Court Shopping Center Image' />
								</div>";

							while($row = $result->fetch_assoc()) {
							
								echo "
										<div id='floor" . $row["FloorNumber"] . "' class='tab-pane fade'>

											<table id='carPark" . $row["FloorNumber"] . "' class='dataTable'>
												<thead>";

												$sqlTH = "SELECT DISTINCT SpaceColumn FROM space WHERE FloorNumber = " . $row["FloorNumber"] . " AND CarParkID = $CarParkID";
												$resultTH = $db->query($sqlTH);
												if($resultTH->num_rows > 0){
													while($rowTH = $resultTH->fetch_assoc()){
														if(empty($rowTH["SpaceColumn"])){
															echo "Error";
														}else{
															echo "<th></th>";
														}
													}
												}else{
													echo "here";
												}									
												echo "</thead>
												<tbody>";
													

													//TODO: loop TD's so we can pivot the parking spaces.

													$sql1 = "SELECT DISTINCT SpaceRow FROM space WHERE CarParkID = $CarParkID AND FloorNumber = " . $row["FloorNumber"] ."";
													
													$result1 = $db->query($sql1);	
													if($result1->num_rows > 0) {

														while($row1 = $result1->fetch_assoc()){
															if(empty($row1["SpaceRow"])){

																echo "<td>hello</td>";
															}else{


																echo "<tr id='row". $row1["SpaceRow"] ."'>";

																	$sql2 = "SELECT DISTINCT `SpaceID`, `CarParkID`, `FloorNumber`, `SpaceRow`, `SpaceColumn`,`space`.SpaceTypeID, `spacetype`.`SpaceType` FROM `space` inner JOIN `spacetype` ON `space`.`SpaceTypeID` = `spacetype`.`SpaceTypeID` WHERE CarParkID = $CarParkID AND FloorNumber = " . $row["FloorNumber"] ." AND `SpaceRow` = ". $row1["SpaceRow"] . " ORDER BY SpaceID";
																	//var_dump($sql2);
																	$result2 = $db->query($sql2);	
																	if($result2->num_rows > 0) {
																		while ($row2 = $result2->fetch_assoc()) {
																			if(empty($row2["SpaceColumn"])){

																				echo "<td>hello</td>";
																			}else{
																				//todo borders in the grid and icons for cars
																				echo "<td id='".$row2["SpaceID"]."' class='column".$row2["SpaceColumn"]. " " .$row2["SpaceType"]."'>&nbsp;</td>";
																			}
																		}
																	}else{
																		echo "error";
																	}
																echo "</tr>";

															}
														}


													}else{
														echo "<td>world</td>";
													}
													echo "</tr>
												</tbody>
											</table>
										</div>";
	
							};
							echo "</div>";
						}

					}else{
						echo "Error";
					}
					$db->close();
				}else{
					echo "Log in";
				}
	}

	function getFloors($CarParkID){
		global $db;
		db_connect();
		$user_id = $_SESSION['UserID'];

		//Getting Each floor depending on the carParkID
		$sql = "SELECT DISTINCT FloorNumber FROM space WHERE CarParkID = $CarParkID";
		$result = $db->query($sql);	
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {				
				if(empty(!$row["FloorNumber"])){
					echo "
					$(document).ready(function() {
						$('#carPark". $row["FloorNumber"] ."').DataTable({
							'searching': false,
							'paging': false,
							'info': false,
							'ordering': false
						});
					});";
				}
			};
		}
	}

?>