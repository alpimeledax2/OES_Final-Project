<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

session_start();

include '../config/connection.php';

if (!isset($_SESSION['status'])) {
  header("location:../login.php?r=invalid");
  exit();
}

$id = $_SESSION['id'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
$user = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>OES - Online Examination System</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.2 -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- FontAwesome 4.3.0 -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Ionicons 2.0.0 -->
  <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
  <link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
  <!-- iCheck -->
  <link href="../plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
  <!-- Morris chart -->
  <link href="../plugins/morris/morris.css" rel="stylesheet" type="text/css" />
  <!-- jvectormap -->
  <link href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
  <!-- Date Picker -->
  <link href="../plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
  <!-- Daterange picker -->
  <link href="../plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
  <!-- bootstrap wysihtml5 - text editor -->
  <link href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body class="skin-blue sidebar-collapse">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <!--<a href="dashboard.php" class="logo">
        <img src="../images/image.png" alt="logo" width="70" style="margin-bottom: 17px;">
        <b>Exam</b>Online
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="dashboard.php" class="logo">
        <img src="../images/image.png" alt="logo" width="70" style="margin-bottom: 17px;">
        <b>Exam</b>Online
      </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo "../images/" . $user['image_path'] ?>" class="user-image" alt="User Image" />
                <span class="hidden-xs">&nbsp;</span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-footer">
                  <a href="#" class="dropdown-toggle" data-toggle="modal" data-target=".logout-modal">
                    <span class="hidden-xs">Logout</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>


    <!-- Right side column. Contains the navbar and content of the page -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <br>
        <div class="row">
          <div class="col-lg-6 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner" style="margin-bottom: 14px;">
                <h3 style="font-size:25px;"><?php echo $user['full_name'] ?></h3>
                <p>NIK : <?php echo $user['nik'] ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="#" class="small-box-footer">&nbsp;</a>
            </div>
          </div><!-- ./col -->
          <div class="col-lg-3 col-xs-3">
            <!-- small box -->
            <div class="small-box bg-yellow-gradient">
              <div class="inner" style="margin-bottom: -13px;">
                <h3 style="font-size:25px">National <br> Ranking</h3>
                <p>&nbsp;</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="ranking.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div><!-- ./col -->
          <div class="col-lg-3 col-xs-3">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner" style="margin-bottom: -13px;">
                <h3 style="font-size:25px">Grading <br> Report</h3>
                <p>&nbsp;</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="grading.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div><!-- ./col -->

        </div><!-- /.row -->
        <br>
        <div class="row">
          <div class="col-lg-12 col-xs-12">
            <!-- START ALERTS AND CALLOUTS -->

            <div class="row">
              <div class="col-md-12">
                <div class="box box-default">
                  <div class="box-header with-border">
                    <i class="fa fa-bullhorn"></i>
                    <h3 class="box-title">Information</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body text-center">
                    <img src="../images/banner-exam.png" alt="Banner Exam" style="width:100%;" />

                  </div><!-- /.box-body -->
                </div><!-- /.box -->
              </div><!-- /.col -->
            </div> <!-- /.row -->

            <!-- END ALERTS AND CALLOUTS -->
          </div>
        </div>

        <div class="row">

          <?php
          $result = mysqli_query($conn, "SELECT *, exams.id AS examId FROM exams JOIN school_majors ON school_majors.id = exams.school_major_id WHERE school_major_id = '$user[school_major_id]'");
          while ($exam = mysqli_fetch_array($result)) {
          ?>

            <div class="col-md-3">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><span class="label label-info"><?php echo $exam['name'] ?></span>&nbsp; <b><?php echo $exam['title'] ?></b></h3>
                </div>
                <div class="panel-body">
                  <?php echo $exam['description'] ?>

                  <div class="row text-center" style="margin-top: 50px; margin-bottom: 30px;">
                    <span class="alert alert-info">
                      <i class="fa fa-clock-o"></i>
                      <b>Time to complete the test: <?php echo $exam['duration_in_minutes'] ?>m</b>
                    </span>
                  </div>

                </div>
                <div class="panel-footer">

                  <?php
                  $now = new DateTime("now");

                  $examStartDate = new DateTime($exam['start_date']);

                  $examEndDate = new DateTime($exam['start_date']);
                  $duration = $exam['duration_in_minutes'];
                  $examEndDate->modify("+{$duration} minutes");

                  $resultQuery = mysqli_query($conn, "SELECT * FROM results WHERE user_id = '$id' AND exam_id = '$exam[examId]'");
                  $resultData = mysqli_num_rows($resultQuery);
                  if ($resultData > 0) {
                    echo "<button class='btn btn-success btn-block btn-flat' disabled='disabled'><b>COMPLETE</b></button>";
                  } else if ($now > $examEndDate) {
                    echo "<button class='btn btn-danger btn-block btn-flat' disabled='disabled'><b>FAILED</b></button>";
                  } else if ($now < $examStartDate) {
                    echo "<button class='btn btn-info btn-block btn-flat' disabled='disabled'><b>" . date_format($examStartDate, "d F Y H:i:s") . "</b></button>";
                  } else if ($now >= $examStartDate && $now <= $examEndDate) {
                    echo "<a class='btn btn-primary btn-block btn-flat' href='../service/exam-enrollment-service.php?ei=$exam[examId]' role='button'><b>START</b></a>";
                  }
                  ?>

                </div>
              </div>
            </div>

          <?php } ?>

        </div>

      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>Copyright &copy; 2024 Alfiansyah Gusman.</strong> All rights reserved.
    </footer>
  </div><!-- ./wrapper -->

  <div class="modal fade logout-modal" tabindex="-1" role="dialog" data-backdrop="false" data-keyboard="false">
    <form action="../service/logout-service.php" method="post">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Logout Confirmation</h4>
          </div>
          <div class="modal-body">
            <p>Type <b>CONFIRM</b> at the input text below to continue logout.</p>
            <div class="row">
              <div class="col-md-3">
                <input type="text" required="required" autocomplete="off" autocapitalize="off" id="submit-text">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" id="submit-confirm" disabled="true">Submit</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </form>
  </div><!-- /.modal -->

  <!-- jQuery 2.1.3 -->
  <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
  <!-- jQuery UI 1.11.2 -->
  <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- Morris.js charts -->
  <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="../plugins/morris/morris.min.js" type="text/javascript"></script>
  <!-- Sparkline -->
  <script src="../plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
  <!-- jvectormap -->
  <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
  <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
  <!-- jQuery Knob Chart -->
  <script src="../plugins/knob/jquery.knob.js" type="text/javascript"></script>
  <!-- daterangepicker -->
  <script src="../plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
  <!-- datepicker -->
  <script src="../plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
  <!-- iCheck -->
  <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
  <!-- Slimscroll -->
  <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
  <!-- FastClick -->
  <script src='../plugins/fastclick/fastclick.min.js'></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/app.min.js" type="text/javascript"></script>

  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../dist/js/pages/dashboard.js" type="text/javascript"></script>

  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js" type="text/javascript"></script>

  <script>
    $('#submit-text').keyup(function() {
      var value = $('#submit-text').val();
      if (value === 'CONFIRM') {
        $('#submit-confirm').prop('disabled', false);
      } else {
        $('#submit-confirm').prop('disabled', true);
      }
    });
  </script>
</body>

</html>