<?php
error_reporting(0);
include("./function/checkLogin.php");
include("./function/getTotalDonation.php");
include("./api/dbcon.php");
checklogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Donations Transaction | Institutional Based Donation System</title>
  <link rel="icon" href="./static/images/logos/logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="./static/css/styles.min.css" />
 <script type="text/javascript" src="./static/js/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="./static/css/jquery.dataTables.min.css"/>
    <script src="./static/js/jquery.dataTables.min.js"></script>
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

          if ($role !=0) {
            $sql = "SELECT donations.*, donors.name AS dName, donors.phone AS dPhone, students.name AS sName, students.regno FROM donations INNER JOIN donors ON donations.donatedBy = donors.id INNER JOIN students ON donations.donatedTo = students.id WHERE donations.donatedBy =$id ORDER BY dName ASC, sName ASC, regno ASC;";
          } else {
            $sql = "SELECT donations.*, donors.name as dName, donors.phone as dPhone, students.name as sName, students.regno FROM donations INNER JOIN donors ON donations.donatedBy = donors.id INNER JOIN students ON donations.donatedTo = students.id ORDER BY dName ASC, sName ASC, regno ASC;";
          }

          $result = mysqli_query($con, $sql);
          $num = mysqli_num_rows($result);
          ?>
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">
              <?php echo $_SESSION["role"] == 0 ? "Donation History" : "My Donation History"; ?>'s Overview
            </h5>
              <div class="table-responsive-sm p-4">
                <table class="table table-sm table-hover" id="dataTableID">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                   <?php if ($role == "0") : ?>
                      <th scope="col">Donated by</th>
                      <th scope="col">Donor's Phone</th>
                    <?php endif; ?>
                      <th scope="col">Amount</th>
                      <th scope="col">Donated to</th>
                      <th scope="col">Reg No</th>
                      <th scope="col">Timestamp</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($num <= 0) {
                      echo "<tr><td colspan='6' class='text-center text-muted py-2 h5'>
                            At this time, no donation has been made to any student.
                      </td></tr>";
                    } else {
                      $i = 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                      <tr>
                          <?php 
                            $donorID = $row["id"];
                            $totalDonated = getTotalDonated($donorID, $con);
                            $totalDonated = $totalDonated["donated"];
                          ?>
                          <th scope="row"><?php echo $i; ?></th>
                       
                      <?php if ($role == "0") : ?>
                          <td><?php echo $row["dName"] ?></td>
                          <td><?php echo $row["dPhone"] ?></td>
                      <?php endif; ?>
                          <td><?php echo amountFormat($row["amount"]); ?></td>
                          <td><?php echo $row["sName"] ?></td>
                          <td><?php echo $row["regno"] ?></td>
                          <td><?php echo $row["createdAt"] ?></td>
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