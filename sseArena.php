<?php
  include_once("scripts/php/AP_Functions.php")
?>
<!DOCTYPE html>
<html lang="en">
	<head>

		<title>Accelerated Parking - </title> 
		<?php getHeadTag() ?>

		<?php getScripts() ?>

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
						<div class="col-md-3 col-md-offset-1 col-xs-12 registrationBox">
							<h2 class="topMargin" style="text-align: center;">Details</h2>
							<hr />

							<div class="row">
								<div class="col-xs-12 col-md-10 col-md-offset-1">
									<h2>Arrival:</h2>
									<input class="form-control" id="arrival" name="arrival" />
									<script type="text/javascript">
										$(function(){
											$("#arrival").datetimepicker({
												step: 10,
												minDate: 0,
											});
										});
									</script>									
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-md-10 col-md-offset-1">
									<h2>Departure:</h2>
									<div class="form-group">
										<input class="form-control" id="departure" name="departure" />
									</div>
									<script type="text/javascript">
										$(function(){
											$("#departure").datetimepicker({
												step: 10,
												minDate: 0,
											});
										});
									</script>									
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-md-10 col-md-offset-1">
									<h2>Car:</h2>
									<div class="form-group">
										<?php getUserCarsList(); ?>
									</div>
								</div>
							</div>
							<div class="topMargin">&nbsp</div>

						</div>
					</div>
				</div>
			</div>
		</form>

		<div class="carPark container topMargin">

			<?php getCarPark('4'); ?>
				
		</div>


</body>
</html>