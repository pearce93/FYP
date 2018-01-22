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

		<div class="container topMargin">
			<div class="row">
				<div class="col-lg-12 registrationBox">
					<div class='col-sm-6'>Test</div>
					<div class="col-lg-6">Test</div>
				</div>
			</div>			
		</div>
		<div class="carPark container topMargin">
			<?php getCarPark('2'); ?>				
		</div>

		
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