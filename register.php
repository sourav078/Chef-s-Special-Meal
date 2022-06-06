<?php 
  
  require 'db_config.php';

  function fetch_all_data_usingPDO($pdo,$sql)
  {
    
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $row = $statement->fetchAll();

    return $row;
  }

  
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <title>Home Food</title>
    
    <!--Fabicon Image-->
    <link rel="shortcut icon"  href="../f-black.png">
    <!-- vendor css -->
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">


    <!-- Starlight CSS -->
    <link rel="stylesheet" href="css/starlight.css">
  </head>

  <body>

    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
        <div class="signin-logo tx-center tx-24 tx-bold tx-inverse"><a href="index.php">Chef's Special Meal</a></div>
        <div class="tx-center mg-b-60">Register with valid Information</div>

        <form action="action.php" method="POST">

          <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
          </div><!-- form-group -->


        	<div class="form-group">
	          <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
	        </div><!-- form-group -->

          <div class="form-group">
            <input type="text" class="form-control" name="phone" placeholder="Enter your phone" required>
          </div><!-- form-group -->

          <div class="form-group">
            <input type="radio" value="USER"  name="user_type" id="user_type1"  > <label for="user_type1">User</label>

            &nbsp&nbsp&nbsp&nbsp
            
            <input type="radio" value="SELLER" name="user_type" id="user_type2" > <label for="user_type2">Seller</label>
          </div><!-- form-group -->

          <div class="form-group mg-b-10-force" id="DIVISION">
                  <label class="form-control-label">Location:</label>
                   <select class="form-control" name="location">
                      <option value="Barishal">Barishal</option>
                      <option value="Chittagong">Chittagong</option>
                      <option value="Dhaka" selected>Dhaka</option>
                      <option value="Khulna">Khulna</option>
                      <option value="Mymensingh">Mymensingh</option>
                      <option value="Rajshahi">Rajshahi</option>
                      <option value="Rangpur">Rangpur</option>
                      <option value="Sylhet">Sylhet</option>
                    </select>
                </div>
              

               
          
          <div class="form-group">
            <input type="text" class="form-control" name="address" placeholder="Enter your Address" required>
          </div><!-- form-group -->

         <div class="form-group">
	          <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
	          
	        </div><!-- form-group -->
        
        <button type="submit" name="btn-register_user" class="btn btn-info btn-block">Sign Up</button>

        <hr>


        

        <a href="index.php" class="btn btn-success btn-block">Login</a>

        
        </form>
        
      </div><!-- login-wrapper -->
    </div><!-- d-flex -->

    <script>
      
      function myFunctionSchool() {
          var x = document.getElementById('SCHOOL');
          var y = document.getElementById('DIVISION');
          if (x.style.display === "none") {
            x.style.display = "block";
            y.style.display = "none";
          } else {
            x.style.display = "none";
          }
        }

        function myFunctionDivision() {
          var x = document.getElementById('DIVISION');
          var y = document.getElementById('SCHOOL');
          if (x.style.display === "none") {
            x.style.display = "block";
            y.style.display = "none";
          } else {
            x.style.display = "none";
          }
        }

    </script>
    <script src="lib/jquery/jquery.js"></script>
    <script src="lib/popper.js/popper.js"></script>
    <script src="lib/bootstrap/bootstrap.js"></script>

  </body>
</html>

