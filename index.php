<?php
error_reporting(0);
include("./function/checkLogin.php");
include("./function/getTotalDonation.php");
include("./function/getCountdown.php");
include("./api/dbcon.php");
checklogin();?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard | Institutional Based Donation System</title>
  <link rel="icon" href="./static/images/logos/logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="./static/css/styles.min.css" />
 <script type="text/javascript" src="./static/js/jquery-3.5.1.js"></script>
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
            $sql1 = "SELECT(SELECT SUM(amount) FROM wallet) AS walletBalance, (SELECT COUNT(*) FROM donors) AS 
            TotalRegisteredDonors, (SELECT COUNT(*) FROM students WHERE level BETWEEN 200 AND 400) AS TotalStudents, 
            (SELECT SUM(amount) FROM donations) AS AmountRaised, (SELECT application_deadline from system_config) as deadline;";
            if ($result1 = mysqli_query($con, $sql1)) {
                $num1 = mysqli_num_rows($result1);
                if ($num1 > 0) {
                    $data = mysqli_fetch_assoc($result1);
                }
            }

            $countdownValues = getCountdown($data["deadline"]);
          ?>

             <div class="alert alert-info text-center" role="alert">
                Help students in need register before the deadline to ensure uninterrupted education. Your support makes a difference.
                <br><div id="countdown"></div>
              </div>
            
         <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">   
            <div class="card w-100">
              <div class="card-body p-4">
                <div class="mb-4">
                  <h5 class="card-title fw-semibold">Projected for 2023/24 Session</h5>
                </div>
                
                <h4 class="fw-semibold">N<?php echo amountFormat($data["walletBalance"]) ?></h4>
                <p class="fs-2 mb-0">Donation Deposited to Department Wallet</p>
                <hr>
                <ul class="timeline-widget mb-0 position-relative mb-n5">
                  <li class="timeline-item d-flex position-relative overflow-hidden">
                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                      <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-2"></span>
                      <span class="timeline-badge-border d-block flex-shrink-0"></span>
                    </div>
                    <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">Total Registered Donors:
                      <span class="text-primary d-block fw-bolder"><?php echo numberFormat($data["TotalRegisteredDonors"]) ?> donors</span>
                    </div>
                  </li>
                  <li class="timeline-item d-flex position-relative overflow-hidden">
                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                      <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-2"></span>
                      <span class="timeline-badge-border d-block flex-shrink-0"></span>
                    </div>
                    <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">Total Students (Level 200-400)
                      <span class="text-primary d-block fw-bolder"><?php echo numberFormat($data["TotalStudents"]) ?> students</span>
                    </div>
                  </li>
                  <li class="timeline-item d-flex position-relative overflow-hidden">
                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                      <span class="timeline-badge border-2 border border-info flex-shrink-0 my-2"></span>
                      <span class="timeline-badge-border d-block flex-shrink-0"></span>
                    </div>
                    <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">Students Seeking Aid
                      <span class="text-primary d-block fw-bolder"><?php echo numberFormat($data["TotalStudents"]) ?> students</span>
                    </div>
                  </li>
                  <li class="timeline-item d-flex position-relative overflow-hidden">
                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                      <span class="timeline-badge border-2 border border-danger flex-shrink-0 my-2"></span>
                      <span class="timeline-badge-border d-block flex-shrink-0"></span>
                    </div>
                    <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">Fundraising Target Goal
                      <span class="text-danger d-block fw-bolder">N<?php echo amountFormat($data["TotalStudents"] *100000); ?></span>
                    </div>
                  </li>
                  <li class="timeline-item d-flex position-relative overflow-hidden">
                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                      <span class="timeline-badge border-2 border border-success flex-shrink-0 my-2"></span>
                      <span class="timeline-badge-border d-block flex-shrink-0"></span>
                    </div>
                    <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">Amount Raised
                      <span class="text-primary d-block fw-bolder">N<?php echo amountFormat($data["AmountRaised"]) ?></span>
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
                $sql = "SELECT s.id, s.name, s.regno, s.level, s.cgpa, s.disability, SUM(d.amount) AS raised FROM students s LEFT JOIN donations d ON s.id = d.donatedTo GROUP BY s.id HAVING raised != 100000 ORDER BY raised DESC, s.cgpa DESC, s.name ASC, s.createdAt ASC LIMIT 5;";
                
                $result = mysqli_query($con, $sql);
                $num = mysqli_num_rows($result);
                // print_r($data);
              ?>
                <h5 class="card-title fw-semibold mb-4">Top 5 Eligible Students for Financial Aid</h5>
                </div>
                <div class="table-responsive" data-simplebar>
                  <table class="table table-borderless align-middle text-nowrap">
                    <thead>
                      <tr>
                        <th scope="col">Student</th>
                        <th scope="col">Amount Raised</th>
                        <th scope="col">Level</th>
                        <th scope="col">Disability</th>
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
                                  <h6 class="mb-1 fw-bolder"><?php echo $row["name"] ?></h6>
                                  <p class="fs-3 mb-0">CGPA: <?php echo $row["cgpa"] ?></p>
                                </div>
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <p class="fs-3 fw-normal mb-0"><?php echo amountFormat($row["raised"]); ?></p>
                            </td>
                            <td class="border-bottom-0">
                              <p class="fs-3 fw-normal mb-0"><?php echo $row["level"] ?></p>
                            </td>
                            <td class="border-bottom-0">
                              <p class="mb-0 fw-normal"><?php echo $row["disability"];  ?></p>
                            </td>
                            <td class="border-bottom-0">
                              <a href="payment.php?studentID=<?php echo $row["id"] ?>" 
                              class="btn btn-sm btn-primary">Donate Now</a>
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
          <p class="mb-0 fs-4">Design and Developed by <b>Jamilu Salisu - CST/19/SWE/4009</b></p>
        </div>
      </div>
    </div>
  </div>
  <script src="./static/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./static/js/sidebarmenu.js"></script>
  <script src="./static/js/app.min.js"></script>
  <script src="./static/libs/simplebar/dist/simplebar.js"></script>
  <script>
// Set initial countdown values from PHP variables
var days = <?php echo $countdownValues['days']; ?>;
var hours = <?php echo $countdownValues['hours']; ?>;
var minutes = <?php echo $countdownValues['minutes']; ?>;
var seconds = <?php echo $countdownValues['seconds']; ?>;

// Function to update countdown every second
function updateCountdown() {
    var countdownElem = document.getElementById('countdown');
    countdownElem.innerHTML = '<b>There are ' + days + ' days ' + hours + ' hr ' + minutes + ' min ' + seconds + ' sec left</b>';

    // Decrease seconds
    seconds--;
    
    // Update minutes and reset seconds if needed
    if (seconds < 0) {
        seconds = 59;
        minutes--;
    }

    // Update hours and reset minutes if needed
    if (minutes < 0) {
        minutes = 59;
        hours--;
    }

    // Update days and reset hours if needed
    if (hours < 0) {
        hours = 23;
        days--;
    }

    // Stop countdown if reached zero
    if (days < 0) {
        clearInterval(timer);
        countdownElem.innerHTML = '<b class="text-danger">Application has closed, thank you for your support!</b>';
    }
}

// Call updateCountdown every second
var timer = setInterval(updateCountdown, 1000);
</script>
</body>
</html>