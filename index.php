<?php
error_reporting(0);
include("./function/checkLogin.php");
include("./api/dbcon.php");
checklogin();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard | Institutional Based Donation System</title>
  <link rel="icon" href="./static/images/logos/logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="./static/css/styles.min.css" />
  <script
      type="text/javascript"
      src="https://code.jquery.com/jquery-3.5.1.js"
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
      <?php include("./include/header.php");  ?>
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

             <div class="alert alert-info text-center" role="alert">
                Help students in need register before the deadline to ensure uninterrupted education. Your support makes a difference.
                <br><b>There are 00 days 00 hr 00 min 00 sec Left</b>
              </div>
            
         <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">   
            <div class="card w-100">
              <div class="card-body p-4">
                <div class="mb-4">
                  <h5 class="card-title fw-semibold">Projected for 2023/24 Session</h5>
                </div>
                
                <h4 class="fw-semibold">N6,100,000</h4>
                <p class="fs-2 mb-0">Donation Deposited to Department Wallet</p>
                <hr>
                <ul class="timeline-widget mb-0 position-relative mb-n5">
                  <li class="timeline-item d-flex position-relative overflow-hidden">
                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                      <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-2"></span>
                      <span class="timeline-badge-border d-block flex-shrink-0"></span>
                    </div>
                    <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">Total Students (Level 200-400)
                      <span class="text-primary d-block fw-normal">1,500</span>
                    </div>
                  </li>
                  <li class="timeline-item d-flex position-relative overflow-hidden">
                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                      <span class="timeline-badge border-2 border border-info flex-shrink-0 my-2"></span>
                      <span class="timeline-badge-border d-block flex-shrink-0"></span>
                    </div>
                    <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">Students Seeking Aid
                      <span class="text-primary d-block fw-normal">300</span>
                    </div>
                  </li>
                  <li class="timeline-item d-flex position-relative overflow-hidden">
                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                      <span class="timeline-badge border-2 border border-danger flex-shrink-0 my-2"></span>
                      <span class="timeline-badge-border d-block flex-shrink-0"></span>
                    </div>
                    <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">Fundraising Target Goal
                      <span class="text-danger d-block fw-normal">N1,200,000</span>
                    </div>
                  </li>
                  <li class="timeline-item d-flex position-relative overflow-hidden">
                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                      <span class="timeline-badge border-2 border border-success flex-shrink-0 my-2"></span>
                      <span class="timeline-badge-border d-block flex-shrink-0"></span>
                    </div>
                    <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">Amount Raised
                      <span class="text-success d-block fw-normal">N1,000,000</span>
                    </div>
                  </li>
                  <hr>
                  <li class="timeline-item d-flex position-relative overflow-hidden">
                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                      <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-2"></span>
                      <span class="timeline-badge-border d-block flex-shrink-0"></span>
                    </div>
                    <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">Total Registered Donors
                      <span class="text-primary d-block fw-normal">5,500</span>
                    </div>
                  </li>
                  <br>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body py-4">
                <div
                  class="d-flex mb-4 justify-content-between align-items-center"
                >
                  <?php
                $id = $_SESSION["token"];
                $role = $_SESSION["role"];

                $sql;
                if ($role == "0") {
                  $sql = "SELECT * FROM `item_table` WHERE regById = '$id' ORDER BY `created_at` ASC LIMIT 5";
                } else {
                  $sql = "SELECT * FROM `item_table` ORDER BY `created_at` DESC LIMIT 5";
                }
                $result = mysqli_query($con, $sql);
                $num = mysqli_num_rows($result);
                // print_r($data);
                ?>
                <h5 class="card-title fw-semibold mb-4">Recent 5 Students Eligible for Financial Aid</h5>
                </div>
                <div class="table-responsive" data-simplebar>
                  <table class="table table-borderless align-middle text-nowrap">
                    <thead>
                      <tr>
                        <th scope="col">Student</th>
                        <th scope="col">Reg No</th>
                        <th scope="col">RRR</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($num <= 0) {
                         echo "<tr><td colspan='5' class='text-center text-muted py-4 h3'>
                          No item has been registered yet
                          </td></tr>";
                      } else {
                        // $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                          <tr>
                             <td>
                              <div class="d-flex align-items-center">
                                <div>
                                  <h6 class="mb-1 fw-bolder"><?php echo $row["itemName"] ?></h6>
                                  <p class="fs-3 mb-0">More details</p>
                                </div>
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <p class="fs-3 fw-normal mb-0"><?php echo $row["itemType"] ?></p>
                            </td>
                            <td class="border-bottom-0">
                              <p class="mb-0 fw-normal"><?php echo ($row["checkInDate"] != "" ? $row["checkInDate"] : "—");  ?></p>
                            </td>
                            <td class="border-bottom-0">
                              <a href="view-checkout.php?trackingID=<?php echo $row["trackId"] ?>" 
                              class="btn btn-sm btn-light-info">Donate</a>
                          <!-- <?php
                              $status = $row["status"];
                              if ($status == "0") {
                                echo '<span class="badge bg-light-warning rounded-pill text-warning px-3 py-2 fs-3">
                              Pending';
                              } elseif ($status == "1") {
                                echo '<span class="badge bg-light-danger rounded-pill text-danger px-3 py-2 fs-3">
                              Rejected';
                              } elseif ($status == "2") {
                                echo '<span class="badge bg-light-success rounded-pill text-success px-3 py-2 fs-3">
                              Safe';
                              } elseif ($status == "3") {
                                echo '<span class="badge bg-light-primary rounded-pill text-primary px-3 py-2 fs-3">
                              Retrived';
                              }
                              echo '</span>';
                          ?> -->
                            </td>
                          </tr>
                      <?php
                          // $i++;
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
        <div class="px-4 text-center">
          <p class="mb-0 fs-4">Design and Developed by <br> <b>Jamilu Salisu - CST/19/SWE/4009</b></p>
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