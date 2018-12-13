<?php
    if(isset($_COOKIE['id']))
    {
        session_id($_COOKIE['id']);
    }
    session_start();
    if($_SESSION['htno'] == null){
        header("Location:student-login.php");
    }
    include('connection.php');
    $htno = $_SESSION["htno"];
    $sql = "SELECT * FROM student_details WHERE htno = '$htno'";
    $result = $connect->query($sql);
    $row = $result->fetch_assoc();
    $batch = $row["batch"];
    $branch=strtolower($row["branch"]);
    //checking
    $htno;
    $x=substr($htno,0,2);
    $y='20'.$x;
    $search=$y;

    //get the latest attendance table
    $q="select table_name from information_schema.tables where table_schema='vims' and table_name like '%$search%' and table_name like '%$branch%' order by create_time desc";
    $r = $connect->query($q);
    $row = $r->fetch_assoc();
    $table_name=$row["table_name"];


?>

<?php
include('connection.php');
ini_set('max_execution_time', 1000);
//variables declaration
$max=$min=0;
$snid=$snhno=$snsno='';
$tid=$thno=$tsno=0;
$id=$hno=$sno='';
$sn1=$sn2=$sn3=$sn4=$sn5=$sn6=$sn7=$sn8=$sn9=$sn10=$sn11=$sn12='';
$s1=$s2=$s3=$s4=$s5=$s6=$s7=$s8=$s9=$s10=$s11=$s12=0;
$ts1=$ts2=$ts3=$ts4=$ts5=$ts6=$ts7=$ts8=$ts9=$ts10=$ts11=$ts12=0;
$fspell=0;
$tospell=0;
//total no of classes of all subjects
$t=0;
//total no of classes students attended
$st=0;
//count avg no of classes attended by a student of one particular subject
$s1count=$s2count=$s3count=$s4count=$s5count=$s6count=$s7count=$s8count=$s9count=$s10count=$s11count=$s12count=0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/vgnt.png">
    <title>Student Portal</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script type="text/javascript">
        window.onload = function() {
        history.replaceState("", "", "student-view_att2.php");
        }
    </script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <b><img src="images/student1.png" alt="homepage" class="dark-logo" /></b>
                        <!--End Logo icon -->
                    </a>
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- Search
                        <li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search here"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                        </li> -->
                    </ul>
                    <!-- User profile and search -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- Profile -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <!-- display propic -->
                              <?php
                              $res=mysqli_query($connect,"select * from student_details where htno='$htno'");
                              while($row=mysqli_fetch_array($res))
                              {
                               if($row['propic']==NULL) echo '<img src="images/Student2.png" alt="user" class="profile-pic" />';
                               else echo '<img style="border-radius:50%; padding-top:0px;" id="profile-image1" class="img img-responsive profile-pic" src="data:image/jpeg;base64,'.base64_encode($row['propic'] ).'" width="100%;"/>';
                              }
                              ?>
                              <!-- display propic -->
                            </a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="student-change_password.php"><i class="fa fa-edit"></i> Change Password</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="student/logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- End header header -->
        <!-- Left Sidebar  -->
        <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="student.php">Profile </a></li>
                            </ul>
                        </li>
                        <li class="nav-label">View Details</li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-bar-chart"></i><span class="hide-menu">Results</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="student-marks_table.php">Marks Table</a></li>
                                <li><a href="student-marks_analysis.php">Analysis</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-calendar"></i><span class="hide-menu">Attendance</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="student-view_att.php">View Attendance</a></li>
                            </ul>
                        </li>
                        <!-- <li class="nav-label">Manage</li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-suitcase"></i><span class="hide-menu">Accomplishments </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="student-certificates.php">Certificates</a></li>
                                <li><a href="student-courses.php">Courses</a></li>
                                <li><a href="student-projects.php">Projects</a></li>
                                <li><a href="student-skills.php">Skills</a></li>
                            </ul>
                        </li> -->
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <!-- End Left Sidebar  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Marks Table</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="student-marks_table.php">View Details</a></li>
                        <li class="breadcrumb-item active">Results</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Attendance</h4>
                                <h6 class="card-subtitle">Total Results of all Students</h6>
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <?php
                       //get max and min spells
                       $q="select max(spell) as max, min(spell) as min from `$table_name`";
                       $r=mysqli_query($connect,$q);
                       if($r){
                         while($row=mysqli_fetch_array($r)){
                           $max=$row['max'];
                           $min=$row['min'];
                         }
                       }

                       //get total no of Students
                       $q1="select count(id) as students from `$table_name` where hno not in('SubjectCode','HTNO/TotalClass') and spell=1;";
                       $r1=mysqli_query($connect,$q1);
                       if($r1){
                         while($row=mysqli_fetch_array($r)){
                           $students=$row['students'];
                         }
                       }

                       //get subject codes
                       $qsub="select * from `$table_name` where hno in('SubjectCode')";
                       $res=mysqli_query($connect,$qsub);
                       if($res){
                         while($row=mysqli_fetch_array($res)){
                            $snid=$row['id'];
                            $snsno=$row['sno'];
                            $snhno=$row['hno'];
                            $sn1=$row['s1'];
                            $sn2=$row['s2'];
                            $sn3=$row['s3'];
                            $sn4=$row['s4'];
                            $sn5=$row['s5'];
                            $sn6=$row['s6'];
                            $sn7=$row['s7'];
                            $sn8=$row['s8'];
                            $sn9=$row['s9'];
                            $sn10=$row['s10'];
                            $sn11=$row['s11'];
                            $sn12=$row['s12'];
                           break;
                         }
                       }
                          //pspell is all spells
                          $qsub="select id,sno,hno,sum(case when s1='' then -1 else s1 end) as s1,sum(case when s2='' then -1 else s2 end) as s2,sum(case when s3='' then -1 else s3 end) as s3,sum(case when s4='' then -1 else s4 end) as s4,sum(case when s5='' then -1 else s5 end) as s5,sum(case when s6='' then -1 else s6 end) as s6,sum(case when s7='' then -1 else s7 end) as s7,sum(case when s8='' then -1 else s8 end) as s8,sum(case when s9='' then -1 else s9 end) as s9,sum(case when s10='' then -1 else s10 end) as s10,sum(case when s11='' then -1 else s11 end) as s11,sum(case when s12='' then -1 else s12 end) as s12 from `$table_name` where spell between '$min' and '$max' and hno  in ('HTNO/TotalClass') group by hno";
                          $res=mysqli_query($connect,$qsub);
                          if($res){
                            while($row=mysqli_fetch_array($res)){
                               $tid=$row['id'];
                               $tsno=$row['sno'];
                               $thno=$row['hno'];
                               $ts1=$row['s1'];
                               $ts2=$row['s2'];
                               $ts3=$row['s3'];
                               $ts4=$row['s4'];
                               $ts5=$row['s5'];
                               $ts6=$row['s6'];
                               $ts7=$row['s7'];
                               $ts8=$row['s8'];
                               $ts9=$row['s9'];
                               $ts10=$row['s10'];
                               $ts11=$row['s11'];
                               $ts12=$row['s12'];
                            }
                          }
                          //total no of classes of all subjects
                          if($ts1>=0) $t=$t+$ts1;
                          if($ts2>=0) $t=$t+$ts2;
                          if($ts3>=0) $t=$t+$ts3;
                          if($ts4>=0) $t=$t+$ts4;
                          if($ts5>=0) $t=$t+$ts5;
                          if($ts6>=0) $t=$t+$ts6;
                          if($ts7>=0) $t=$t+$ts7;
                          if($ts8>=0) $t=$t+$ts8;
                          if($ts9>=0) $t=$t+$ts9;
                          if($ts10>=0) $t=$t+$ts10;
                          if($ts11>=0) $t=$t+$ts11;
                          if($ts12>=0) $t=$t+$ts12;

                          //now print subject codes and total classes
                          //echo "<table class='table table-striped table-hover'>";
                          echo "<thead><tr>";
                          echo "<th>".$snsno."</th>";
                          echo "<th>".$snhno."</th>";
                          if(!empty($sn1)) echo "<th>".$sn1."</th>";
                          if(!empty($sn2)) echo "<th>".$sn2."</th>";
                          if(!empty($sn3)) echo "<th>".$sn3."</th>";
                          if(!empty($sn4)) echo "<th>".$sn4."</th>";
                          if(!empty($sn5)) echo "<th>".$sn5."</th>";
                          if(!empty($sn6)) echo "<th>".$sn6."</th>";
                          if(!empty($sn7)) echo "<th>".$sn7."</th>";
                          if(!empty($sn8)) echo "<th>".$sn8."</th>";
                          if(!empty($sn9)) echo "<th>".$sn9."</th>";
                          if(!empty($sn10)) echo "<th>".$sn10."</th>";
                          if(!empty($sn11)) echo "<th>".$sn11."</th>";
                          if(!empty($sn12)) echo "<th>".$sn12."</th>";
                          echo "<th>Total No.of Classes</th>";
                          echo "<th>Percentage</th>";
                          echo "</tr></thead>";
                          //print total classes
                          echo "<thead><tr>";
                          echo "<th>".$tsno."</th>";
                          echo "<th>".$thno."</th>";
                          if($ts1>=0) echo "<th>".$ts1."</th>";
                          if($ts2>=0) echo "<th>".$ts2."</th>";
                          if($ts3>=0) echo "<th>".$ts3."</th>";
                          if($ts4>=0) echo "<th>".$ts4."</th>";
                          if($ts5>=0) echo "<th>".$ts5."</th>";
                          if($ts6>=0) echo "<th>".$ts6."</th>";
                          if($ts7>=0) echo "<th>".$ts7."</th>";
                          if($ts8>=0) echo "<th>".$ts8."</th>";
                          if($ts9>=0) echo "<th>".$ts9."</th>";
                          if($ts10>=0) echo "<th>".$ts10."</th>";
                          if($ts11>=0) echo "<th>".$ts11."</th>";
                          if($ts12>=0) echo "<th>".$ts12."</th>";
                          echo "<th>".$t."</th>";
                          echo "<th>100%</th>";
                          echo "</tr></thead>";

                          //print no of classes attended
                          $qsub="select id,sno,hno,sum(case when s1='' then -1 else s1 end) as s1,sum(case when s2='' then -1 else s2 end) as s2,sum(case when s3='' then -1 else s3 end) as s3,sum(case when s4='' then -1 else s4 end) as s4,sum(case when s5='' then -1 else s5 end) as s5,sum(case when s6='' then -1 else s6 end) as s6,sum(case when s7='' then -1 else s7 end) as s7,sum(case when s8='' then -1 else s8 end) as s8,sum(case when s9='' then -1 else s9 end) as s9,sum(case when s10='' then -1 else s10 end) as s10,sum(case when s11='' then -1 else s11 end) as s11,sum(case when s12='' then -1 else s12 end) as s12 from `$table_name` where spell between '$min' and '$max' and hno in('$htno') and hno not in ('HTNO/TotalClass','SubjectCode') group by hno";
                          $res=mysqli_query($connect,$qsub);
                          if($res){
                            while($row=mysqli_fetch_array($res)){
                             $st=0;
                             echo "<tr>";
                             echo "<td>".$row['sno']."</td>";
                             echo "<td>".$row['hno']."</td>";
                             if($row['s1']>=0){
                               echo "<td>".$row['s1']."</td>";
                               $st=$st+$row['s1'];
                             }
                             if($row['s2']>=0){
                               echo "<td>".$row['s2']."</td>";
                               $st=$st+$row['s2'];
                             }
                             if($row['s3']>=0){
                               echo "<td>".$row['s3']."</td>";
                               $st=$st+$row['s3'];
                             }
                             if($row['s4']>=0){
                               echo "<td>".$row['s4']."</td>";
                               $st=$st+$row['s4'];
                             }
                             if($row['s5']>=0){
                               echo "<td>".$row['s5']."</td>";
                               $st=$st+$row['s5'];
                             }
                             if($row['s6']>=0){
                               echo "<td>".$row['s6']."</td>";
                               $st=$st+$row['s6'];
                             }
                             if($row['s7']>=0){
                               echo "<td>".$row['s7']."</td>";
                               $st=$st+$row['s7'];
                             }
                             if($row['s8']>=0){
                               echo "<td>".$row['s8']."</td>";
                               $st=$st+$row['s8'];
                             }
                             if($row['s9']>=0){
                               echo "<td>".$row['s9']."</td>";
                               $st=$st+$row['s9'];
                             }
                             if($row['s10']>=0){
                               echo "<td>".$row['s10']."</td>";
                               $st=$st+$row['s10'];
                             }
                             if($row['s11']>=0){
                               echo "<td>".$row['s11']."</td>";
                               $st=$st+$row['s11'];
                             }
                             if($row['s12']>=0){
                               echo "<td>".$row['s12']."</td>";
                               $st=$st+$row['s12'];
                             }
                              //calculate % of students Attendance
                              $p=($st/$t)*100;
                              $p=round($p,2);
                              //now print % and classes attended
                              echo "<td>".$st."</td>";
                              echo "<td>".$p."</td>";
                              echo "</tr>";
                            }
                          }
                          //pspell is all spells

                ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            <footer class="footer"> © 2018 Vignan's Institute Management System Developed by CSE Dept &amp; Theme by <a href="https://colorlib.com">Colorlib</a></footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>

    <div class="modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="changePassModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
                <form action="javascript:;" novalidate="novalidate">
                    <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <div class="form-group">
                                <label for="oldPass">
                                    old Password
                                </label>
                                <input type="password"  data-val="true" data-val-required="this is Required Field" class="form-control" name="oldPass" id="oldPass"/>
                                <span class="field-validation-valid text-danger" data-valmsg-for="oldPass" data-valmsg-replace="true"></span>
                            </div>
                            <div class="form-group">
                                <label for="newPass">
                                    New Password
                                </label>
                                <input type="password" data-val="true" data-val-required="this is Required Field" class="form-control" name="newPass" id="newPass"/>
                                <span class="field-validation-valid text-danger"  data-valmsg-for="newPass" data-valmsg-replace="true"></span>

                            </div>
                            <div class="form-group">
                                <label for="confirmPass">
                                    Confirm Password
                                </label>
                                <input type="password" data-val-equalto="Password not Match ", data-val-equalto-other="newPass" data-val="true" data-val-required="this is Required Field" class="form-control" name="confirmPass" id="confirmPass"/>
                                <span class="field-validation-valid text-danger" data-valmsg-for="confirmPass" data-valmsg-replace="true"></span>

                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
          </div>
        </div>
      </div>

    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script src="js/lib/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/lib/form-validation/jquery.validate.min.js"></script>
    <script src="js/lib/form-validation/jquery.validate.unobtrusive.min.js"></script>
    <script src="js/lib/jquery.nicescroll/jquery.nicescroll.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <script>
        window.onload = function() {
            history.replaceState("", "", "student-view_att.php");
        }
    </script>
    <script type="text/javascript">
        $(function () {
          $(document).bind("contextmenu",function(e){
            e.preventDefault();
            //alert("Right Click is not allowed");
          }
        );
    		/*$('.dvOne').bind("contextmenu",function(e){
    		e.preventDefault();
    		alert("Right Click is not allowed on div");
    		}
    		);
    		*/
        }
         );
      </script>
      <script>
      $(document).keydown(function (event) {
          if (event.keyCode == 123) { // Prevent F12
              return false;
          }else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
              return false;
          }else if (event.ctrlKey && event.keyCode == 85) { // Prevent Ctrl+U
              return false;
          }
      });
      </script>


    <script src="js/lib/datatables/datatables.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js"></script>

</body>

</html>
