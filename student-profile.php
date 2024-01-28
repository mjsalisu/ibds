<?php
error_reporting(0);
include("./function/checkLogin.php");
include("./api/dbcon.php");
include("./api/updateProfile.php");
checklogin();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Student's Profile | Institutional Based Donation System</title>
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
            $sql = "SELECT * FROM `user` WHERE id = '$id'";
            $result = mysqli_query($con, $sql);
            $userData = mysqli_fetch_assoc($result);

            ?>
            <h5 class="card-title fw-semibold mb-4">Student's Profile</h5>
            <form action="./api/updateProfile.php" method="post">
              <input type="hidden" name="id" value="<?php echo $id;  ?>">
              <div class="container">
                <fieldset>
                  <div class="row">
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Full name</label>
                        <input class="form-control" name="name" type="text" value="<?php echo $userData["name"];  ?>" />
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Phone number</label>
                        <input class="form-control" name="phone" type="text" value="<?php echo $userData["phone"];  ?>" />
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input class="form-control" name="email" type="text" value="<?php echo $userData["email"];  ?>" />
                        <!-- <div class="form-text">
                            We'll never share your email with anyone else.
                          </div> -->
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <input class="form-control" name="gender" type="text" value="<?php echo $userData["gender"];  ?>" />
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">State of Origin</label>
                        <input class="form-control" name="state" type="text" value="<?php echo $userData["state"];  ?>" />
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">LGA of Origin</label>
                        <input class="form-control" name="lga" type="text" value="<?php echo $userData["lga"];  ?>" />
                      </div>
                    </div>
                  </div>
                </fieldset>
                <hr />
                <div class="row">
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Faculty</label>
                      <input class="form-control" type="text" value="Faculty of Computing" disabled />
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Department</label>
                      <input class="form-control" type="text" value="Software Engineering" disabled />
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Registration number</label>
                      <input class="form-control" type="text" name="regNumber" placeholder="Enter your registration number" value="<?php echo $userData["regNo"];  ?>" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Level</label>
                      <input class="form-control" type="text" name="level" placeholder="Enter your current level" value="<?php echo $userData["level"];  ?>" />
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">CGPA</label>
                      <input class="form-control" type="text" name="cgpa" placeholder="Enter your current CGPA" value="<?php echo $userData["cgpa"];  ?>" />
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Status</label>
                      <input class="form-control" type="text" name="status" placeholder="See status..." value="<?php echo $userData["status"];  ?>" />
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary" name="updateProfile">Save</button>
                <hr />
                <div class="row">
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">New password</label>
                      <input class="form-control" name="newPassword" type="text" placeholder="Enter a new password (4 to 8 characters)" require/>
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3"></div>
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