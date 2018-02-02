<?php
  include_once("scripts/php/AP_Functions.php")
?>
<!DOCTYPE html>
<html lang="en">
	<head>

		<title>Accelerated Parking - </title> 
		<?php getHeadTag() ?>
		<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
		
	</head>
	<body>
		<!--start: Header -->
		<header>
			<?php getNavBar() ?>	
		</header>
		<!--end: Header-->


		<form action="welcome.php" method="post">
			<div class="carPark container topMargin registrationBox">
				<div class="row">
					<div class="col-lg-12">

						<h1 class='text-center topMargin'>Select Parking Space</h1>
						<hr>
					</div>
				</div>
				<div class='row'>
					<div class="col-lg-8">
						<?php getCarPark('2'); ?>
					</div>
					<div class='col-lg-4 topMargin'>
						<div class="col-lg-12">
							<label for="carSelected">Car:</label>
							<div class="form-group">
								<?php getUserCarsList(); ?>
							</div>
						</div>
						<div class="col-lg-12">
							<label>Start Stay</label>
							<div class="form-group">
								<input class="form-control" type="text" id="startStay" name="startStay" /><br><br>
							</div>
						</div>
						<div class="col-lg-12">
							<label>End Stay</label>
							<div class="form-group">
								<input class="form-control" type="text" id="endStay" name="endStay" /><br><br>
							</div>
						</div>
					</div>
				</div>
			</div>

			
		</form>
		
		<?php getScripts() ?>

		<script type="text/javascript">
			var idList = [];
			<?php getFloors('2'); ?>

			$("table > tbody > tr").on("click", "td", function() {
				
				var cellID = $(this).attr('id');
				
				if(jQuery.inArray(cellID, idList) !== -1){
					for(var i = idList.length-1; i>=0; i--){
						if(idList[i] === cellID){
							idList.splice(i, 1);
						}
					}
				}else{
					idList.push(cellID);
				}
				
				console.log(idList);
			});
		</script>

		<script>

			
			var dateToday = new Date();

			$('#startStay').datetimepicker({
				value:'' + dateToday,
				numberOfMonths: 3,
				showButtonPanel: true,
				minDate: dateToday,
				hourMin: 8,
				hourMax: 16
			});

			$('#endStay').datetimepicker({
				value:'',
				numberOfMonths: 3,
				showButtonPanel: true,
				minDate: dateToday
			});

		</script>


</body>
</html>