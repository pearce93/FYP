<?php
  include_once("scripts/php/AP_Functions.php");

  if (isset( $_POST['Submit'])){
    logout();
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
    <!-- Modal Personal Details  -->
    <div class="modal fade" id="updatePersonalDetails" style="display:none;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="updatePersonalDetails.php" method="post">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h2 class="modal-title" id="exampleModalLabel">Personal Information</h2>        
            </div>
            <div class="modal-body">
              
                <div class="row topMargin">
                  <div class="col-lg-offset-2 col-lg-3">
                    <label>First Name: </label>
                  </div>
                  <div class="col-lg-offset-1 col-lg-4">
                    <input type="text" class="form-control" name="firstName" placeholder="First Name" style="width:  100%;">
                  </div>
                </div>

                <div class="row topMargin bottomMargin">
                  <div class="col-lg-offset-2 col-lg-3">
                    <label>Last Name: </label>
                  </div>
                  <div class="col-lg-offset-1 col-lg-4">
                    <input type="text" class="form-control" name="lastName" placeholder="Last Name" style="width:  100%;">
                  </div>
                </div>

                <div class="row topMargin bottomMargin">
                  <div class="col-lg-offset-2 col-lg-3">
                    <label>Address: </label>
                  </div>
                  <div class="col-lg-offset-1 col-lg-4">
                    <input type="text" class="form-control" name="address" placeholder="Address" style="width:  100%;">
                  </div>
                </div>

                <div class="row topMargin bottomMargin">
                  <div class="col-lg-offset-2 col-lg-3">
                    <label>Contact Number: </label>
                  </div>
                  <div class="col-lg-offset-1 col-lg-4">
                    <input type="text" class="form-control" name="contactNumber" placeholder="Contact Number" style="width:  100%;">
                  </div>
                </div>                
            </div>
            <div class="modal-footer">
              <div class="row">
                <div class="col-lg-2">
                  <a href="" data-dismiss="modal">Close</a>
                </div>
                <div class="col-lg-offset-8 col-lg-2">
                  <a href="index.php">Save</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="addCar" style="display:none;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="scripts/php/addCar.php" method="post">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h2 class="modal-title" id="exampleModalLabel">Add Car</h2>        
            </div>
            <div class="modal-body">
              
                <div class="row topMargin">
                  <div class="col-lg-offset-1 col-lg-4">
                    <label>Car License Plate: </label>
                  </div>
                  <div class="col-lg-offset-1 col-lg-4">
                    <input type="text" class="form-control" name="carLicensePlate" placeholder="Car License Plate" style="width:  100%;" required="">
                  </div>
                </div>

                <div class="row topMargin bottomMargin">
                  <div class="col-lg-offset-2 col-lg-3">
                    <label>Car Model: </label>
                  </div>
                  <div class="col-lg-offset-1 col-lg-4">
                    <input type="text" class="form-control" name="carModel" placeholder="Car Model" style="width:  100%;" required="">
                  </div>
                </div>                
            </div>
            <div class="modal-footer">
              <div class="row">
                <div class="col-lg-2">
                  <a href="" data-dismiss="modal">Close</a>
                </div>
                <div class="col-lg-offset-8 col-lg-2">
                  <input id="addCar" class="btn btn-primary" type="submit" name="submit" value="Save"> 
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="container topMargin">
      <div class="row">
        <div class="col-lg-9">
          <div class="row">
            <div class="col-lg-11 registrationBox bottomMargin">
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
                <div class="col-lg-offset-1 col-lg-4">
                  <input type="text" class="form-control" name="address" placeholder="Address" style="width:  100%;">
                </div>
              </div>

              <div class="row topMargin bottomMargin">
                <div class="col-lg-offset-2 col-lg-3">
                  <label>Contact Number: </label>
                </div>
                <div class="col-lg-offset-1 col-lg-4">
                  <input type="text" class="form-control" name="contactNumber" placeholder="Contact Number" style="width:  100%;">
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
        <div class="col-lg-3">
          <div class="row registrationBox">
            <div class="col-lg-12">
              <h1 class="text-center topMargin bottomMargin">Cars</h1>
              <hr>            
              <table class="greyGridTable">
                <tr>
                  <th>License Plate</th>
                  <th>Model</th>
                </tr>
                <?php getUserCars() ?>
              </table>

              <hr/>
              <div class="row topMargin bottomMargin">
                <div class="col-lg-offset-6 col-lg-6">
                  <a href="" data-toggle="modal" data-target="#addCar">Add a Car</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row topMargin">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-12 registrationBox">
                <h1 class="text-center topMargin">Booking History</h1>
                <hr/>
                
                <div class="col-lg-12 bottomMargin">
                  <table class="greyGridTable">
                    <tbody>
                      <tr>
                        <th>Date</th>
                        <th>Car Park</th>
                        <th>Floor</th>                  
                        <th>Space</th>
                      </tr>
                      <tr>
                        <td>12/01/2018</td>
                        <td>Castle Court</td>
                        <td>3</td>
                        <td>173</td>
                      </tr>                      
                    </tbody>
                  </table>
                  <hr/>
                  <div class="col-lg-offset-10 col-lg-2">
                    <a href="">Create a Booking</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="row topMargin">
              <div class="col-lg-12 registrationBox">
                <h1 class="text-center topMargin">Favourites</h1>
                <hr/>
                
                <div class="col-lg-12 bottomMargin">
                  <div class="table-responsive">          
                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Date</th>
                          <th>Car Park</th>
                          <th>Floor</th>                  
                          <th>Space</th>
                          <th>Car Details</th>
                          <th>Times Visited</th>
                        </tr>
                      </thead>
                      <tbody>                      
                        <tr>
                          <td>1</td>
                          <td>12/01/2018</td>
                          <td>Castle Court</td>
                          <td>3</td>
                          <td>173</td>
                          <td>MEZ 7024 - Ford Focus</td>
                          <td>14</td>
                          <td><img src="img/">
                        </tr>                      
                      </tbody>
                    </table>
                    </div>
                  <hr/>
                </div>
              </div>
            </div>

          </div>
      </div>        
    </div>

    <?php getScripts() ?>
  </body>
</html>