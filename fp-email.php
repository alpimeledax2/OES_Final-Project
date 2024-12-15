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
          Send OTP failed. Please try again.
        </div>
      <?php
      } else if ($_GET['r'] == 'expired') { ?>
        <!-- Alert OTP expired -->
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          OTP reach expiration time. Please try again.
        </div>
      <?php
      } else if ($_GET['r'] == 'not-found') { ?>
        <!-- Alert email not found -->
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          Email not found. Please try again.
        </div>
    <?php
      }
    }
    ?>

    <div class="login-logo">
    </div><!-- /.login-logo -->
    <div class="login-box-body">
    <div class="login-logo">
      <img src="images/image.png" alt="logo" width="70" style="margin-bottom: 7px"; href="index.php" >
    </div>
      <p class="login-box-msg">Enter your email to send the OTP</p>
      <form action="service/send-otp.php" method="post">
        <div class="form-group has-feedback">
          <input type="email" name="email-to" class="form-control" placeholder="Email" autocomplete="off" required="required" />
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
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

</body>

</html>