<?php
error_reporting(0);
include("./function/checkLogin.php");
include("./api/dbcon.php");
include("./api/updateProfile.php");
checklogin();?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Student's Profile | Institutional Based Donation System</title>
  <link rel="icon" href="./static/images/logos/logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="./static/css/styles.min.css" />
  <script
      type="text/javascript"
      src="./static/js/jquery-3.5.1.js"
    ></script>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php include("./include/sidebar.php");  ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <?php include("./include/header.php"); ?>
      <!--  Header End -->
      <div class="container-fluid">
        <?php
        if (isset($_SESSION["msg"])) {
        ?>
          <div class="alert alert-info  text-center mb-4" role="alert" id="message">
            <?php echo $_SESSION["msg"]; ?>
          </div>
        <?php
        }
          unset($_SESSION["msg"]);
        ?>

        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Register Student</h5>
            <p>Effortlessly upload your student list with a single click and ensure your student records are organized in the same format.</p>
            <form action="./api/manageStudent.php" method="post">
              <div class="container">
                  <div class="row">
                    <div class="col">
                      <input type="file" class="form-control" name="studentlist" require>
                    </div>
                    <div class="col">
                      <button type="submit" class="btn btn-secondary" name="uploadStudents">
                        Upload Student List
                      </button>
                    </div>
                    <div class="form-text">
                      <a href="example.docx" download="example_document.docx" target="_blank">
                        <b>Download the spreadsheet templates here</b>
                      </a>
                    </div>
                  </div>
            </form>
              <hr>
            <form action="./api/manageStudent.php" method="post">
              <p class="fw-semibold mb-4">Or register a specific student easily by completing the form below.</p>
                <fieldset>
                  <div class="row">
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Full name</label>
                        <input class="form-control" name="name" type="text" placeholder="Enter student name" />
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Phone number</label>
                        <input class="form-control" name="phone" type="text" placeholder="Enter student phone number" />
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input class="form-control" name="email" type="text" placeholder="Enter student email address" />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select">
                          <option value="" selected disabled>Please select gender...</option>
                          <option value="female">Female</option>
                          <option value="male">Male</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">State of Origin</label>
                        <select onchange="toggleLGA(this);" name="state" id="state" class="form-select">
                          <option value="" selected="selected" disabled>Please select state...</option>
                          <option value="Abia">Abia</option>
                          <option value="Adamawa">Adamawa</option>
                          <option value="AkwaIbom">AkwaIbom</option>
                          <option value="Anambra">Anambra</option>
                          <option value="Bauchi">Bauchi</option>
                          <option value="Bayelsa">Bayelsa</option>
                          <option value="Benue">Benue</option>
                          <option value="Borno">Borno</option>
                          <option value="Cross River">Cross River</option>
                          <option value="Delta">Delta</option>
                          <option value="Ebonyi">Ebonyi</option>
                          <option value="Edo">Edo</option>
                          <option value="Ekiti">Ekiti</option>
                          <option value="Enugu">Enugu</option>
                          <option value="FCT">FCT</option>
                          <option value="Gombe">Gombe</option>
                          <option value="Imo">Imo</option>
                          <option value="Jigawa">Jigawa</option>
                          <option value="Kaduna">Kaduna</option>
                          <option value="Kano">Kano</option>
                          <option value="Katsina">Katsina</option>
                          <option value="Kebbi">Kebbi</option>
                          <option value="Kogi">Kogi</option>
                          <option value="Kwara">Kwara</option>
                          <option value="Lagos">Lagos</option>
                          <option value="Nasarawa">Nasarawa</option>
                          <option value="Niger">Niger</option>
                          <option value="Ogun">Ogun</option>
                          <option value="Ondo">Ondo</option>
                          <option value="Osun">Osun</option>
                          <option value="Oyo">Oyo</option>
                          <option value="Plateau">Plateau</option>
                          <option value="Rivers">Rivers</option>
                          <option value="Sokoto">Sokoto</option>
                          <option value="Taraba">Taraba</option>
                          <option value="Yobe">Yobe</option>
                          <option value="Zamfara">Zamafara</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">LGA of Origin</label>
                        <select name="lga" id="lga" class="form-select select-lga">
                          <option value="" selected disabled>Please select state first...</option>
                        </select>
                      </div>
                    </div>
                  </div>
                
                <div class="row">
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Faculty</label>
                      <input class="form-control" type="text" value="Faculty of Computing" disabled />
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Department</label>
                      <input class="form-control" type="text" value="Software Engineering" disabled />
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Registration number</label>
                      <input class="form-control" type="text" name="regNumber" value="CST/YY/SWE/" placeholder="Enter student reg no" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Level</label>
                       <select name="level" class="form-select">
                          <option value="" selected disabled>Please select level...</option>
                          <option value="200">Level 200</option>
                          <option value="300">Level 300</option>
                          <option value="400">Level 400</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">CGPA</label>
                      <input class="form-control" type="number" name="cgpa" placeholder="Enter student current CGPA" />
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Disability</label>
                      <select name="disability" class="form-select">
                        <option value="" selected disabled>Please select disability...</option>
                        <option value="Healthy">Healthy</option>
                        <option value="Visual Impairment">Visual Impairment</option>
                        <option value="Hearing Impairment">Hearing Impairment</option>
                        <option value="Mobility Impairment">Mobility Impairment</option>
                        <option value="Cognitive Impairment">Cognitive Impairment</option>
                        <option value="Learning Disability">Learning Disability</option>
                        <option value="Chronic Illness">Chronic Illness</option>
                        <option value="Physical Disability">Physical Disability</option>
                        <option value="Developmental Disability">Developmental Disability</option>
                        <option value="Mental Health Condition">Mental Health Condition</option>
                    </select>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary" name="addStudent">Register Student</button>
            </form>
             </fieldset>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="./static/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./static/js/sidebarmenu.js"></script>
  <script src="./static/js/app.min.js"></script>
  <script src="./static/libs/simplebar/dist/simplebar.js"></script>
  <script src="./static/js/lga.js"></script>
</body>

</html>