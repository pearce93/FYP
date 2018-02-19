<?php
  include_once("scripts/php/AP_Functions.php")
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
	
		<form>
			<div class="carPark container topMargin">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-md-8 col-xs-12 registrationBox">
							<h2 class="topMargin" style="text-align: center;">Choose Parking Space</h2>
							<hr />
							<?php getCarPark('2'); ?>
						</div>
						<div class="col-md-3 col-xs-12 registrationBox">
							<h2 class="topMargin" style="text-align: center;">Details</h2>
							<hr />

							<div class="row">
								<div class="col-xs-12">
									<div class="col-xs-12 col-md-6"><label>Arrival Date</label></div>
									<div class="form-group">
										<label for="exampleInputEmail1">Email address</label>
										<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
										<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Password</label>
										<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
									</div>
									<div class="form-check">
										<input type="checkbox" class="form-check-input" id="exampleCheck1">
										<label class="form-check-label" for="exampleCheck1">Check me out</label>
									</div>
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>

		<div class="carPark container topMargin">

			<?php getCarPark('4'); ?>
				
		</div>


		<?php getScripts() ?>

</body>
</html>