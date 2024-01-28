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
  <title>List of Students | Institutional Based Donation System</title>
  <link rel="icon" href="./static/images/logos/logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="./static/css/styles.min.css" />
  <script
      type="text/javascript"
      src="https://code.jquery.com/jquery-3.5.1.js"
    ></script>
    <link
      rel="stylesheet"
      href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"
    />
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
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
        <div class="card">
          <?php
          $id = $_SESSION["token"];
          $role = $_SESSION["role"];

          $sql = "SELECT * FROM `user` ORDER BY `name` ASC, regNo ASC;";
          $result = mysqli_query($con, $sql);
          $num = mysqli_num_rows($result);
          ?>
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">
              Students Overview
            </h5>
              <div class="table-responsive-sm p-4">
                <table class="table table-sm table-hover" id="dataTableID">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Fullname</th>
                      <th scope="col">Reg No</th>
                      <th scope="col">CGPA</th>
                      <th scope="col">Gender</th>
                      <th scope="col">State</th>
                      <th scope="col">LGA</th>
                       <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($num <= 0) {
                      echo "<tr><td colspan='6' class='text-center text-muted py-4 h3'>
                      No item has been registered yet
                      </td></tr>";
                    } else {
                      $i = 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                    ?>  
                      <tr <?php echo ($row["role"] == 1 ? "class='table-success'" : ""); ?>>
                          <th scope="row"><?php echo $i; ?></th>
                          <td><?php echo $row["name"] ?></td>
                          <td><?php echo $row["regNo"] ?></td>
                          <td><?php echo $row["cgpa"] ?></td>
                          <td><?php echo $row["gender"] ?></td>
                          <td><?php echo $row["state"] ?></td>
                          <td><?php echo $row["lga"] ?></td>
                           <td><?php echo $row["status"] ?></td>
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
  </div>
  
  <script src="./static/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./static/js/sidebarmenu.js"></script>
  <script src="./static/js/app.min.js"></script>
  <script src="./static/libs/simplebar/dist/simplebar.js"></script>
</body>
</html>