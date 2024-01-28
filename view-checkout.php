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
    <title>Check-Out | Institutional Based Donation System</title>
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
                  $sqlItem = "SELECT * FROM `item_table` WHERE LOWER(trackId) = LOWER('$trackingId') AND status=2";
                  $itemResult = mysqli_query($con, $sqlItem);
                  $itemData = mysqli_fetch_assoc($itemResult);
                }
              ?>

              <h5 class="card-title fw-semibold mb-4">
                Item Check-Out and Collection
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
                          <label class="form-label">Item Name</label>
                          <p><?php echo $itemData["itemName"];?></p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Item Type</label>
                          <p><?php echo $itemData["itemType"];?></p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Quantity</label>
                          <p><?php echo $itemData["itemQuantity"];?></p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Check-In Date</label>
                          <p><?php echo $itemData["checkInDate"];?></p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                         <label class="form-label">Check-In Note</label>
                          <p><?php echo $itemData["checkInNote"];?></p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <!-- <label class="form-label">Check-In By</label>
                          <p><?php echo $itemData["checkInBy"];?></p> -->
                        </div>
                      </div>
                    </div>
                    <hr />
                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Check-Out Note </label>
                          <textarea class="form-control" rows="3" name="checkOutNote" placeholder="Enter check-out note"></textarea>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success m-2" name="checkOutItem">
                      Checkout
                    </button>
                    <button type="reset" class="btn btn-light">Cancel</button>
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
