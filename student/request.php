<?php
error_reporting(0);
include(".././api/dbcon.php");
include(".././function/checkLogin.php");
include(".././function/random.php");
$requestID = generateRandomString();

$filter = isset($_GET['studentID']) ? $_GET['studentID'] : '';

if (empty($filter)) {
    $_SESSION["msg"] = 'It seems you are lost, let\'s take you back to the right page.';
    header("location: ./student/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Request Form | Institutional Based Donation System</title>
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
                    <div class="row">
                        <div class="col text-start">
                            <h5 class="card-title fw-semibold mb-5">Request for financial assistance</h5>
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
                          $sql = "SELECT * FROM students WHERE id='$filter'";
                          if ($result = mysqli_query($con, $sql)) {
                            $num = mysqli_num_rows($result);
                            if ($num > 0) {
                                $studentData = mysqli_fetch_assoc($result);
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
                            <p><?php echo $studentData["regno"];?></p>
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
                      <fieldset>
                        <form action=".././api/requestAPI.php" method="post">
                        <div class="row">
                            <div class="col-sm">
                                <div class="mb-3">
                                <label class="form-label">Why do you need finacial assistance?</label>
                                <textarea class="form-control" rows="2" name="remark" placeholder="Enter reason for financial assistance" required></textarea>
                                <div class="form-text" id="hint"></div>
                                </div>
                              </div>
                            <input class="form-control" type="hidden" name="studentID" value="<?php echo $studentData["id"];?>" readonly required>
                            <input class="form-control" type="hidden" name="requestID" value="<?php echo $requestID; ?>" readonly required>
                          </div>
                        <h4 class="card-title mb-0">Request ID: <span class="fw-semibold text-danger"><?php echo $requestID; ?></span></h4>
                        <div class="form-text mb-4">Note your request ID for future reference</div>
                        <button type="submit" name="submitRequest" class="btn btn-primary">Submit Request</button>
                        </form>
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