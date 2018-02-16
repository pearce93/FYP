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


		<form action="welcome.php" method="post">
			<div class="carPark container topMargin registrationBox">
				<div class="row">
					<div class="col-lg-12">

						<h1 class='text-center topMargin'>Select Parking Space</h1>
						<hr>
					</div>
				</div>
				<div class='row'>
					<div class="col-lg-9 ">
						<?php getCarPark('2'); ?>
					</div>


					<div class='col-lg-3'>
						<div class="form-group">
							<div class="row">
								<div class="col-lg-12">
									<label for="carSelected">Car:</label>
									<div class="form-group">
										<?php getUserCarsList(); ?>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12">
									<div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
    </div>
</div>
									<label for="carSelected">Start of Stay:</label>
									<div class="form-group">
										<?php getUserCarsList(); ?>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12">
									<label for="carSelected">End of Stay:</label>
									<div class="form-group">
										<?php getUserCarsList(); ?>
									</div>
								</div>
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

</body>
</html>