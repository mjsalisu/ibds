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
    <title>Donate to the Institute | Institutional Based Donation System</title>
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
             <h5 class="card-title fw-semibold mb-1">Transform Lives: Support Student Scholarships</h5>
              <p>By choosing this option, you authorize the department to allocate your donation to 
                cover student fees based on specified criteria (e.g., highest raised amount, CGPA, final 
                year status, etc.).</p>  
              <div class="container">

                  <?php
                  $id = $_SESSION["token"];
                  $sql = "SELECT * FROM `system_config` WHERE `id` = 1";
                    if ($result = mysqli_query($con, $sql)) {
                      $num = mysqli_num_rows($result);
                      if ($num > 0) {
                          $walletData = mysqli_fetch_assoc($result);
                      }
                    }
                  ?>
                <form action="./api/paymentAPI.php" method="post">
                  <div id="">
                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Account Name</label>
                          <p>Software Engineering Department, Bayero University, Kano</p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Bank Name</label>
                          <p><?php echo $walletData["bank_name"];?></p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Account Number</label>
                          <p><?php echo $walletData["account_number"];?></p>
                        </div>
                      </div>
                    </div>
                    <hr />
                    <input type="hidden" name="donorID" value="<?php echo $id;?>" readonly/>
                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Remark Note for the Department</label>
                          <textarea class="form-control" rows="2" name="remark" placeholder="Enter a remark if any"></textarea>
                          <div class="form-text" id="hint"></div>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Amount</label>
                          <input class="form-control" type="number" placeholder="Enter the amount to be donated" name="amount" min="500.00" required>
                          <div class="form-text">Any amount is appreciated. Minimum amount is 500.00</div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary m-2" name="payDepartment">Proceed with Payment</button>
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
