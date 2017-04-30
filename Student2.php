
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

    <style type="text/css">
    .foo {
      float: left;
      width: 50px;
      height: 20px;
      margin: 5px;
      border: 1px solid rgba(0, 0, 0, .2);
      display: inline;
    }

    .blue {
      background: #31b0d5;
      display: inline;
    }

    .red {
      background: #c9302c;
      display: inline;
    }
    .yellow {
      background: #ec971f;
      display: inline;
    }


    .green {
      background: #5cb85c;
      display: inline;
    }
   </style>

</head>
<?php

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
$query ="SELECT`User_ID`,User_FName,User_LName FROM `User_Data`a WHERE a.Email='$Account_Email'";

$result = mysqli_query($con,$query) or die('Query failed: ' . mysqli_error());
$line = mysqli_fetch_array($result,MYSQLI_ASSOC);
$User_ID= $line["User_ID"];
$First_Name= $line["User_FName"];
$Last_Name= $line["User_LName"];

session_start();
$_SESSION['Database']=$Account_Database;
$_SESSION['User_FName']=$First_Name;
$_SESSION['User_LName']=$Last_Name;
$_SESSION['Password']=$Account_Password;
$_SESSION['Email']=$Account_Email;
$Today_Date=date("Y-m-d");

?>



<body>

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
                <a class="navbar-brand" href="Student2.php">Smart Fitness</a>
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
                        <a href="About_Us.php"><i class="fa fa-beer fa-fw"></i> About Us</a>
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
                            <a href="User_Profile.php"><i class="fa fa-user fa-fw"></i><?php
                            echo "$First_Name $Last_Name";
                            ?></a>
                        </li>
                        <li>
                            <a href="Trainer_Profile.php"><i class="fa fa-user-md fa-fw"></i> Your Trainer</a>

                        </li>
                        <li>
                            <a href="About_Us.php"><i class="fa fa-beer fa-fw"></i> About Us</a>
                        </li>
<?php

$query="SELECT `Completion_Date`, `Goal_Weight`, `Goal_Reps` FROM Assigned_Training a, User_Data b Where (b.User_ID=$User_ID AND b.User_ID=a.User_ID AND `Completion_Date`>=$Today_Date)AND `finish`=0";
$result = mysqli_query($con,$query) or die('Query failed: ' . mysqli_error());
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
    <p><strong><?php echo $Display_Rows;?> Exercies Assignments Remaining:</strong></p>
      <div class="progress progress-striped active">
        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent; ?>%">
            <span class="sr-only">20% Complete</span>
        </div>
      </div>
    </div>
<div class="row">


                    <!-- /.panel-heading -->

                    <div class="panel-body">
                      <?php if ($has_assign==false) {

                        echo"Relax!! You finished all of your exercises!";
                      }else{?>
                        <div class="col-lg-4">
                                  <table width="10%" class="table display compact table-hover"cellspacing="0" >
                                <thead>
                                    <tr>
                                        <th>Exerise Assignment Due</th>
                                        <th>Goal Weight</th>
                                        <th>Goal Reps</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  <?php
$Today_Date=date("Y-m-d");
                                  if (mysqli_num_rows($result) > 0) {
                                      // Printing results in HTML
                                      while ($line = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                                        ?>
                                          <?php
                                         foreach ($line as $col_value) {
                                           ?>
                                           <td>
                                           <?php
                                           if ($col_value==""){
                                             echo "N/A";
                                           }
                                           else{
                                             echo $col_value;}
                                             ?></td>
                                             <?php
                                        }
                                        ?>
                                          </tr>
                                          <?php
                                          $count=$count+1;
                                      }
                                  }

                                  ?>

                                </tbody>
                            </table>

                        </div>

                        <!-- /.table-responsive -->

                    <!-- /.panel-body -->
                </div>
                <?php } ?>

                <!-- /.panel -->
            </div>



</div>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Welcome <?php
                    echo "$First_Name $Last_Name";
                    ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
<!-- panel well-->
<?php
$query=  "SELECT Date,Exercise_Set, Weight_Amt, Reps,Exercise_ID FROM Ex_Perform a, User_Data b Where (b.User_ID= $User_ID AND b.User_ID=a.User_ID)";
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
                      Your Performance:
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <!-- Nav tabs -->

                        <!-- Nav tabs -->
                        <?php  if ($Has_Value==false){
      ?>
                        <center>  <h1>There is no exercises to graph</h1> </center> <?php
                        }else {?>
                        <ul class="nav nav-pills" role="tablist">
                          <li role="presentation" class="active"><a href="#Weight" aria-controls="Weight" role="tab" data-toggle="tab">Weight</a>
                          </li>
                          <li role="presentation"><a href="#Reps" aria-controls="Reps" role="tab" data-toggle="tab">Reps</a>
                          </li>
                          <li role="presentation"><a href="#General" aria-controls="General" role="tab" data-toggle="tab">General</a>
                          </li>
                          <li role="presentation"><a href="#Today" aria-controls="Today" role="tab" data-toggle="tab">Todays Performance</a>
                          </li>

                        </ul>
<?php }?>
                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div role="tabpanel" class="tab-pane active" id="Weight">
                            <div class="row">
                              <div class="col-md-12">
                                <div id="Line-Weight-Chart" style="height: 200px;"></div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="Reps">
                            <div class="row">
                              <div class="col-md-12">
                                <div id="Line-Reps-Chart" style="height: 200px;"></div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="General">
                            <div class="row">
                              <div class="col-md-12">
                                <div id="Bar-Total-Chart" style="height: 200px;"></div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="Today">
                            <div class="row">
                              <div class="col-md-12">
                                <div id="Bar-Today-Chart" style="height: 200px;"></div>
                              </div>
                            </div>
                            <center><p>Set Number</p></center>

                          </div>
                        </div>

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>

  </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Your Exercies:
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <?php
                          if ($Has_Value==false){
?>
                          <center>    <h1> You have no exercies</h1> </center>   <?php
                          }
                          if ($Has_Value==true){?>
                            <table width="100%" class="table table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Date Completed</th>
                                        <th>Exercise Set</th>
                                        <th>Weight Amount</th>
                                        <th>Reps</th>
                                        <th>Exercise ID</th>
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
<?php

$query="SELECT `Completed_Date`,`Completion_Date`, `Goal_Weight`, `Goal_Reps`,`Associated_Exercise_ID`,`Train_Session_ID`,`finish` FROM Assigned_Training a, User_Data b Where (b.User_ID=$User_ID AND b.User_ID=a.User_ID)";
$result = mysqli_query($con,$query) or die('Query failed: ' . mysqli_error());
$Has_Value=true;
if (mysqli_num_rows($result) <= 0) {
$Has_Value=false;
}
 ?>
<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Assignment History:
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                      <?php
                      if ($Has_Value==false){
?>
                        <center>  <h1> You have no assignments</h1> </center>   <?php
                      }
                      if ($Has_Value==true){?>
                      <div class="panel-body">

                          <div class="col-xs-3">
                            <div class="form-group">
                          Completed: <div class="foo green"></div>

                          </div>
                        </div>
                          <div class="col-xs-3">
                            <div class="form-group">
                          Late: <div class="foo blue"></div>

                          </div>
                          </div>
                          <div class="col-xs-3">
                            <div class="form-group">
                           Assigned: <div class="foo yellow"></div>

                          </div>
                          </div>
                          <div class="col-xs-3">
                            <div class="form-group">
                          Incomplete: <div class="foo red"></div>

                          </div>
                          </div>
                    </div>
                                  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                <thead>
                                    <tr>
                                        <th>Date Completed</th>
                                        <th>Exerise Assignment Due</th>
                                        <th>Goal Weight</th>
                                        <th>Goal Reps</th>
                                        <th>Exerise ID</th>
                                        <th>Training Assigment ID</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  <?php

                                  if (mysqli_num_rows($result) > 0) {
                                      // Printing results in HTML
                                      while ($line = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                                        ?>

                                        <tr class=
<?php if ($line['finish']==0) { if ($line['Completion_Date']>=$Today_Date){echo "warning";}else {echo "danger";}} else{ if ($line['Completion_Date']<$line['Completed_Date']){echo "info";} else {echo "success";}} ?>
                                      >
                                          <?php
                                         foreach ($line as $col_value) {
if ($col_value===$line['finish']){;} else{
                                           ?>
                                           <td>
                                           <?php
                                           if ($col_value==""){
                                             echo "N/A";
                                           }
                                           else{
                                             echo $col_value;}
                                             ?></td>
                                             <?php
                                        }}
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
                        <!-- /.table-responsive -->
                        </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
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
    <script>
    $(document).ready(function() {

        $('#dataTables-example2').DataTable({
            responsive: true
        });
    });
    </script>

<script>
 <?php
$query=  "SELECT Date, AVG(Weight_Amt) FROM Ex_Perform a, User_Data b Where (b.User_ID=$User_ID AND b.User_ID=a.User_ID) GROUP BY `Date`";
$result = mysqli_query($con,$query) or die('Query failed: ' . mysqli_error());

if(!$result) {
 die('Mysql error:'. mysqli_error($link));
}

$data = [];
while ($row = $result->fetch_assoc()) {
$data[] = $row;
}


?>
console.log("hi");

 console.log("got results");

var my_var = <?php echo json_encode($data); ?>;
console.log(my_var);
var Weight_Chart= Morris.Line({
   element: 'Line-Weight-Chart',
   data: my_var,
   xkey: 'Date',
   ykeys: ['AVG(Weight_Amt)'],
   labels: ['Weight Lifted (lbs)'],
   pointSize: 2,
   hideHover: 'auto',
   resize: true
});


 <?php
$query=  "SELECT Date, AVG(Weight_Amt),AVG(`Reps`) FROM Ex_Perform a, User_Data b Where (b.User_ID=$User_ID AND b.User_ID=a.User_ID) GROUP BY `Date`";
$result = mysqli_query($con,$query) or die('Query failed: ' . mysqli_error());

if(!$result) {
die('Mysql error:'. mysqli_error($link));
}

$data = [];
while ($row = $result->fetch_assoc()) {
$data[] = $row;
}


?>
console.log("hi");

console.log("got results");

var my_var = <?php echo json_encode($data); ?>;
console.log(my_var);
var Total_Chart= Morris.Bar({
  element: 'Bar-Total-Chart',
  data: my_var,
  xkey: 'Date',
  ykeys: ['AVG(Weight_Amt)','AVG(`Reps`)'],
  labels: ['Weight Lifted (lbs)','Repetitions'],
  pointSize: 2,
  hideHover: 'auto',
  resize: true
});


 <?php
$query=  "SELECT  `Weight_Amt`,`Reps`,`Exercise_Set` FROM Ex_Perform a, User_Data b Where (b.User_ID=$User_ID AND b.User_ID=a.User_ID) AND`Date`='$Today_Date'";
$result = mysqli_query($con,$query) or die('Query failed: ' . mysqli_error());

if(!$result) {
die('Mysql error:'. mysqli_error($link));
}

$data = [];
while ($row = $result->fetch_assoc()) {
$data[] = $row;
}


?>
console.log("hi");

console.log("got results today");

var my_var = <?php echo json_encode($data); ?>;
console.log(my_var);
var Today_Workout= Morris.Bar({
 element: 'Bar-Today-Chart',
 data: my_var,
 xkey: 'Exercise_Set',
 ykeys: ['Weight_Amt','Reps'],
 labels: ['Weight Lifted','Repetitions'],
 xlabels: "set",
 pointSize: 2,
 hideHover: 'auto',
 resize: true
});


</script>
<script>


/*
var Weight_Chart = Morris.Bar({
  element: 'chart1',
  data: [
    { y: '2006', a: 100, b: 90 },
    { y: '2007', a: 75, b: 65 },
    { y: '2008', a: 50, b: 40 },
    { y: '2009', a: 75, b: 65 },
    { y: '2010', a: 50, b: 40 },
    { y: '2011', a: 75, b: 65 },
    { y: '2012', a: 100, b: 90 }
  ],
  xkey: 'y',
  ykeys: ['a', 'b'],
  labels: ['Series A', 'Series B'],
  hideHover: 'always',
  resize: true
});

var profileBar = Morris.Bar({
  element: 'chart2',
  data: [
    { y: '2006', a: 100, b: 90 },
    { y: '2007', a: 75, b: 65 },
    { y: '2008', a: 50, b: 40 },
    { y: '2009', a: 75, b: 65 },
    { y: '2010', a: 50, b: 40 },
    { y: '2011', a: 75, b: 65 },
    { y: '2012', a: 100, b: 90 }
  ],
  xkey: 'y',
  ykeys: ['a', 'b'],
  labels: ['Series A', 'Series B'],
  hideHover: 'always',
  resize: true
});
*/
$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
  var target = $(e.target).attr("href") // activated tab

  switch (target) {
    case "#Weight":
      Weight_Chart.redraw();
      $(window).trigger('resize');
      break;
    case "#Reps":
      Rep_Chart.redraw();
      $(window).trigger('resize');
      break;
      case "#General":
        Total_Chart.redraw();
        $(window).trigger('resize');
        break;
        case "#Today":
          Today_Workout.redraw();
          $(window).trigger('resize');
          break;
  }
});
</script>
    <script>
    <?php
    $query=  "SELECT Date, AVG(Reps) FROM Ex_Perform a, User_Data b Where (b.User_ID=$User_ID AND b.User_ID=a.User_ID) GROUP BY `Date`";
    $result = mysqli_query($con,$query) or die('Query failed: ' . mysqli_error());

    if(!$result) {
      die('Mysql error:'. mysqli_error($link));
    }

    $data_reps = [];
    while ($row = $result->fetch_assoc()) {
    $data_reps[] = $row;
    }


    ?>
    console.log("hi");

      console.log("got results");

    var my_var_reps = <?php echo json_encode($data_reps); ?>;
    console.log(my_var_reps);
  var Rep_Chart =Morris.Line({
        element: 'Line-Reps-Chart',
        data: my_var_reps,
        xkey: 'Date',
        ykeys: ['AVG(Reps)'],
        labels: ['Reps'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });
    </script>




</body>

</html>
