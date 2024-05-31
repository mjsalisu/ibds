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
    <title>Donation Options | Institutional Based Donation System</title>
    <link rel="icon" href="./static/images/logos/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./static/css/styles.min.css" />
   <script type="text/javascript" src="./static/js/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="./static/css/jquery.dataTables.min.css"/>
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
            <!-- Start -->
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-1">
                Transform Lives: Support Student Scholarships
              </h5>
              <p>
                Help less privileged students overcome financial barriers and
                continue to pursue their studies.
              </p>
              <div class="row">
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Donate to Department Wallet</h5>
                      <p class="card-text">
                        Trust us to allocate your donation where it's needed
                        most, based on factors like queue position and targeted
                        amount.
                      </p>
                       <a href="wallet.php" class="card-link">Support Needy Students</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Sponsor a Student</h5>
                      <p class="card-text">
                        Select a student directly and see how your donation
                        impacts them.
                      </p>
                      <a href="students-eligible.php" class="card-link">Choose a Student</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Filter by Academic Performance</h5>
                      <p class="card-text">
                        Select a student directly and see how your donation
                        impacts them.
                      </p>
                      <a href="students-eligible.php?filter=cgpa" class="card-link">Reward High Achievers</a>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Filter by State</h5>
                      <p class="card-text">
                        Donate based on the student's State and LGA of origin,
                        ideal for state scholarships and political initiatives.
                      </p>
                      <a href="students-eligible.php?filter=state" class="card-link">Select State</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Filter by Gender</h5>
                      <p class="card-text">
                        Tailor your donation based on gender, suitable for NGOs,
                        politicians, and more.
                      </p>
                      <a href="students-eligible.php?filter=male" class="card-link">Male Students</a>
                     <a href="students-eligible.php?filter=female" class="card-link">Female Students</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Student with Special Need</h5>
                      <p class="card-text">
                        Donate specifically to students with special need, offering tailored support to those in need.
                      </p>
                      <a href="students-eligible.php?filter=disability" class="card-link">Support Students with Special Need</a>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- End -->
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
