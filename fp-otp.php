<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>OES - Online Examination System</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.2 -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- Font Awesome Icons -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <!-- iCheck -->
  <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-page">
  <div class="login-box">

    <?php
    if (isset($_GET['r'])) {
      if ($_GET['r'] == 'failed') { ?>
        <!-- Alert OTP generation failed -->
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          Invalid OTP. Please try again.
        </div>
    <?php
      }
    }
    ?>

    <div class="login-logo">
      <a href="login.php"><b>Exam</b>Online</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Enter OTP from your email inbox</p>
      <form action="service/validate-otp.php" method="post">
        <input type="hidden" name="email-to" id="email-to" value="<?php echo $_GET['e'] ?>" />
        <div class="row">
          <div class="col-xs-3">
            <input type="text" name="otp-1" class="form-control" autocomplete="off" required="required" maxlength="1" />
          </div>
          <div class="col-xs-3">
            <input type="text" name="otp-2" class="form-control" autocomplete="off" required="required" maxlength="1" />
          </div>
          <div class="col-xs-3">
            <input type="text" name="otp-3" class="form-control" autocomplete="off" required="required" maxlength="1" />
          </div>
          <div class="col-xs-3">
            <input type="text" name="otp-4" class="form-control" autocomplete="off" required="required" maxlength="1" />
          </div>
        </div>

        <br>

        <div class="social-auth-links text-center">
          <span id="timer">
            Resend OTP in <span id="time">30</span>s
          </span>
        </div>

        <br>

        <div class="row">
          <div class="col-xs-8" style="padding-top:8px;">
            <a href="login.php">Back to Login</a>
          </div><!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
          </div><!-- /.col -->
        </div>
      </form>
    </div><!-- /.login-box-body -->
  </div><!-- /.login-box -->

  <!-- jQuery 2.1.3 -->
  <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

  <script>
    $("input").keyup(function() {
      var index = $(this).index("input");
      $("input").eq(index + 1).focus();
    });
  </script>

  <script>
    var counter = 30;
    var interval = setInterval(function() {
      counter--;
      // Display 'counter' wherever you want to display it.
      if (counter <= 0) {
        clearInterval(interval);
        var emailTo = $('#email-to').val();
        $('#timer').html("<a href='service/send-otp.php?e='" + emailTo + "'><i class='fa fa-refresh'></i> &nbsp; Resend OTP</a>");
        return;
      } else {
        $('#time').text(counter);
        console.log("Timer --> " + counter);
      }
    }, 1000);
  </script>

</body>

</html>