<?php
error_reporting(0);
include("./function/checkLogin.php");
include("./api/dbcon.php");
include("./api/updateProfile.php");
checklogin();?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo $_SESSION["role"] == 0 ? "Department" : "Donor"; ?>'s Profile | Institutional Based Donation System</title>
  <link rel="icon" href="./static/images/logos/logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="./static/css/styles.min.css" />
 <script type="text/javascript" src="./static/js/jquery-3.5.1.js"></script>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php include("./include/sidebar.php");  ?>
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

            $id = $_SESSION["token"];
            $sql = "SELECT * FROM `donors` WHERE id = '$id'";
            $result = mysqli_query($con, $sql);
            $donorData = mysqli_fetch_assoc($result);

            ?>
            <h5 class="card-title fw-semibold mb-4"><?php echo $_SESSION["role"] == 0 ? "Department" : "Donor"; ?>'s Profile</h5>
            <form action="./api/updateProfile.php" method="post">
              <input type="hidden" name="id" value="<?php echo $id;  ?>" readonly>
              <div class="container">
                <fieldset>
                  <div class="row">
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input class="form-control" name="name" type="text" value="<?php echo $donorData["name"];  ?>" require/>
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Phone number</label>
                        <input class="form-control" name="phone" type="text" value="<?php echo $donorData["phone"];  ?>" require/>
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input class="form-control" name="email" type="text" value="<?php echo $donorData["email"];  ?>" <?php echo $_SESSION["role"] == 0 ? "readonly" : ""; ?> require/>
                        <div class="form-text">We'll never share your email with anyone else.</div>
                      </div>
                    </div>
                  </div>
                </fieldset>
                <div class="row" <?php echo $_SESSION["role"] == 0 ? "hidden" : ""; ?> >
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Profession</label>
                        <input class="form-control" name="occupation" type="text" value="<?php echo $donorData["occupation"];  ?>" require/>
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Tell us about yourself</label>
                        <input class="form-control" name="about" type="text" value="<?php echo $donorData["about"];  ?>" />
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                      </div>
                    </div>
                  </div>
                <button type="submit" class="btn btn-primary" name="updateDonor">Save</button>

                <hr />
                <div class="row">
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">New password</label>
                      <input class="form-control" name="newPassword" type="password" placeholder="Enter a new password (4 to 8 characters)" require/>
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Confirm new password</label>
                      <input class="form-control" name="confirmPassword" type="password" placeholder="Confirm new password" require/>
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3"></div>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary" name="changePass">
                Change password
              </button>
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