<?php
error_reporting(0);
include("./function/checkLogin.php");
include("./function/getTotalDonation.php");
include("./api/dbcon.php");
include("./api/updateProfile.php");
checklogin();
isAdmin();
$filter = isset($_GET['studentID']) ? $_GET['studentID'] : '';

if (empty($filter)) {
    $_SESSION["msg"] = 'It seems you are lost';
    header("location: ./students-list.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Student's Profile | Institutional Based Donation System</title>
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
            $sql = "SELECT * FROM `students` WHERE id='$filter'";
              if ($result = mysqli_query($con, $sql)) {
                $num = mysqli_num_rows($result);
                if ($num > 0) {
                    $userData = mysqli_fetch_assoc($result);
                }
              }
            ?>
            <div class="row">
                    <div class="col text-start">
                       <h5 class="card-title fw-semibold mb-4">Manage Student's Profile</h5>
                    </div>
                    <div class="col text-end">
                        <a href="students-list.php" class="btn btn-sm btn-dark"> Go Back </a>
                    </div>
                </div>
            <fieldset>
            <form action="./api/updateProfile.php" method="post">
              <input type="hidden" name="id" value="<?php echo $userData["id"];  ?>" readonly>
              <div class="container">
                  <div class="row">
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Full name</label>
                        <input class="form-control" name="name" type="text" value="<?php echo $userData["name"];  ?>" require/>
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Phone number</label>
                        <input class="form-control" name="phone" type="text" value="<?php echo $userData["phone"];  ?>" require />
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input class="form-control" name="email" type="text" value="<?php echo $userData["email"];  ?>" require />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select">
                            <?php
                            $genders = array("Female", "Male");
                            foreach ($genders as $gender) {
                                echo '<option value="' . strtolower($gender) . '"';
                                if ($userData["gender"] == strtolower($gender)) {
                                    echo ' selected';
                                }
                                echo '>' . $gender . '</option>';
                            }
                            ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">State of Origin</label>
                        <select onchange="toggleLGA(this);" name="state" id="state" class="form-select">
                            <?php
                            $states = array(
                                "Abia", "Adamawa", "AkwaIbom", "Anambra", "Bauchi", "Bayelsa", "Benue", "Borno", "Cross River",
                                "Delta", "Ebonyi", "Edo", "Ekiti", "Enugu", "FCT", "Gombe", "Imo", "Jigawa", "Kaduna",
                                "Kano", "Katsina", "Kebbi", "Kogi", "Kwara", "Lagos", "Nasarawa", "Niger", "Ogun", "Ondo",
                                "Osun", "Oyo", "Plateau", "Rivers", "Sokoto", "Taraba", "Yobe", "Zamfara"
                            );
                            foreach ($states as $state) {
                                echo '<option value="' . $state . '"';
                                if ($userData["state"] == $state) {
                                    echo ' selected';
                                }
                                echo '>' . $state . '</option>';
                            }
                            ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">LGA of Origin</label>
                        <select name="lga" id="lga" class="form-select select-lga">
                          <option value="<?php echo $userData["lga"];  ?>" selected><?php echo $userData["lga"];  ?></option>
                        </select>
                      </div>
                    </div>
                  </div>
                
                <div class="row">
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Faculty</label>
                      <input class="form-control" type="text" value="Faculty of Computing" require disabled />
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Department</label>
                      <input class="form-control" type="text" value="Software Engineering" require disabled />
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Registration number</label>
                      <input class="form-control" type="text" name="regNumber" value="<?php echo $userData["regno"];  ?>" require />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Level</label>
                       <select name="level" class="form-select">
                          <?php
                            $options = array("200", "300", "400");
                            foreach ($options as $option) {
                                echo '<option value="' . $option . '"';
                                if ($userData["level"] == $option) {
                                    echo ' selected';
                                }
                                echo '>Level ' . $option . '</option>';
                            }
                          ?>
                        </select>
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">CGPA</label>
                      <input class="form-control" type="number" name="cgpa" value="<?php echo $userData["cgpa"];  ?>" require min="0.0" max="5.0" step="0.01" />
                      <div class="form-text">Must be within the range of 0.0 to 5.0</div>
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Disability</label>
                      <select name="disability" class="form-select">
                        <?php
                          $options = array(
                              "Healthy",
                              "Visual Impairment",
                              "Hearing Impairment",
                              "Mobility Impairment",
                              "Cognitive Impairment",
                              "Learning Disability",
                              "Chronic Illness",
                              "Physical Disability",
                              "Developmental Disability",
                              "Mental Health Condition"
                          );
                          
                          foreach ($options as $option) {
                              echo '<option value="' . $option . '"';
                              if ($userData["disability"] == $option) {
                                  echo ' selected';
                              }
                              echo '>' . $option . '</option>';
                          }
                          ?>
                      </select>
                    </div>
                  </div>
                </div>
                <?php 
                  $studentID = $userData["id"];
                  $totalRaisedData = getTotalRaised($studentID, $con);
                  $totalRaised = $totalRaisedData["raised"];
                  $uniqueDonors = $totalRaisedData["unique_donors"];
                ?>
                <div class="row">
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Status</label>
                      <p><?php
                                $status = $userData["status"];
                                if ($status == "Pending") {
                                    echo '<span class="badge bg-warning rounded-3">Pending</span>';
                                } elseif ($status == "Approved") {
                                    echo '<span class="badge bg-success rounded-3">Approved</span>';
                                } elseif ($status == "Rejected") {
                                    echo '<span class="badge bg-danger rounded-3">Rejected</span>';
                                } elseif ($status == "Cleared") {
                                    echo '<span class="badge bg-info rounded-3">Cleared</span>';
                                } else {
                                  echo '<span class="badge bg-light text-dark rounded-3"> --N/A-- </span>';
                                }
                        ?></p>
                      <!-- <input class="form-control" type="text" value="Faculty of Computing" require disabled /> -->
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Amount Raised</label>
                      <p>₦ <?php echo amountFormat($totalRaised); ?></p>
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Supported By</label>
                      <p><?php echo $uniqueDonors; ?> donor(s)</p>
                      <!-- <select name="status" class="form-select">
                          <?php
                            $options = array("Not Requested", "Pending", "Rejected", "Approved", "Cleared");
                            foreach ($options as $option) {
                                echo '<option value="' . $option . '"';
                                if ($userData["status"] == $option) {
                                    echo ' selected';
                                }
                                echo '>' . $option . '</option>';
                            }
                          ?>
                        </select> -->
                    </div>
                  </div>

                </div>

                <button type="submit" class="btn btn-primary" name="updateStudent">Update Student Record</button>
              </form>
            </fieldset>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="./static/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./static/js/sidebarmenu.js"></script>
  <script src="./static/js/app.min.js"></script>
  <script src="./static/libs/simplebar/dist/simplebar.js"></script>
  <script src="./static/js/lga.js"></script>
</body>

</html>