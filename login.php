<!DOCTYPE html>

<?php
  include_once("scripts/php/AP_Functions.php");
  session_start();
  if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
    header("Location: success.php");
  }
?>

<html>
  <head>
     <title>Accelerated Parking - </title> 
    <?php getHeadTag() ?>
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text" rel="stylesheet">

  </head>
  <body>
    <!--start: Header -->
    <header>    
      <?php getNavBar() ?>  
    </header>
    <!--end: Header-->

    <div class="container topMargin">
      <div class="row">
        <div class="registrationBox col-lg-offset-3 col-lg-6">

        <h1 class="topMargin text-center">Sign In</h1>
        <hr/>
        
        <form action="practical31.php" method="post">
          <div class="row">
            <div class="col-lg-offset-2 col-lg-4">
              <label>Username:</label>
            </div>
            <div class="col-lg-6">
              <input type="text" class="form-control" name="userName" placeholder="Enter Username" required/>
            </div>
          </div>
          <br/>
          <div class="row">
            <div class="col-lg-offset-2 col-lg-4">
              <label>Password:</label>
            </div>
            <div class="col-lg-6">
              <input type="password" class="form-control" name="password" placeholder="Enter Password" required/>
            </div>
          </div>
          <br/>
          <div class="row">
            <div class="col-lg-offset-4 col-lg-5">
              <input class="btn btn-success btn-block" type="submit" value="Submit" />
            </div>
          </div>
            <hr/>
            <div class="row">
              <div class="col-lg-offset-10 col-lg-2">
                <a href="register.php">Register</a>
              </div>
            </div>
          <br/>
        </form>
      </div>
    </div>
  </div>

    <?php getScripts() ?>
  </body>
</html>