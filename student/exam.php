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

$examId = $_GET['ei'];
if (!isset($examId)) {
  header("location:dashboard.php");
  exit();
}

$no = 1;
if (isset($_GET['no'])) {
  $no = $_GET['no'];
}

$userId = $_SESSION['id'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$userId'");
$user = mysqli_fetch_array($result);

$result = mysqli_query(
  $conn,
  "SELECT * FROM exam_enrollments 
JOIN exams ON exams.id = exam_enrollments.exam_id 
JOIN questions ON questions.id = exam_enrollments.question_id
JOIN school_majors ON school_majors.id = exams.school_major_id 
WHERE exam_id = '$examId' AND user_id = '$userId' AND number = '$no'"
);

$exam = mysqli_fetch_array($result);
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
      <a href="dashboard.php" class="logo">
        <img src="../images/image.png" alt="logo" width="70" style="margin-bottom: 7px;">
        <b>Exam</b>Online
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <div class="col-md-5 col-md-offset-4" style="margin-top:15px; margin-left:35%;">
          <span class="alert alert-danger">
            <i class="fa fa-clock-o"></i>
            &nbsp;
            <b id="timer-exam"></b>
          </span>
        </div>

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
      <section class="content-header">
        <h1>
          Exam
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-edit"></i> Home</a></li>
          <li class="active">Exam</li>
        </ol>
      </section>

      <!-- Main content -->
      <input type="hidden" id="start-exam" value="<?php echo $exam['start_date'] ?>" />
      <input type="hidden" id="duration-exam" value="<?php echo $exam['duration_in_minutes'] ?>" />

      <section class="content">
        <br>
        <div class="row">
          <div class="col-md-9">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <div class="col-md-5">
                  <span class="label label-info"><?php echo $exam['name'] ?></span>
                </div>
                <h3 class="panel-title"><?php echo $exam['title'] ?></h3>
              </div>
              <div class="panel-body">
                <?php
                if ($exam['image_path']) {
                ?>
                  <div class="panel panel-default">
                    <div class="panel-body text-center">
                      <img src="<?php echo "../images/" . $exam['image_path'] ?>" width="450">
                    </div>
                  </div>
                <?php } ?>

                <div class="panel panel-default">
                  <div class="panel-body">
                    <?php echo $exam['question'] ?>
                  </div>
                </div>

                <hr>

                <div class="row">
                  <form action="../service/submit-answer-service.php" method="post" id="form-answer">
                    <input type="hidden" name="exam-id" value="<?php echo $_GET['ei'] ?>">
                    <input type="hidden" name="question-id" value="<?php echo $exam['question_id'] ?>">
                    <input type="hidden" name="no" value="<?php
                                                          if (isset($_GET['no'])) {
                                                            echo $_GET['no'];
                                                          } else {
                                                            echo 1;
                                                          }
                                                          ?>
                    ">
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM answers WHERE question_id = '$exam[question_id]' ORDER BY id LIMIT 2");
                    $id = 0;
                    while ($answer = mysqli_fetch_array($result)) {
                      $id++;
                    ?>
                      <div class="col-md-6">
                        <div class="radio">
                          <label class="col-md-12">
                            <?php if ($answer['id'] == $exam['selected_answer_id']) { ?>
                              <input type="radio" name="selected-answer-id" id="answer<?php echo $id ?>" value="<?php echo $answer['id'] ?>" style="margin-top:20px;" checked>
                            <?php } else { ?>
                              <input type="radio" name="selected-answer-id" id="answer<?php echo $id ?>" value="<?php echo $answer['id'] ?>" style="margin-top:20px;">
                            <?php } ?>

                            <div class="panel panel-default" style="width: 100%;">
                              <div class="panel-body">
                                <?php echo $answer['answer'] ?>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                    <?php } ?>
                </div>
                <br>
                <div class="row">


                  <?php
                  $result = mysqli_query($conn, "SELECT * FROM answers WHERE question_id = '$exam[question_id]' ORDER BY id LIMIT 2, 2");
                  $id = 2;
                  while ($answer = mysqli_fetch_array($result)) {
                    $id++;
                  ?>
                    <div class="col-md-6">
                      <div class="radio">
                        <label class="col-md-12">
                          <?php if ($answer['id'] == $exam['selected_answer_id']) { ?>
                            <input type="radio" name="selected-answer-id" id="answer<?php echo $id ?>" value="<?php echo $answer['id'] ?>" style="margin-top:20px;" checked>
                          <?php } else { ?>
                            <input type="radio" name="selected-answer-id" id="answer<?php echo $id ?>" value="<?php echo $answer['id'] ?>" style="margin-top:20px;">
                          <?php } ?>
                          <div class="panel panel-default" style="width: 100%;">
                            <div class="panel-body">
                              <?php echo $answer['answer'] ?>
                            </div>
                          </div>
                        </label>
                      </div>
                    </div>
                  <?php } ?>
                  </form>
                </div>

              </div>
            </div>
          </div>
          <div class="col-md-3">
            <button type="button" class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target=".submit-modal"><b>SUBMIT</b></button>
            <br>
            <div class="panel panel-default">
              <div class="panel-body text-center">
                <div class="row">
                  <?php
                  $result = mysqli_query($conn, "SELECT * FROM exam_enrollments WHERE exam_id = '$examId' and user_id = '$userId' LIMIT 5");
                  while ($enrollment = mysqli_fetch_array($result)) {
                    if ($no == $enrollment['number']) {
                      echo "<a class='btn btn-primary' href='exam.php?ei=$examId&no=$enrollment[number]' role='button'>$enrollment[number]</a>";
                    } else  if (isset($enrollment['selected_answer_id'])) {
                      echo "<a class='btn btn-success' href='exam.php?ei=$examId&no=$enrollment[number]' role='button'>$enrollment[number]</a>";
                    } else {
                      echo "<a class='btn btn-default' href='exam.php?ei=$examId&no=$enrollment[number]' role='button'>$enrollment[number]</a>";
                    }

                    echo "&nbsp;";
                  }
                  ?>
                </div>
                <br>
                <!-- <div class="row">
                  <button type="button" class="btn btn-default">6</button>
                  &nbsp;
                  <button type="button" class="btn btn-default">7</button>
                  &nbsp;
                  <button type="button" class="btn btn-default">8</button>
                  &nbsp;
                  <button type="button" class="btn btn-default">9</button>
                  &nbsp;
                  <button type="button" class="btn btn-default">10</button>
                </div>
                <br> -->
                <div class="row">
                  <?php
                  $result1 = mysqli_query($conn, "SELECT * FROM exam_enrollments WHERE exam_id = '$examId' AND user_id = '$userId' AND selected_answer_id IS NULL");
                  $count1 = mysqli_num_rows($result1);

                  $result2 = mysqli_query($conn, "SELECT * FROM exam_enrollments WHERE exam_id = '$examId' AND user_id = '$userId' AND selected_answer_id IS NOT NULL");
                  $count2 = mysqli_num_rows($result2);
                  ?>
                  <span class="label label-default">Belum terisi: <?php echo $count1; ?></span>
                  &nbsp;
                  <span class="label label-success">Sudah terisi: <?php echo $count2; ?></span>
                </div>
              </div>
            </div>
          </div>
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

  <div class="modal fade submit-modal" tabindex="-1" role="dialog" data-backdrop="false" data-keyboard="false">
    <form action="../service/submit-exam-service.php" method="post" id="submit-exam-form">
      <input type="hidden" name="exam-id" value="<?php echo $_GET['ei'] ?>">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Submit Confirmation</h4>
          </div>
          <div class="modal-body">
            <p>Type <b>CONFIRM</b> at the input text below to continue submit.</p>
            <div class="row">
              <div class="col-md-3">
                <input type="text" required="required" autocomplete="off" autocapitalize="off" id="submit-exam-text">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" id="submit-exam-confirm" disabled="true">Submit</button>
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

  <script>
    var timer;

    var compareDate = new Date(Date.parse($('#start-exam').val()));
    var duration = $('#duration-exam').val();

    compareDate.setMinutes(compareDate.getMinutes() + parseInt(duration));

    timer = setInterval(function() {
      timeBetweenDates(compareDate);
    }, 1000);

    function timeBetweenDates(toDate) {
      var dateEntered = toDate;
      var now = new Date();
      var difference = dateEntered.getTime() - now.getTime();

      if (difference <= 0) {

        // Timer done
        clearInterval(timer);
        $("#submit-exam-form").submit();
        alert("Time is up");
        // window.location.href = "dashboard.php";

      } else {

        var seconds = Math.floor(difference / 1000);
        var minutes = Math.floor(seconds / 60);
        var hours = Math.floor(minutes / 60);
        var days = Math.floor(hours / 24);

        hours %= 24;
        minutes %= 60;
        seconds %= 60;

        seconds = (seconds < 10) ? '0' + seconds : seconds;
        minutes = (minutes < 10) ? '0' + minutes : minutes;
        hours = (hours < 10) ? '0' + hours : hours;

        $("#timer-exam").text(hours + ':' + minutes + ':' + seconds);
      }
    }
  </script>

  <script>
    $('#submit-text').keyup(function() {
      var value = $('#submit-text').val();
      if (value === 'CONFIRM') {
        $('#submit-confirm').prop('disabled', false);
      } else {
        $('#submit-confirm').prop('disabled', true);
      }
    });

    $('#submit-exam-text').keyup(function() {
      var value = $('#submit-exam-text').val();
      if (value === 'CONFIRM') {
        $('#submit-exam-confirm').prop('disabled', false);
      } else {
        $('#submit-exam-confirm').prop('disabled', true);
      }
    });
  </script>

  <script>
    $(document).ready(function() {
      $("#answer1, #answer2, #answer3, #answer4").change(function() {
        $("#form-answer").submit();
      });
    });
  </script>
</body>

</html>