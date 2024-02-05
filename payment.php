<?php
error_reporting(0);
include("./function/checkLogin.php");
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
    <script
      type="text/javascript"
      src="./static/js/jquery-3.5.1.js"
    ></script>
    <link
      rel="stylesheet"
      href="./static/css/jquery.dataTables.min.css"
    />
    <script src="./static/js/jquery.dataTables.min.js"></script>
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

          <?php
          $sql = "SELECT * FROM `item_table` WHERE status=2";
          $result = mysqli_query($con, $sql);
          $num = mysqli_num_rows($result);
          ?>
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-1">Transform Lives: Support Student Scholarships</h5>
            <p>Help less privileged students overcome financial barriers and continue to pursue their studies.</p>

            


            <div class="card">  
              <div class="table-responsive-sm p-4">
                <form class="py-2" action="./api/updateProfile.php" method="post">
              <div class="row">
                <div class="col">
                  <input type="text" class="form-control" name="amount" placeholder="Enter your donation amount" require>
                </div>
                <div class="col">
                  <input type="text" class="form-control" name="remark" placeholder="Enter a remark if any" require>
                </div>
                <div class="col">
                   <button type="submit" class="btn btn-primary" name="DonateToDepartment">
                    Clearing Student Fees
                  </button>
                </div>
                <div class="form-text">
                  By selecting this option, you entrust the department to allocate your donation to clear student fees on your behalf, based on specified criteria (e.g. CGPA, etc).
                </div>
              </div>
            </form>
              </div>
            </div>

            <div class="card">  
              <div class="table-responsive-sm p-4">
                <table class="table table-sm table-hover" id="dataTableID">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Item Name</th>
                      <th scope="col">Type</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Tracking ID</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    if ($num <= 0) {
                      echo "<tr><td colspan='6' class='text-center text-muted py-4 h3'>
                      No data available for students
                      </td></tr>";
                    } else {
                      $i = 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                          <th scope="row"><?php echo $i; ?></th>
                          <td><?php echo $row["itemName"] ?></td>
                          <td><?php echo $row["itemType"] ?></td>
                          <td><?php echo $row["itemQuantity"] ?></td>
                          <td><?php echo $row["trackId"] ?></td>
                          <td>
                            <a href="view-checkout.php?trackingID=<?php echo $row["trackId"] ?>" 
                            class="btn btn-sm btn-light">Check-Out</a>
                          </td>
                        </tr>
                    <?php
                        $i++;
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
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
