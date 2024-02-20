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
    <title>Check-Out | Institutional Based Donation System</title>
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
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

switch ($filter) {
    case 'cgpa':
        $tableTitle = "Students by Performance";
        include("tables/filterByCGPA.php");
        break;
    case 'state':
        $tableTitle = "Students by State of Origin";
        include("tables/filterByState.php");
        break;
    case 'male':
        $tableTitle = "Male Students";
        include("tables/filterByGender.php");
        break;
    case 'female':
        $tableTitle = "Female Students";
        include("tables/filterByGender.php");
        break;
    case 'disability':
        $tableTitle = "Students with Disabilities";
        include("tables/filterByDisability.php");
        break;
    default:
        $tableTitle = "All Students";
        include("tables/filterBydefault.php");
        break;
}
?>
                </tbody>
            </table>
        </div>
    </div>
</div>




                  </tbody>
                </table>
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
