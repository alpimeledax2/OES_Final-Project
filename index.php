<?php
if (isset($_GET['status']) && $_GET['status'] == 's') {
  echo "<script>alert('Registration success')</script>";
} else if (isset($_GET['status']) && $_GET['status'] == 'p') {
  echo "<script>alert('Confirm password not match')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

  <title>OES - Online Examination System</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-grad-school.css">
</head>

<body>


  <!--header-->
  <header class="main-header clearfix" role="header">
    <div class="logo">
      <!--<a href="#"><em>Exam</em> Online</a>-->
      <img src="images/image.png" alt="logo" width="70" style="margin-bottom: 7px"; >
    </div>
    <div class="row22">
      <div class="col-md-62" style="padding-right: 0px;">
        <form id="contact" action="login.php" method="get">
          <fieldset>
            <button type="submit" id="form-submit" class="button">Login</button>
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

  <section class="section coming-soon">
    <div class="container">
      <div class="row">
        <div class="col-md-7 col-xs-12">
          <div class="continer centerIt">
            <div>
              <h4>Take <em>exam</em> of your class</h4>
              <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
              </h5>
              <div class="counter">

                <div class="days">
                  <div class="value">00</div>
                  <span>Days</span>
                </div>

                <div class="hours">
                  <div class="value">00</div>
                  <span>Hours</span>
                </div>

                <div class="minutes">
                  <div class="value">00</div>
                  <span>Minutes</span>
                </div>

                <div class="seconds">
                  <div class="value">00</div>
                  <span>Seconds</span>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5" style="padding-top:150px;">
          <div class="right-content">
            <div class="top-content">
              <img src="images/good luck poster.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p><i class="fa fa-copyright"></i> Copyright 2024 by Alfi</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="assets/js/custom.js"></script>
</body>

</html>