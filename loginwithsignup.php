<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"> Welcome to Smart Fitness! <br> Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form  action="" method="POST" />
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="Email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="Password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->


                               <input type="submit" class="btn btn-lg btn-success btn-block" value="Login" name="Submit"/>


                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php

if(isset($_POST["Submit"]))
{
$Domain="localhost";
$User="Andrew";
$Password="2543home";
$Database="SeniorDFit";

$con = mysqli_connect($Domain,$User, $Password,$Database);
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: EX PERFORM FAILED  " . mysqli_connect_error();
}

$Email = $_POST['Email'];
$Password = $_POST['Password'];
$DatabaseCall ="User_Data"; //Profile_ID

mysqli_select_db($con,SeniorDFit) or die('Could not select database');
$query="SELECT*FROM $DatabaseCall WHERE Email='$Email' AND Password='$Password'";
//$query="Show DATABASES";
//$query="Select*From User_Data WHERE Email='att11@zips.uakron.edu' And Password='1234'";
$result = mysqli_query($con,$query) or die('Query failed: ' . mysqli_error());
$AnyEffect=mysqli_affected_rows($con);

if ($AnyEffect==0) {
$DatabaseCall ="Trainer_Data";
$query="SELECT*FROM $DatabaseCall WHERE Email='$Email' AND Password='$Password'";
$result = mysqli_query($con,$query) or die('Query failed: ' . mysqli_error());
$AnyEffect=mysqli_affected_rows($con);
}

if ($AnyEffect==0) {?>
  <h4>
      <div class="col-md-4 col-md-offset-4">
    <?php
echo "Email and Password combination incorrect.";

 ?>
 <br>
   <?php
   echo"Please try again.";
?>
</div>
</h4>
  <?php
}
else{
session_start();
$_SESSION['Password']=$Password;
$_SESSION['Email']=$Email;
$_SESSION['Database']=$DatabaseCall;
echo "Success";
$query="SELECT*FROM Profile_ID WHERE Email='$Email'";
$result = mysqli_query($con,$query) or die('Query failed: ' . mysqli_error());
$check = mysqli_fetch_array($result);
if ($check['Account_Type']==3){
$newURL="Andrew_Fit_Interface.html";
header('Location: '.$newURL);
}
elseif ($check['Account_Type']==2) {

$newURL="Trainer_Splash_Screen.php";
header('Location: '.$newURL);
}
else{
$newURL="Student2.php";
header('Location: '.$newURL);
}
}
}
else {
}

    ?>
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
