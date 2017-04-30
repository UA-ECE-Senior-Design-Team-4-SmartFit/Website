
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
$query ="SELECT`Trainer_ID`,`Trainer_FName`,`Trainer_LName` FROM `Trainer_Data`a WHERE a.Email='$Account_Email'";

$result = mysqli_query($con,$query) or die('Query failed: begining ' . mysqli_error());
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
                            <a href="Trainer_Personal_Profile.php"><i class="fa fa-user fa-fw"></i><?php
                            echo "$First_Name $Last_Name";
                            ?></a>
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

            <?php
            $query="SELECT `User_FName`,`User_LName`,`User_ID` FROM `User_Data` WHERE `Trainer_ID`=$Trainer_ID";
            $result = mysqli_query($con,$query) or die('Query failed: issue ' . mysqli_error());
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
                            Your Current Students:
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <?php
                          if ($Has_Value==false){
?>
                            <h1>You have no Students</h1> <?php
                          }
                          if ($Has_Value==true){?>

                                  <script>
                                  var Student_ID = new Array();

                                  </script>
<?php

if (mysqli_num_rows($result) > 0) {
    // Printing results in HTML

$count=1;

    while ($line = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
      ?>
      <script>

Student_ID.push("<?php echo $line['User_FName']; ?>");
      </script>


      <tr class="gradeU">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="<?php echo"#name".$count; ?>"><?php echo $line['User_FName']." ". $line['User_LName'] ;?></a>
                        </h4>
                    </div>
                    <div id=<?php echo"name".$count; ?> class="panel-collapse collapse">


                            <div class="panel-body">
                              <div class="col-lg-7">
                                <form>

    <div class="form-group">
      <div class="col-xs-2">
      <button data-userid="<?php echo $line['User_ID']; ?>" type="button" id="<?php echo "Suc_".$count;?>" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add</button>
</div>
      <div class="col-xs-3">
        <input class="form-control" id="Weight_Input" type="text" placeholder="Weight: lbs">
      </div>
      <div class="col-xs-3">
        <input class="form-control" id="Reps_Input" type="text" placeholder="Rep Amount">
      </div>
      <div class="col-xs-4">
        <input class="form-control" id="Date_Input" type="text" placeholder="Date: yyyy-mm-dd">
      </div>
    </div>
  </form>



<br>
<br>
<br>

<div class="form-group">
<div class="col-xs-2">
<button data-userid="<?php echo $line['User_ID']; ?>" type="button" class="btn btn-danger "data-toggle="modal" data-target="#myModal">Delete</button>
</div>
<div class="col-xs-4">
<input type="text" class="form-control" id="Assignment_EX" placeholder="Exercise Assignment ID">
</div>
<div class="col-xs-2">
  <a href="Students_Profile.php?Users_ID=<?php echo $line['User_ID']; ?>">
  <button type="button" class="btn btn-primary"><?php echo $line['User_FName']."'s Profile" ?></button>
</a>
</div>
</div>


</div>



<?php
$Inner_User_ID=$line['User_ID'];

$Inner_Q="SELECT `Completion_Date`,`Goal_Weight`,`Goal_Reps`,`finish` FROM `Assigned_Training` WHERE (`User_ID`=$Inner_User_ID) ORDER BY ABS( DATEDIFF( `Completion_Date`, NOW() ) ) LIMIT 1";
$Inner_Result = mysqli_query($con,$Inner_Q) or die('Query failed: issue ' . mysqli_error());
$Has_Inner_Value=true;
if (mysqli_num_rows($Inner_Result) <= 0) {

$Has_Inner_Value=false;
}

?>
<div class="col-lg-5">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Most Recent Assignment
        </div>
        <div class="panel-body">



          <?php
$inner_line = mysqli_fetch_array($Inner_Result,MYSQLI_ASSOC);
if ($Has_Inner_Value==false){
echo"You have not assigned this student a assignment.";
} else if($Has_Inner_Value==true) {
  if($inner_line['finish']==0){
    echo "Status: ";?>
    <font color="red">Did Not Complete</font>
    <?php
  }
  else {
    echo "Status: ";?>
    <font color="green">Completed</font>
    <?php
  }
          ?>
          <table id="Today_Assign"  class="table table-bordered"  >
                      <td><?php echo "Date :".$inner_line['Completion_Date'] ; ?></td>
                      <td><?php echo "Weight :".$inner_line['Goal_Weight']; ?></td>
                      <td><?php echo "Rep :".$inner_line['Goal_Reps']; ?></td>
              </table>
              <?php }
              ?>
        </div>

    </div>
</div>



</div>


                    </div>
                </div>
            </div>
        </tr>


        <?php
        $count=$count+1;
    }
}

?>

                            <!-- /.table-responsive -->
<?php }?>


                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

                        <!-- Button trigger modal -->

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Submission Successful!!</h4>
                                    </div>
                                    <div class="modal-body">
                                        Your submission has been successful.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary btn-circle btn-xl" data-dismiss="modal" value="Refresh Page" onClick="window.location.reload()"><i class="fa fa-check"></i></button>

                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->


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
<script>

$(function () {
  $("button.btn-success").click(function(){
  var form_input=  $(this).closest("form");
  var input_weight=form_input.find('input#Weight_Input').val();
  var input_rep=form_input.find('input#Reps_Input').val();
  var input_date=form_input.find('input#Date_Input').val();
  var ide=$(this).data('userid');
  var get_R="UserID="+ide+"&TrainerID="+<?php echo $Trainer_ID ;?>+"&CompletionDate="+input_date+"&GoalWeight="+input_weight+"&GoalReps="+input_rep+"&option=1";
    console.log(get_R);
    request = $.ajax({
        url: "form.php",
        type: "get",
        data:get_R

    });
      var asd;
    request.done(function (response, textStatus, jqXHR){
asd=response;
      console.log("Hooray, it worked!");

  })

  });
})


$(function () {
  $("button.btn-danger").click(function(){
    var form_input=  $(this).closest(".form-group");
    var input_assign=form_input.find('input#Assignment_EX').val();
    var get_R="Assign_Num="+input_assign+"&option=2";
    var ide=$(this).data('userid');
    console.log(get_R);
    request = $.ajax({
        url: "form.php",
        type: "get",
        data:get_R

    });
      var asd;
    request.done(function (response, textStatus, jqXHR){
asd=response;
      console.log("Hooray, it worked!");

  })

  });
})

</script>

    <script>
    <?php

    $query=  "SELECT CONCAT (b.`User_FName`,' ', b.`User_LName`),COUNT(*) as count FROM Assigned_Training a, User_Data b WHERE a.`Trainer_ID`= b.`Trainer_ID` AND a.`Trainer_ID`=1 AND `Completion_Date`>='2017-04-19' AND `finish`=0 AND a.`User_ID`=b.`User_ID` GROUP BY a.`User_ID` ORDER BY count DESC";
    $result = mysqli_query($con,$query) or die('Query failed: ' . mysqli_error());

    if(!$result) {
      die('Mysql error:'. mysqli_error($link));
    }



    $data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
/*
$data = [];
while ($line = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
foreach ($line as $col_value) {
 /*
 if ($col_value==$line['User_FName']){
      $fname=  $line['User_FName'];
      $lname= $line['User_LName'];
      $Fullname=$fname." ".$lname;
   $data[] =$Fullname;

}

else if ($col_value==$line['User_LName']){
 ;
}
else{
$data[] = $col_value;
//}
}
}
*/

    ?>
    console.log("hi");

      console.log("got results");

var my_var = <?php echo json_encode($data); ?>;
console.log(my_var);
Morris.Bar({
  element: 'Line-Weight-Chart',
  data: my_var,
  xkey: "CONCAT (b.`User_FName`,' ', b.`User_LName`)",
  ykeys: ['count'],
  labels: ['Weight_Amt'],
  pointSize: 2,
  hideHover: 'auto',
  resize: true
});
    </script>




</body>

</html>
<?php

/*
    Morris.Bar({
        element: 'Line-Weight-Chart',
        data: my_var,
        xkey: 'User_ID',
        ykeys: ['count'],
        labels: ['Weight_Amt'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });
    */
?>
