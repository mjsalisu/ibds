<?php
error_reporting(0);
include("./function/checkLogin.php");
include("./function/getTotalDonation.php");
include("./api/dbcon.php");
checklogin();
$filter = isset($_GET['studentID']) ? $_GET['studentID'] : '';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Donate to Student | Institutional Based Donation System</title>
    <link rel="icon" href="./static/images/logos/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./static/css/styles.min.css" />
  </head>

  <body>
    <!--  Body Wrapper -->
    <div
      class="page-wrapper"
      id="main-wrapper"
      data-layout="vertical"
      data-navbarbg="skin6"
      data-sidebartype="full"
      data-sidebar-position="fixed"
      data-header-position="fixed"
    >
      <!-- Sidebar Start -->
      <?php include("./include/sidebar.php"); ?>
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
              <div class="row">
                    <div class="col text-start">
                        <h5 class="card-title fw-semibold mb-1">Transform Lives: Support Student Scholarships</h5>
                    </div>
                    <div class="col text-end">
                        <a href="donation-options.php" class="btn btn-sm btn-dark"> Go Back </a>
                    </div>
                    <p>Help less privileged students overcome financial barriers and continue to pursue their studies.</p>
                </div>

              <div class="container">
                  <?php
                  $id = $_SESSION["token"];
                  $sql = "SELECT s.*, (SELECT SUM(amount) FROM wallet) AS walletBalance FROM students s WHERE id='$filter'";
                    if ($result = mysqli_query($con, $sql)) {
                      $num = mysqli_num_rows($result);
                      if ($num > 0) {
                          $studentData = mysqli_fetch_assoc($result);
                      }
                    }
                  ?>
                <form action="./api/paymentAPI.php" method="post">
                  <div id="">
                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Student's Name</label>
                          <p><?php echo $studentData["name"];?></p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">State of Origin</label>
                          <p><?php echo $studentData["state"];?></p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">LGA</label>
                          <p><?php echo $studentData["lga"];?></p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Gender</label>
                          <p><?php echo $studentData["gender"];?></p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                         <label class="form-label">Reg No</label>
                          <p><?php echo $studentData["regno"];?></p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Level</label>
                          <p><?php echo $studentData["level"];?></p>
                        </div>
                      </div>
                    </div>
                     <?php 
                          $studentID = $studentData["id"];
                          $totalRaised = getTotalRaised($studentID, $con);
                          $totalRaised = $totalRaised["raised"];
                      ?>
                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                         <label class="form-label">CGPA</label>
                          <p><?php echo $studentData["cgpa"];?></p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Amount Raised</label>
                          <p><?php echo amountFormat($totalRaised); ?></p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Amount Left</label>
                          <p>
                            <?php 
                              $leftAmout = amountFormat(100000 - $totalRaised); 
                              echo $leftAmout; ?>
                          </p>
                          <input type="hidden" name="studentID" value="<?php echo $studentData["id"];?>" readonly/>
                          <input type="hidden" name="studentEmail" value="<?php echo $studentData["email"];?>" readonly/>
                          <input type="hidden" name="studentName" value="<?php echo $studentData["name"];?>" readonly/>
                          <input type="hidden" name="donorID" value="<?php echo $id;?>" readonly/>
                          <input type="hidden" name="leftAmount" value="<?php echo floatval(str_replace(',', '', $leftAmout));?>" readonly/>
                        </div>
                      </div>
                    </div>
                    <hr />
                     <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Summary of why the student needs fees found</label>
                          <p><?php echo $studentData["note"];?></p>
                        </div>
                      </div>
                    </div>
                    <hr />
                    <div class="row">
                  <?php if ($_SESSION["role"] == 0) : ?>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Wallet Balance</label>
                          <p><?php echo amountFormat($studentData["walletBalance"]);?></p>
                          <input class="form-control" type="number" name="walletBalance" value="<?php echo $studentData["walletBalance"];?>" readonly  required>
                        </div>
                      </div>
                  <?php endif; ?>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Remark Note for the Student</label>
                          <textarea class="form-control" rows="2" name="remark" placeholder="Enter a remark if any"></textarea>
                          <div class="form-text" id="hint"></div>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Amount</label>
                      <?php if ($_SESSION["role"] == 0) : ?>
                          <input class="form-control" type="number" placeholder="Enter the amount to be donated" name="amount" min="1.00" max="<?php echo $leftAmout; ?>" required>
                      <?php endif; ?>
                      <?php if ($_SESSION["role"] != 0) : ?>
                          <input class="form-control" type="number" placeholder="Enter the amount to be donated" name="amount" min="500.00" max="<?php echo $leftAmout; ?>" required>
                      <?php endif; ?>
                          <div class="form-text"><?php echo $_SESSION["role"] == 0 ? "Minimum: 1.00 and maximum: ".$leftAmout : "Minimum: 500.00 and maximum: ".$leftAmout; ?></div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary m-2" name="makePayment">Proceed with Payment</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="./static/libs/jquery/dist/jquery.min.js"></script>
    <script src="./static/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./static/js/sidebarmenu.js"></script>
    <script src="./static/js/app.min.js"></script>
    <script src="./static/libs/simplebar/dist/simplebar.js"></script>
  </body>
</html>
