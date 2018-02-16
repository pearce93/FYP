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
            <div class=" registrationBox bottomMargin">
              <h1 class="text-center topMargin">Personal Information</h1>
              <hr>
              <div class="row topMargin">
                <div class="col-lg-offset-2 col-lg-3">
                  <label>First Name: </label>
                </div>
                <div class="col-lg-offset-1 col-lg-4">
                  <?php getUserFirstName() ?>
                </div>
              </div>

              <div class="row topMargin bottomMargin">
                <div class="col-lg-offset-2 col-lg-3">
                  <label>Last Name: </label>
                </div>
                <div class="col-lg-offset-1 col-lg-4">
                  <?php getUserLastName() ?>
                </div>
              </div>

              <div class="row topMargin bottomMargin">
                <div class="col-lg-offset-2 col-lg-3">
                  <label>Address: </label>
                </div>
                <div class="col-lg-offset-1 col-lg-5">
                  <?php getUserAddress() ?>
                </div>
              </div>

              <div class="row topMargin bottomMargin">
                <div class="col-lg-offset-2 col-lg-3">
                  <label>Contact Number: </label>
                </div>
                <div class="col-lg-offset-1 col-lg-4">
                  <?php getUserContactNumber() ?>
                </div>
              </div>
              <hr/>
              <div class="row topMargin bottomMargin">
                <div class="col-lg-offset-10 col-lg-2">
                  <a href="" data-toggle="modal" data-target="#updatePersonalDetails">Update</a>
                </div>
              </div>
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