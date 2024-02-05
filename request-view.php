<?php
error_reporting(0);
include("./function/checkLogin.php");
include("./function/getUserById.php");
include("./api/dbcon.php");
checklogin();

if ($_SESSION["role"] == "0") {
  $_SESSION["msg"] = "You are not allowed to access this page";
  header("location: ./index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>View Student Request | Institutional Based Donation System</title>
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
                if (isset($_GET["trackingID"])) {
                  $trackingId = $_GET["trackingID"];
                  $sqlItem = "SELECT * FROM `item_table` WHERE LOWER(trackId) = LOWER('$trackingId') AND status=0";
                  $itemResult = mysqli_query($con, $sqlItem);
                  $itemData = mysqli_fetch_assoc($itemResult);
                }
              ?>
              <h5 class="card-title fw-semibold mb-4">
               Student Request Verification
              </h5>

              <?php 
                $userId = $itemData["regById"];
                $user = getUserById($userId, $con);
              ?>
              <div class="container">
                <form action="./api/item.php" method="post">
                  <div id="">
                   <input type="hidden" name="trackId" value="<?php echo $itemData["trackId"];?>" readonly/>
                   <input type="hidden" name="email" value="<?php echo $user["email"];?>" readonly/>
                   <input type="hidden" name="name" value="<?php echo $user["name"];?>" readonly/>

                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Student Name</label>
                          <p><?php echo $itemData["name"];?></p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Reg No</label>
                          <p><?php echo $itemData["regno"];?></p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Level</label>
                          <p><?php echo $itemData["level"];?></p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">State of Origin</label>
                          <p><?php echo $itemData["state"];?></p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                         <label class="form-label">CGPA</label>
                          <p><?php echo $itemData["cgpa"];?></p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Disability Status</label>
                          <p><?php echo $itemData["disability"];?></p>
                        </div>
                      </div>
                    </div>
                    <hr />
                     <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Summary of why the student needs fees found</label>
                          <p><?php echo $itemData["note"];?></p>
                        </div>
                      </div>
                    </div>
                    <hr />
                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Approval or Rejecting Note</label>
                          <textarea class="form-control" rows="3" name="checkInNote" placeholder="Enter approval or rejecting note"></textarea>
                          <div class="form-text" id="hint"></div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success m-2" name="approveItem">
                      Approve
                    </button>
                    <button type="submit" class="btn btn-outline-danger" name="rejectItem">
                      Rejected
                    </button>
     
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
