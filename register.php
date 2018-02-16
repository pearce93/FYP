<?php
	include_once("scripts/php/AP_Functions.php");
	if(isset($_SESSION['login_user'])){
		header("location: profile.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>

		<title>Accelerated Parking - </title> 
		<?php getHeadTag() ?>

	</head>
	<body>
		<!--start: Header -->
		<header>		
			<?php getNavBar() ?>	
		</header>
		<!--end: Header-->
	
		<div class="container topMargin">
			<div class="row">
				<div class="col-lg-offset-3 col-lg-6 registrationBox">
					<h1 class="topMargin text-center">Registration</h1>
					<hr/>
					<form action="registration.php" onsubmit="return passwordCheck()" method="post">
						<div class="row">
							<div class="col-lg-offset-2 col-lg-4">
								<label>Username:</label>
							</div>
							<div class="col-lg-6 registrationBoxLabel">
								<input type="text" class="form-control" name="username" required placeholder="Username"/>
							</div>
						</div>
						<br/>
						<div class="row">
							<div class="col-lg-offset-2 col-lg-4">
								<label>Email:</label>
							</div>
							<div class="col-lg-6">
								<input type="email" class="form-control" name="email"pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required placeholder="Email Address"/>
							</div>
						</div>
						<br/>
						<div class="row">
							<div class="col-lg-offset-2 col-lg-4">
								<label>Password:</label>
							</div>
							<div class="col-lg-6">
								<input id="password" type="password" class="form-control" name="password" required placeholder="Password"/>
							</div>
						</div>
						<br/>
						<div class="row">
							<div class="col-lg-offset-2 col-lg-4">
								<label>Confirm Password:</label>
							</div>
							<div class="col-lg-6">
								<input id="confirmPassword" type="password" class="form-control" name="confirmPassword" required placeholder="Confirm Password"/>
							</div>
						</div>
						<br/>
						<div class="row">
							<div class="col-lg-offset-4 col-lg-4">
								<input class="btn btn-success btn-block" type="submit" value="Register" />
							</div>
						</div>
						<hr/>
						<div class="row">
							<div class="col-lg-offset-10 col-lg-2">
								<a href="signin.php">Sign In</a>
							</div>
						</div>
						<br/>
					</form>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			function passwordCheck() {
				var password = document.getElementById("password").value;
				var confirmPassword = document.getElementById("confirmPassword").value;
				var ok = true;
				if (password != confirmPassword) {
					//alert("Passwords Do not match");
					document.getElementById("password").style.borderColor = "#E34234";
					document.getElementById("confirmPassword").style.borderColor = "#E34234";
					ok = false;
					alert("Passwords do not match");
				}
				return ok;
			}
		</script>
		<?php getScripts() ?>

</body>
</html>