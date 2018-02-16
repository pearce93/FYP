<?php

	include_once("scripts/php/AP_Functions.php");

	registerUser();
	
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
			<div class="col-lg-offset-4 col-lg-4 text-center registrationBox">
				<h1 class="topMargin"><?php echo $Header; ?></h1>
				<hr/>
				<h2><?php echo $SubHead; ?></h2>

				<?php echo $Message; ?>

				<p>or wait to be redirected in <span id="counter">15</span> second(s).</p>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function countdown() {
			var i = document.getElementById('counter');
			if (parseInt(i.innerHTML)<=0) {
				location.href = 'register.php';
			}
			i.innerHTML = parseInt(i.innerHTML)-1;
		}
		setInterval(function(){ countdown(); },1500);
	</script>
    <?php getScripts() ?>

</body>
</html>