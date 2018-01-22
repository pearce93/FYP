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


		<div class="carPark container topMargin">

			<?php getCarPark('2'); ?>
				
		</div>
		
		<?php getScripts() ?>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#example').DataTable();
			} );
		</script>

</body>
</html>