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

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
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

<?php
session_start();

$Account_Databases=$_SESSION['Database'];
$First_Names=$_SESSION['User_FName'];
$Last_Names=$_SESSION['User_LName'];
$Account_Emails= $_SESSION['Email'];
$Account_Password=$_SESSION['Password'];

$_SESSION['Password']=$Account_Passwords;
$_SESSION['Email']=$Account_Emails;
$_SESSION['Database']=$Account_Databases;


$Domain="localhost";
$User="Andrew";
$Password="2543home";
$Database="SeniorDFit";
session_start();
$Account_Email= $_SESSION['Email'];
$Account_Password=$_SESSION['Password'];
$Account_Database=$_SESSION['Database'];

$con = mysqli_connect($Domain,$User, $Password,$Database);

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: EX PERFORM FAILED  " . mysqli_connect_error();
  }

 mysqli_select_db($con,SeniorDFit) or die('Could not select database');
$query ="SELECT`Trainer_ID`,Trainer_FName,Trainer_LName FROM `Trainer_Data`a WHERE a.Email='$Account_Email'";

$result = mysqli_query($con,$query) or die('Query failed: ID' . mysqli_error());
$line = mysqli_fetch_array($result,MYSQLI_ASSOC);
$Trainer_ID= $line["Trainer_ID"];
$First_Name= $line["Trainer_FName"];
$Last_Name= $line["Trainer_LName"];

session_start();
$_SESSION['Database']=$Account_Database;
$_SESSION['Trainer_FName']=$First_Name;
$_SESSION['Trainer_LName']=$Last_Name;
$_SESSION['Password']=$Account_Password;
$_SESSION['Email']=$Account_Email;
$Today_Date=date("Y-m-d");

?>

    <div id ="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Hi</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="Trainer_Splash_Screen.php">Smart Fitness</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <!-- /.dropdown -->

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="User_Profile.php"><i class="fa fa-user fa-fw"></i>
<?php
echo "$First_Name $Last_Name";
 ?>
                        </a>
                        </li>
                        <a href="About_UsTrain.php"><i class="fa fa-beer fa-fw"></i> About Us</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login2.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                      <li>
                          <a href="Trainer_Personal_Profile.php"><i class="fa fa-user fa-fw"></i> <?php echo"$First_Name $Last_Name";?></a>

                      </li>
                      <li>
                          <a href="Trainers_Students.php"><i class="fa fa-group fa-fw"></i> Your Students</a>

                      </li>

                        <li>
                            <a href="About_UsTrain.php"><i class="fa fa-beer fa-fw"></i> About Us</a>
                        </li>
                        <?php

                        $query="SELECT b.`User_FName`,b.`User_LName`, `Goal_Weight`,`Goal_Reps` FROM `Assigned_Training`a , `User_Data` b WHERE a.`Trainer_ID`= b.`Trainer_ID` AND a.`Trainer_ID`=$Trainer_ID AND `Completion_Date`='$Today_Date'  AND `finish`=0 AND a.`User_ID`=b.`User_ID`";
                        $result = mysqli_query($con,$query) or die('Query failed: issue ' . mysqli_error());
                        $has_assign=true;
                        if (mysqli_num_rows($result) <= 0) {
                          $has_assign=false;
                        }
                        $count=0;
                        $num_rows = mysqli_num_rows($result);
                        if ($num_rows!=0){
                          $Display_Rows=$num_rows;
                          $num_rows=$num_rows+1;

                        $percent=round(100/$num_rows);
                        $percent=$percent;
                        }
                        else{
                          $Display_Rows=0;
                          $percent=100;
                        }
                        ?>
                        <h1> </h1>
                        <h1> </h1>
                        <div class="panel panel-default">
                          <div class="panel-heading">
                          <p><strong><?php echo $Display_Rows;?> Assignments Due Today:</strong></p>
                            <div class="progress progress-striped active">
                              <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent; ?>%">
                                  <span class="sr-only">20% Complete</span>
                              </div>
                            </div>
                          </div>
                        <div class="row">
                                    <div class="col-lg-12">
                                            <!-- /.panel-heading -->
                                            <?php if ($has_assign==false) {

                                              echo"No assignments are due today.";
                                            }
                                            else{?>
                                            <div class="panel-body">
                                                          <table id="Today_Assign"  class="table table-hover" >
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Goal Weight</th>
                                                                <th>Goal Reps</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                          <?php

                                                          if (mysqli_num_rows($result) > 0) {
                                                              // Printing results in HTML
                                                              while ($line = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                                                                ?>
                                                                  <?php
                                                                 foreach ($line as $col_value) {
                                                                   if ($col_value==$line['User_LName']){
                                                                      ;
                                                                    }
                                                                    else{
                                                                   ?>
                                                                   <td>
                                                                   <?php
                                                                   if ($col_value==""){
                                                                     echo "N/A";
                                                                   }
                                                                   else{
                                                                     if ($col_value==$line['User_FName']){
                                                                          $fname=  $line['User_FName'];
                                                                          $lname= $line['User_LName'];
                                                                          $Fullname=$fname." ".$lname;
                                                                     echo "$Fullname";

                                                                   }

                                                                     else{
                                                                    echo  "$col_value";}
                                                                   }
                                                                     ?></td>
                                                                     <?php
                                                                         }
                                                                }
                                                                ?>
                                                                  </tr>
                                                                  <?php

                                                            }
                                                          }

                                                          ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                              <?php } ?>
                                                <!-- /.table-responsive -->

                                            <!-- /.panel-body -->
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                        </div>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <?php
        $query=  "SELECT `Trainer_FName`,`Trainer_LName`,`Age`,`Height`,`Weight`,`Sex`,`Email` FROM `Trainer_Data` WHERE `Trainer_ID`=$Trainer_ID";
        $result = mysqli_query($con,$query) or die('Query failed: ' . mysqli_error());
        $Profile_Val = mysqli_fetch_array($result,MYSQLI_ASSOC);
        if (mysqli_num_rows($result) > 0) {
          $Profile_FName=  $Profile_Val['Trainer_FName'];
          $Profile_LName=  $Profile_Val['Trainer_LName'];
          $Profile_Status= "Trainer";
          $Profile_Age=  $Profile_Val['Age'];
          $Profile_Height=  $Profile_Val['Height'];
          $Profile_Weight=  $Profile_Val['Weight'];
          $Profile_Sex=  $Profile_Val['Sex'];
          $Profile_Email=  $Profile_Val['Email']; }
        ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php
                    echo "$Profile_FName $Profile_LName";
                    ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

<div class="row">
<div class="col-lg-8">
    <div class="panel panel-primary">
        <div class="panel-heading">
            About <?php echo "$Profile_FName:";?>
        </div>
        <div class="panel-body">
            <h4>  <?php
            echo "Name: $Profile_FName  $Profile_LName";?> </h4>
            <h4>  <?php
            echo "<br>Status: $Profile_Status";?> </h4>
            <h4>  <?php
            echo "<br>Age: $Profile_Age ";?> </h4>
            <h4><?php
            echo "<br>Weight: $Profile_Weight ";?> </h4>
            <h4>  <?php
             echo "<br>Height in feet: $Profile_Height ";?> </h4>
            <h4><?php
            echo "<br>Sex: $Profile_Sex";?> </h4>
            <h4> <?php
            echo "<br> Email: $Profile_Email";?> </h4>
        </div>
    </div>
</div>
<div class="col-md-4">
      <div class="thumbnail">
        <a href="/w3images/nature.jpg" target="_blank">
          <img src="https://www.bodybuilding.com/fun/images/2013/4-keys-to-surviving-as-a-trainer-1.jpg" alt="Nature" style="width:100%">
        </a>
      </div>
    </div>
</div>


            <?php
            $query=  "SELECT `User_FName`,`User_LName`,`Age`,`Weight`,`Height`,`Sex`,`Email` FROM `User_Data` WHERE `Trainer_ID`=$Trainer_ID";
            $result = mysqli_query($con,$query) or die('Query failed: ' . mysqli_error());
            // Printing results in HTML
            $Has_Value=true;
          if (mysqli_num_rows($result) <= 0) {
            $Has_Value=false;
          }
          ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <?php echo "$Profile_FName's Students";
                          ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <?php
                          if ($Has_Value==false){
?>
                            <h1> This trainer has no students</h1> <?php
                          }
                          if ($Has_Value==true){?>
                            <table width="100%" class="table table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Age</th>
                                        <th>Weight</th>
                                        <th>Height</th>
                                        <th>Sex</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>

<?php

if (mysqli_num_rows($result) > 0) {
    // Printing results in HTML


    while ($line = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
      ?>
      <tr class="gradeU">
        <?php
       foreach ($line as $col_value) {
         ?>
         <td>
         <?php
           echo $col_value;
           ?></td>
           <?php
      }
      ?>
        </tr>
        <?php
    }
}

?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
<?php }?>


                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>


                <!-- /.col-lg-6 -->

            <!-- /.row -->

        </div>
</div>
</div>
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {

        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>




</body>
</html>
