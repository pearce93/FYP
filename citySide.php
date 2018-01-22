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

        <?php getCarPark('1'); ?>

    </div>

    <?php getScripts() ?>

    <script type="text/javascript">
      $(document).ready(function() {
        console.log("Hello");
        $('#example').DataTable({
          responsive: true,
          "ordering": false,
          "searching": false,
          "paging": false,
              "info": false,
              "stripeClasses": []
        });
      } );
    </script>

</body>
</html>