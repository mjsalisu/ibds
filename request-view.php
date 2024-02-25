<?php
error_reporting(0);
include("./function/checkLogin.php");
include("./function/getUserById.php");
include("./api/dbcon.php");
checklogin();
isAdmin();
$filter = isset($_GET['studentID']) ? $_GET['studentID'] : '';

if (empty($filter)) {
    $_SESSION["msg"] = 'It seems you are lost, let\'s take you back to the right page.';
    header("location: ./request-logs.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Review Request | Institutional Based Donation System</title>
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
              <?php
                // TODO: status??
                $sql = "SELECT r.id as reqKey, r.requestID, r.studentID as studentID, r.studentNote, s.* FROM request r JOIN students s 
                        ON r.studentID = s.id WHERE r.studentID='$filter'";
                if ($result = mysqli_query($con, $sql)) {
                  $num = mysqli_num_rows($result);
                  if ($num > 0) {
                      $studentData = mysqli_fetch_assoc($result);
                  }
                }
              ?>

              <div class="row">
                    <div class="col text-start">
                        <h5 class="card-title fw-semibold mb-1">Student Request Verification</h5>
                    </div>
                    <div class="col text-end">
                        <a href="request-logs.php" class="btn btn-sm btn-dark"> Go Back </a>
                    </div>
                </div>

                <hr>

              <?php 
                $userId = $studentData["regById"];
                $user = getUserById($userId, $con);
              ?>
              <div class="container">
                <form action="./api/requestAPI.php" method="post">
                  <div id="">
                   <input type="hidden" name="requestID" value="<?php echo $studentData["requestID"];?>" readonly/>
                   <input type="hidden" name="studentID" value="<?php echo $studentData["studentID"];?>" readonly/>
                    <input type="hidden" name="studentEmail" value="<?php echo $studentData["email"];?>" readonly/>
                    <input type="hidden" name="studentName" value="<?php echo $studentData["name"];?>" readonly/>

                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Student's Name</label>
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
                          <label class="form-label">Phone</label>
                          <p><?php echo $studentData["phone"];?></p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">State & LGA of Origin</label>
                          <p><?php echo $studentData["state"];?>, <?php echo $studentData["lga"];?></p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                         <label class="form-label">Level & Current CGPA</label>
                          <p><?php echo $studentData["level"];?>, <?php echo $studentData["cgpa"];?></p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Disability Status</label>
                          <p><?php echo $studentData["disability"];?></p>
                        </div>
                      </div>
                    </div>
                    <hr />
                     <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Summary of why the student needs fees found</label>
                          <p><?php echo $studentData["studentNote"];?></p>
                        </div>
                      </div>
                    </div>
                    <hr />
                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Approval or Rejecting Note</label>
                          <textarea class="form-control" rows="2" name="approveNote"
                          placeholder="Enter approval or rejecting note for the student" required></textarea>
                          <div class="form-text" id="hint"></div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success m-2" name="approveRequest">Approve</button>
                    <button type="submit" class="btn btn-outline-danger" name="rejectRequest">Rejected</button>
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
