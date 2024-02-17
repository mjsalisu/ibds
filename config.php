<?php
error_reporting(0);
include("./function/checkLogin.php");
include("./api/dbcon.php");
include("./api/systemConfiguration.php");
checklogin();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>System Configuration | Institutional Based Donation System</title>
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
            $sql = "SELECT * FROM `system_configuration`";
            $result = mysqli_query($con, $sql);
            $num = mysqli_num_rows($result);
            $userData = mysqli_fetch_assoc($result);

            ?>
            <h5 class="card-title fw-semibold mb-4">System Configuration</h5>
            <form action="./api/systemConfiguration.php" method="post">
              <input type="hidden" name="id" value="<?php echo $userData["id"];  ?>">
              <div class="container">
                <fieldset>
                  <div class="row">
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Faculty</label>
                        <input class="form-control" name="faculty" type="text" value="<?php echo $userData["faculty"];  ?>" />
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Department</label>
                        <input class="form-control" name="department" type="text" value="<?php echo $userData["department"];  ?>" />
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Fees Amount</label>
                        <input class="form-control" name="amount" type="currency" value="<?php echo $userData["fees_amount"];  ?>" />
                        <!-- <div class="form-text">
                            We'll never share your email with anyone else.
                          </div> -->
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Application Deadline</label>
                        <input class="form-control" name="deadline" type="date" value="<?php echo $userData["application_deadline"];  ?>" />
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Bank Name</label>
                        <input class="form-control" name="bank" type="text" value="<?php echo $userData["bank_name"];  ?>" />
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Account Number</label>
                        <input class="form-control" name="accountno" type="text" value="<?php echo $userData["account_number"];  ?>" />
                        <div class="form-text">Account MUST reflect instition name: Bayero University</div>
                      </div>
                    </div>
                  </div>
                </fieldset>
                <?php

                if ($num == 0) {
                ?>

                  <button type="submit" class="btn btn-primary" name="systemConfig">Save</button>

                <?php

                } else {
                ?>
                  <button type="submit" class="btn btn-primary" name="systemConfigSave">Update</button>

                <?php

                }

                ?>
                <hr />
                <!-- <div class="row">
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
              </button> -->
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