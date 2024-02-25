<?php
error_reporting(0);
include(".././api/dbcon.php");
include(".././function/checkLogin.php");
include(".././function/getTotalDonation.php");

$filter = isset($_GET['studentID']) ? $_GET['studentID'] : '';

if (empty($filter)) {
    $_SESSION["msg"] = 'It seems you are lost, let\'s take you back to the right page.';
    header("location: ./index.php");
}
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
                            <h5 class="card-title fw-semibold mb-5">
                            Look what have for you below!
                            </h5>
                        </div>
                        <div class="col text-end">
                            <a href="./index.php" class="btn btn-sm btn-dark"> Go Back </a>
                        </div>
                        </div>

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

                        <?php
                          // TODO: status??
                          $sql = "SELECT r.*, s.* FROM request r JOIN students s ON r.studentID = s.id WHERE r.studentID='$filter'";
                          if ($result = mysqli_query($con, $sql)) {
                            $num = mysqli_num_rows($result);
                            if ($num > 0) {
                                $studentData = mysqli_fetch_assoc($result);
                            } else {
                                $_SESSION["msg"] = 'No student found with the provided ID, let\'s take you back to the right page.';
                                header("location: ./index.php");
                            
                            }
                          }
                        ?>

                        <div class="row">
                        <div class="col-sm">
                            <div class="mb-3">
                            <label class="form-label">Full name</label>
                            <p><?php echo $studentData["name"];?></p>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="mb-3">
                            <label class="form-label">Reg No</label>
                            <p>CS<?php echo $studentData["regno"];?></p>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="mb-3">
                            <label class="form-label">State and LGA of Origin</label>
                            <p><?php echo $studentData["state"];?>, <?php echo $studentData["lga"];?></p>
                            </div>
                        </div>
                        </div>
                        <hr />
                        <div class="row">
                        <div class="col-sm">
                            <div class="mb-3">
                            <label class="form-label">Request ID</label>
                            <p><?php echo $studentData["requestID"];?></p>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="mb-3">
                            <label class="form-label">Submitted on</label>
                            <p><?php echo $studentData["created_at"];?></p>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="mb-3">
                            <label class="form-label">Status</label>
                            <p><?php
                                $status = $studentData["status"];
                                if ($status == "Pending") {
                                    echo '<span class="badge bg-warning rounded-3">Pending</span>';
                                } elseif ($status == "Approved") {
                                    echo '<span class="badge bg-success rounded-3">Approved</span>';
                                } elseif ($status == "Rejected") {
                                    echo '<span class="badge bg-danger rounded-3">Rejected</span>';
                                } elseif ($status == "Cleared") {
                                    echo '<span class="badge bg-info rounded-3">Cleared</span>';
                                } else {
                                  echo '<span class="badge bg-light text-dark rounded-3"> --N/A-- </span>';
                                }
                            ?></p>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-sm">
                            <label class="form-label">Approval / Rejection Note</label>
                            <p><?php 
                                if ($status ==  'Rejected' || $status == 'Cleared' || $status == 'Approved') {
                                    echo $studentData["remarkNote"];
                                } else {
                                    echo 'Your request is under review. Please check back later';
                                }
                            ?></p>
                        </div>
                        </div>
                        <hr />
                        <?php 
                            $studentID = $studentData["studentID"];
                            $totalRaisedData = getTotalRaised($studentID, $con);
                            $totalRaised = $totalRaisedData["raised"];
                            $uniqueDonors = $totalRaisedData["unique_donors"];
                        ?>
                        <div class="row" <?php if ($status == 'Pending') { echo 'style="display: none;"'; } ?>>
                        <div class="col-sm">
                            <div class="mb-3">
                            <label class="form-label">Amount Raised</label>
                            <p>₦ <?php echo amountFormat($totalRaised); ?></p>
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
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="mb-3">
                            <label class="form-label">Supported By</label>
                            <p><?php echo $uniqueDonors; ?> donors</p>
                            </div>
                        </div>
                        </div>
                    </fieldset>
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