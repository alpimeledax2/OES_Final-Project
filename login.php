<?php
session_start();

session_destroy();
?>

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
  <link rel="stylesheet" href="assets/css/templatemo-grad-school.css">
  
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
<header class="main-header clearfix" role="header">
    <div class="logo">
      <!--<a href="#"><em>Exam</em> Online</a>-->
      <!--<img src="images/image.png" alt="logo" width="70" style="margin-bottom: 7px"; > -->
    </div>
    <div class="row22">
      <div class="col-md-62" style="padding-right: 0px;">
        <form id="contact" action="login.php" method="get">
          <fieldset>
            <button type="submit" id="form-submit" class="button">Log In</button>
          </fieldset>
        </form>
      </div>
      <div class="col-md-62" style="padding-left: 0px;">
        <form id="contact" action="register.php" method="get">
          <fieldset>
            <button type="submit" id="form-submit" class="button">Register</button>
          </fieldset>
        </form>
      </div>
    </div>
  </header>
  <div class="login-box">

    <?php
    if (isset($_GET['r'])) {
      if ($_GET['r'] == 'failed') { ?>
        <!-- Alert login failed -->
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Login Failed!</strong> Invalid email or password.
        </div>

      <?php
      } else if ($_GET['r'] == 'logout') { ?>
        <!-- Alert success logout -->
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          Logout success.
        </div>
      <?php
      } else if ($_GET['r'] == 'invalid') { ?>
        <!-- Alert invalid session -->
        <div class="alert alert-info alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          You need to login first before access the dashboard.
        </div>
      <?php
      } else if ($_GET['r'] == 'reset-password') { ?>
        <!-- Alert invalid session -->
        <div class="alert alert-info alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Reset Password Success!</strong> Please retry sign in.
        </div>
    <?php
      }
    }
    ?>

    <div class="login-box-body">
    <div class="login-logo">
      <img src="images/image.png" alt="logo" width="70" style="margin-bottom: 7px"; href="index.php" >
    </div>
      <p class="login-box-msg">Sign in to start your session</p>
      <form action="service/login-service.php" method="post">
        <div class="form-group has-feedback">
          <p>Email</p>
          <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off" required="required" />
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <p>Password</p>
          <input type="password" name="password" class="form-control" placeholder="Password" required="required" />
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8" style="padding-top:8px;">
            <a href="fp-email.php">Forgot Password</a>
          </div><!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
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