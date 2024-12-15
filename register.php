<?php
include 'config/connection.php';
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
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
<style>
   .select2-dropdown {
    background-color: rgba(250, 250, 250, 0.1); /* Transparent background for dropdown */
    border: none;
    color: #000000; /* Text color inside the dropdown */
  }
 
</style>
  
</head>

<body>


  <!--header-->
  <header class="main-header clearfix" role="header">
    <div class="logo">
    <a href="index.php">
  <img src="images/image.png" alt="logo" width="70" style="margin-bottom: 7px;">
</a>
    </div>
  </header>

  <section class="section contact" data-section="section6">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Registration Form</h2>
          </div>
        </div>
        <form id="contact" action="service/register-student.php" method="post" enctype="multipart/form-data">
          <label style="color: white;"><b>PERSONAL DATA</b></label>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6">
                <fieldset>
                  <label style="color: white;">NIK</label>
                  <input name="nik" type="text" class="form-control" id="nik" placeholder="NIK" required="required" autocomplete="off">
                </fieldset>
              </div>
              <div class="col-md-6">
                <fieldset>
                  <label style="color: white;">Fullname</label>
                  <input name="fullname" type="text" class="form-control" id="fullname" placeholder="Fullname" required="required" autocomplete="off">
                </fieldset>
              </div>
              <div class="col-md-4">
                <fieldset>
                  <label style="color: white;">Date of Birth</label>
                  <input name="dob" type="date" class="form-control" id="dob" placeholder="" required="required">
                </fieldset>
              </div>
              <div class="col-md-2">
                <fieldset>
                  <label style="color: white;">Age</label>
                  <input name="age" type="text" class="form-control" id="age" placeholder="" required="required" onkeydown="return false;">
                </fieldset>
              </div>
              <div class="col-md-6">
                <fieldset>
                  <label style="color: white;">Place of Birth</label>
                  <input name="pob" type="text" class="form-control" id="pob" placeholder="Place of Birth" required="required" autocomplete="off">
                </fieldset>
              </div>
            </div>
          </div>

          <label style="color: white;"><b>ACCOUNT</b></label>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <fieldset>
                  <label style="color: white;">Email</label>
                  <input name="email" type="email" class="form-control" id="email" placeholder="Email" required="required" autocomplete="off">
                </fieldset>
              </div>
              <div class="col-md-6">
                <fieldset>
                  <label style="color: white;">Password</label>
                  <input name="password" type="password" class="form-control" id="password" placeholder="Password" required="required">
                </fieldset>
              </div>
              <div class="col-md-6">
                <fieldset>
                  <label style="color: white;">Confirm Password</label>
                  <input name="confirm-password" type="password" class="form-control" id="confirm-password" placeholder="Confirm Password" required="required">
                </fieldset>
              </div>
            </div>
          </div>

          <label style="color: white;"><b>SCHOOL DOMICILE</b></label>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6">
                <fieldset>
                  <label style="color: white;">Province</label>
                  <select name="province" id="province" required="required" class="dropdown-select-2" style="
    width: 100%;
    height: 40px;
    background-color: rgba(250,250,250,0.1);
    border-radius: 0px;
    border: none;
    outline: #000000;
    color: #000000;
    font-size: 13px;
    margin-bottom: 20px;
    letter-spacing: 0.5px;">
                    <option value="">Select Province</option>
                    <?php
                    $result = mysqli_query($conn, "SELECT id,name FROM provinces ORDER BY name");
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                      <option value="<?php echo $data['id'] ?>"><?php echo $data['name'] ?></option>
                    <?php } ?>
                  </select>
                </fieldset>
              </div>
              <div class="col-md-6">
                <fieldset>
                  <label style="color: white;">City</label>
                  <select name="city" id="city" required="required" class="dropdown-select-2" style="
    width: 100%;
    height: 40px;
    background-color: rgba(250,250,250,0.1);
    border-radius: 0px;
    border: none;
    outline: none;
    color: #fff;
    font-size: 13px;
    margin-bottom: 20px;
    letter-spacing: 0.5px;">
                    <option value="">Select City</option>
                  </select>
                </fieldset>
              </div>
              <div class="col-md-6">
                <fieldset>
                  <label style="color: white;">School Name</label>
                  <input name="school-name" type="text" class="form-control" id="schoolName" placeholder="School Name" required="required" autocomplete="off">
                </fieldset>
              </div>
              <div class="col-md-6">
                <fieldset>
                  <label style="color: white;">Major</label>
                  <select name="major" required="required" id="major" class="dropdown-select-2" style="
    width: 100%;
    height: 40px;
    background-color: rgba(250,250,250,0.1);
    border-radius: 0px;
    border: none;
    outline: none;
    color: #fff;
    font-size: 13px;
    margin-bottom: 20px;
    letter-spacing: 0.5px;">
                    <option value="">Select Major</option>
                    <?php
                    $result = mysqli_query($conn, "SELECT id,name FROM school_majors ORDER BY name");
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                      <option value="<?php echo $data['id'] ?>"><?php echo $data['name'] ?></option>
                    <?php } ?>
                  </select>
                </fieldset>
              </div>
            </div>
          </div>

          <label style="color: white;"><b>UNIVERSITIES CHOICE</b></label>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6">
                <fieldset>
                  <label style="color: white;">Choosen University #1</label>
                  <select name="univ1" id="univ1" required="required" class="dropdown-select-2" style="
    width: 100%;
    height: 40px;
    background-color: rgba(250,250,250,0.1);
    border-radius: 0px;
    border: none;
    outline: none;
    color: #fff;
    font-size: 13px;
    margin-bottom: 20px;
    letter-spacing: 0.5px;">
                    <option value="">Select University</option>
                    <?php
                    $result = mysqli_query($conn, "SELECT id,name FROM universities ORDER BY name");
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                      <option value="<?php echo $data['id'] ?>"><?php echo $data['name'] ?></option>
                    <?php } ?>
                  </select>
                </fieldset>
              </div>
              <div class="col-md-6">
                <fieldset>
                  <label style="color: white;">Major</label>
                  <select name="univ-major1" id="univ-major1" required="required" class="dropdown-select-2" style="
    width: 100%;
    height: 40px;
    background-color: rgba(250,250,250,0.1);
    border-radius: 0px;
    border: none;
    outline: none;
    color: #fff;
    font-size: 13px;
    margin-bottom: 20px;
    letter-spacing: 0.5px;">
                    <option value="">Select Major</option>
                    <?php
                    $result = mysqli_query($conn, "SELECT id,name FROM university_majors ORDER BY name");
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                      <option value="<?php echo $data['id'] ?>"><?php echo $data['name'] ?></option>
                    <?php } ?>
                  </select>
                </fieldset>
              </div>
              <div class="col-md-6">
                <fieldset>
                  <label style="color: white;">Choosen University #2</label>
                  <select name="univ2" id="univ2" required="required" class="dropdown-select-2" style="
    width: 100%;
    height: 40px;
    background-color: rgba(250,250,250,0.1);
    border-radius: 0px;
    border: none;
    outline: none;
    color: #fff;
    font-size: 13px;
    margin-bottom: 20px;
    letter-spacing: 0.5px;">
                    <option value="">Select University</option>
                    <?php
                    $result = mysqli_query($conn, "SELECT id,name FROM universities ORDER BY name");
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                      <option value="<?php echo $data['id'] ?>"><?php echo $data['name'] ?></option>
                    <?php } ?>
                  </select>
                </fieldset>
              </div>
              <div class="col-md-6">
                <fieldset>
                  <label style="color: white;">Major</label>
                  <select name="univ-major2" id="univ-major2" required="required" class="dropdown-select-2" style="
    width: 100%;
    height: 40px;
    background-color: rgba(250,250,250,0.1);
    border-radius: 0px;
    border: none;
    outline: none;
    color: #fff;
    font-size: 13px;
    margin-bottom: 20px;
    letter-spacing: 0.5px;">
                    <option value="">Select Major</option>
                    <?php
                    $result = mysqli_query($conn, "SELECT id,name FROM university_majors ORDER BY name");
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                      <option value="<?php echo $data['id'] ?>"><?php echo $data['name'] ?></option>
                    <?php } ?>
                  </select>
                </fieldset>
              </div>
            </div>
          </div>

          <label style="color: white;"><b>PROFILE IMAGE</b></label>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6">
                <fieldset>
                  <label style="color: white;">Image</label>
                  <input name="image" type="file" class="form-control" id="image" required="required">
                </fieldset>
              </div>
              <div class="col-md-6 col-md-offset-2">
                <fieldset>
                  <label>&nbsp;</label>
                  <img src="" id="preview" alt="" width="400">
                </fieldset>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                <fieldset>
                  <button type="submit" id="form-submit" class="button">Submit</button>
                </fieldset>
              </div>
            </div>
          </div>

        </form>
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
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="vendor/jquery/jquery.min.js"></script>
  
  <script>
    $(document).ready(function() {
      $('.dropdown-select-2').select2({
        theme: "classic",
        
      });

      $('body').on("change", "#dob", function() {
        var now = new Date(); //getting current date
        var currentY = now.getFullYear();

        var dobget = document.getElementById("dob").value; //getting user input
        var dob = new Date(dobget);
        var prevY = dob.getFullYear();

        var ageY = currentY - prevY;

        $('#age').val(ageY + ' years ');
      });

      $('body').on("change", "#image", function() {
        preview.src = URL.createObjectURL(event.target.files[0]);
      });

      $('body').on("change", "#province", function() {
        var id = $(this).val();
        var data = "province-id=" + id;
        $.ajax({
          type: 'POST',
          url: "service/get-city-service.php",
          data: data,
          success: function(result) {
            $("#city").html(result);
          }
        });
      });
    });
  </script>
</body>

</html>