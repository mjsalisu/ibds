<?php
error_reporting(0);
include(".././function/checkLogin.php");
include(".././api/dbcon.php");
include(".././api/updateProfile.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Student Search | Institutional Based Donation System</title>
  <link rel="icon" href=".././static/images/logos/logo.png" type="image/x-icon" />
  <link rel="stylesheet" href=".././static/css/styles.min.css" />
  <script type="text/javascript" src=".././static/js/jquery-3.5.1.js"></script>
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-12 col-md-8 col-lg-7 col-xxl-6">
            <div class="card mb-0">
              <div class="card-body">
                  <h5 class="card-title fw-semibold mb-4">
                    Software Engineering Student Fees Assistance Portal
                  </h5>
                  <p>
                    Are you a student enrolled in the <b>Software Engineering Department at Bayero
                    University, Kano</b>, and require financial assistance to cover your school fees?
                    Or perhaps you've submitted your application and need to check your status? If
                    yes, simply fill out the form below to proceed.
                  </p>
                  <hr />
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
                  <form action=".././api/requestAPI.php" method="post">
                    <div class="mb-3">
                      <label class="form-label">What will you like to do?</label>
                      <select name="userChoice" id="userChoice" class="form-select">
                          <option value="" selected disabled>Please select...</option>
                              <?php
                                  $userChoices = array("Submit request", "Check request status");
                                  foreach ($userChoices as $userChoice) {
                                      echo '<option value="' . strtolower($userChoice) . '">' . $userChoice . '</option>';
                                  }
                              ?>
                      </select>
                    </div>
                     <fieldset id="forRequest">
                    <div id="submitFields" style="display: none">
                      <div class="mb-3">
                        <label for="regNo" class="form-label">Registration Number</label>
                        <input type="text" class="form-control" name="regNo" placeholder="Please enter your full registration number (e.g. CST/19/SWE/00001)" required />
                      </div>
                      <div class="mb-3">
                        <label for="email" class="form-label">Email address or phone number</label>
                        <input type="text" class="form-control" name="emailOrPhone" placeholder="Please enter your email address or phone number" required/>
                      </div>
                    </div>
                    </fieldset>

                    <fieldset id="forStatus">
                    <div id="checkStatusFields" style="display: none">
                      <div class="mb-3">
                        <label for="requestID" class="form-label">Request ID</label>
                        <input type="text" class="form-control" name="requestID" placeholder="Please enter your request ID" required />
                      </div>
                    </div>
                    </fieldset>
                    <button type="submit" name="SearchStudents" class="btn btn-primary">Submit</button>
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- END HERE-->
  <script src=".././static/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src=".././static/js/sidebarmenu.js"></script>
  <script src=".././static/js/app.min.js"></script>
  <script src=".././static/libs/simplebar/dist/simplebar.js"></script>
  <script src=".././static/js/lga.js"></script>
  <script>
    document.getElementById('userChoice').addEventListener('change', function () {
        var submitFields = document.getElementById('submitFields');
        var checkStatusFields = document.getElementById('checkStatusFields');
        if (this.value === 'submit request') {
            submitFields.style.display = 'block';
            checkStatusFields.style.display = 'none';
            document.getElementById('forRequest').disabled = false;
            document.getElementById('forStatus').disabled = true;
        } else if (this.value === 'check request status') {
            submitFields.style.display = 'none';
            checkStatusFields.style.display = 'block';
            document.getElementById('forStatus').disabled = false;
            document.getElementById('forRequest').disabled = true
        } else {
            submitFields.style.display = 'none';
            checkStatusFields.style.display = 'none';
        }
    });
</script>
</body>

</html>