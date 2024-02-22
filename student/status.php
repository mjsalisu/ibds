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
  <title>Request Status | Institutional Based Donation System</title>
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
                  <fieldset>
                    <div class="row">
                        <div class="col text-start">
                            <h5 class="card-title fw-semibold mb-4">
                            Look what have for you below!
                            </h5>
                        </div>
                        <div class="col text-end">
                            <a href="./index.php" class="btn btn-sm btn-dark"> Go Back </a>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-sm">
                            <div class="mb-3">
                            <label class="form-label">Full name</label>
                            <p>Abdulrahman Abdulrazaq</p>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="mb-3">
                            <label class="form-label">Reg No</label>
                            <p>CST/17/IFT/00029</p>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="mb-3">
                            <label class="form-label">State and LGA of Origin</label>
                            <p>Kano, Bebeji</p>
                            </div>
                        </div>
                        </div>
                        <hr />
                        <div class="row">
                        <div class="col-sm">
                            <div class="mb-3">
                            <label class="form-label">Request ID</label>
                            <p>ST/2021/0001</p>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="mb-3">
                            <label class="form-label">Submitted on</label>
                            <p>12th May, 2021</p>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="mb-3">
                            <label class="form-label">Status</label>
                            <p>Pending</p>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-sm">
                            <label class="form-label">Approval / Rejection Note</label>
                            <p>
                            Congratulations! Your request has been approved. You can now proceed
                            to make payment.
                            </p>
                        </div>
                        </div>
                        <hr />
                        <div class="row">
                        <div class="col-sm">
                            <div class="mb-3">
                            <label class="form-label">Amount Raised</label>
                            <p>₦ 50,000</p>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="mb-3">
                            <label class="form-label">Amount Left</label>
                            <p>₦ 50,000</p>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="mb-3">
                            <label class="form-label">Supported By</label>
                            <p>10 donors</p>
                            </div>
                        </div>
                        </div>
                    </fieldset>
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
</body>

</html>