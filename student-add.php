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
            <fieldset>
            <form action="./api/manageStudent.php" method="post">
              <p class="fw-semibold mb-4">Or register a specific student easily by completing the form below.</p>
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
                        <input class="form-control" name="phone" type="text" placeholder="Enter student 11 digit phone number"  maxlength="11"  />
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
                          <?php
                            $genders = array("Female", "Male");
                            foreach ($genders as $gender) {
                                echo '<option value="' . strtolower($gender) . '"';
                                echo '>' . $gender . '</option>';
                            }
                            ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">State of Origin</label>
                        <select onchange="toggleLGA(this);" name="state" id="state" class="form-select">
                          <option value="" selected="selected" disabled>Please select state...</option>
                           <?php
                            $states = array(
                                "Abia", "Adamawa", "AkwaIbom", "Anambra", "Bauchi", "Bayelsa", "Benue", "Borno", "Cross River",
                                "Delta", "Ebonyi", "Edo", "Ekiti", "Enugu", "FCT", "Gombe", "Imo", "Jigawa", "Kaduna",
                                "Kano", "Katsina", "Kebbi", "Kogi", "Kwara", "Lagos", "Nasarawa", "Niger", "Ogun", "Ondo",
                                "Osun", "Oyo", "Plateau", "Rivers", "Sokoto", "Taraba", "Yobe", "Zamfara"
                            );
                            foreach ($states as $state) {
                                echo '<option value="' . $state . '"';
                                echo '>' . $state . '</option>';
                            }
                            ?>
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
                           <?php
                            $options = array("200", "300", "400");
                            foreach ($options as $option) {
                                echo '<option value="' . $option . '"';
                                echo '>Level ' . $option . '</option>';
                            }
                          ?>
                        </select>
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">CGPA</label>
                      <input class="form-control" type="number" name="cgpa" placeholder="Enter student's current CGPA (up to 5.0)" min="0.0" max="5.0" step="0.01" />
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Disability</label>
                      <select name="disability" class="form-select">
                        <option value="" selected disabled>Please select disability...</option>
                        <?php
                          $options = array(
                              "Healthy",
                              "Visual Impairment",
                              "Hearing Impairment",
                              "Mobility Impairment",
                              "Cognitive Impairment",
                              "Learning Disability",
                              "Chronic Illness",
                              "Physical Disability",
                              "Developmental Disability",
                              "Mental Health Condition"
                          );
                          
                          foreach ($options as $option) {
                              echo '<option value="' . $option . '"';
                              echo '>' . $option . '</option>';
                          }
                          ?>
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