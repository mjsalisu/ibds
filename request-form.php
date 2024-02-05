<?php
error_reporting(0);
include("./function/checkLogin.php");
include("./api/item.php");
checklogin();

// if ($_SESSION["role"] == "1") {
//   $_SESSION["msg"] = "You are not allowed to access this page";
//   header("location: ./index.php");
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Item Registration | Institutional Based Donation System</title>
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
            <h5 class="card-title fw-semibold mb-4">
              Register your valuable item
            </h5>
            <form action="./api/item.php" method="post" enctype="multipart/form-data">
              <div class="container">
                <div class="row">
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Item name</label>
                      <input class="form-control" type="text" name="itemName" placeholder="Enter item name" required />
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Item Type</label>
                      <input class="form-control" type="text" name="itemType" placeholder="Enter item type such as phone, laptop, etc." required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Quantity</label>
                      <input class="form-control" type="number" name="itemQuantity" min="1" placeholder="Enter quantity" required />
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Image</label>
                      <input class="form-control" type="file" name="itemImage" accept="image/*" required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Description</label>
                      <textarea class="form-control" rows="4" name="itemDescription" placeholder="Enter item description" required></textarea>
                      <div class="form-text" id="hint">
                        Items not checked in within 30 days will be deleted,
                        while those not checked out within 1 year will be
                        automatically archived.
                      </div>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary" name="addItem">
                  Submit for Approval
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="./static/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./static/js/sidebarmenu.js"></script>
  <script src="./static/js/app.min.js"></script>
  <script src="./static/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>