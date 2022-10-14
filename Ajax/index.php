<?php
include("../connection.php");
session_start();
 print_r($_SESSION);
if(isset($_POST['sakshi'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $passmd5=md5($password);
    

$query = "SELECT * FROM dependent where mobile_no='$username' and password ='$passmd5'" ;

$run_query =mysqli_query($conn,$query);
$fetch_all=mysqli_fetch_assoc($run_query);
//print_r($fetch_all);
//die;
$user_name=$fetch_all['name'];
$_SESSION['username']=$user_name;
$_SESSION['usertype']="sakshi_singh";


$rows_query=mysqli_num_rows($run_query);
if($rows_query>0){?>

    <script>
    location='data.php';
    </script>
    <?php
}

}

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Bootstrap Example</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
      <!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
   </head>
   <body>
      <div class="container">
      <h2>Form </h2>
      <form action="" method="POST">
  <!-- Email input -->
  <div class="form-outline mb-4">
    <input type="text" id="form2Example1" class="form-control" name="username"/>
    <label class="form-label" for="form2Example1">Email address</label>
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <input type="password" id="form2Example2" class="form-control" name="password" />
    <label class="form-label" for="form2Example2">Password</label>
  </div>

  <!-- 2 column grid layout for inline styling -->
  <div class="row mb-4">
    <div class="col d-flex justify-content-center">
      <!-- Checkbox -->
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
        <label class="form-check-label" for="form2Example31"> Remember me </label>
      </div>
    </div>

    <div class="col">
      <!-- Simple link -->
      <a href="#!">Forgot password?</a>
    </div>
  </div>

  <!-- Submit button -->
  <input type="submit" name="sakshi" class="btn btn-primary btn-block mb-4">Sign in</button>

  <!-- Register buttons -->
  <div class="text-center">
    <p>Not a member? <a href="#!">Register</a></p>
    <p>or sign up with:</p>
    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-facebook-f"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-google"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-twitter"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-github"></i>
    </button>
  </div>
</form>
      </div>
   </body>
   </html>