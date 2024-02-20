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
    <title>Student Request | Institutional Based Donation System</title>
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
          $sql = "SELECT * FROM `students` WHERE status=1 ORDER by createdAt ASC;";
          $result = mysqli_query($con, $sql);
          $num = mysqli_num_rows($result);
          ?>
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">
              Student Requests
            </h5>
            <div class="card">
              <div class="table-responsive-sm p-4">
                <table class="table table-sm table-hover" id="dataTableID">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Reg No</th>
                      <th scope="col">Level</th>
                      <th scope="col">CGPA</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    if ($num <= 0) {
                      echo "<tr><td colspan='6' class='text-center text-muted py-4 h3'>
                      No student have submit request for review.
                      </td></tr>";
                    } else {
                      $i = 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                          <th scope="row"><?php echo $i; ?></th>
                          <td><?php echo $row["name"] ?></td>
                          <td><?php echo $row["regno"] ?></td>
                          <td><?php echo $row["level"] ?></td>
                          <td><?php echo $row["cgpa"] ?></td>
                          <td>
                            <a href="request-view.php?studentID=<?php echo $row["id"] ?>" 
                            class="btn btn-sm btn-light">Review</a>
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
    </div>
    <script src="./static/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./static/js/sidebarmenu.js"></script>
    <script src="./static/js/app.min.js"></script>
    <script src="./static/libs/simplebar/dist/simplebar.js"></script>
  </body>
</html>
