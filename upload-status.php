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
  <title>Student's Upload Status | Institutional Based Donation System</title>
  <link rel="icon" href="./static/images/logos/logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="./static/css/styles.min.css" />
  <script
      type="text/javascript"
      src="./static/js/jquery-3.5.1.js"
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
            <h5 class="card-title fw-semibold mb-4">Your uploading status</h5>
            <hr>
            <!--  Table Start -->
              <?php 
if(isset($_POST['submit'])) {

	$allowedExtensions = array("xls","xlsx","csv");
	$ext = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);

	if (in_array($ext, $allowedExtensions)) {
    // Uploaded file
    $file = "uploads/" . $_FILES['uploadFile']['name'];
    $isUploaded = copy($_FILES['uploadFile']['tmp_name'], $file);

    // Check if file was successfully uploaded
    if ($isUploaded) {
        // Include PHPExcel files and database configuration file
        include("db.php");
        require_once __DIR__ . '/vendor/autoload.php';
        include(__DIR__ . '/vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php');

        try {
            // Load uploaded file
            $objPHPExcel = PHPExcel_IOFactory::load($file);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($file, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        // Specify the excel sheet index
        $sheet = $objPHPExcel->getSheet(0);
        $total_rows = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

		// Initialize arrays to store success and failure reports
		$successReports = [];
		$failureReports = [];

        // Loop over the rows
        for ($row = 2; $row <= $total_rows; ++$row) {
            // Initialize variables to store cell values
            $name = $phone = $email = $gender = $state = $lga = $regno = $level = $cgpa = $disability = '';

            // Loop over the columns
            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                $cell = $sheet->getCellByColumnAndRow($col, $row);
                $val = $cell->getValue();

                // Assign cell values to corresponding variables based on column index
                switch ($col) {
					case 0:
						$name = $mysqli->real_escape_string($val);
						break;
					case 1:
						$phone = $mysqli->real_escape_string($val);
						break;
					case 2:
						$email = $mysqli->real_escape_string($val);
						break;
					case 3:
						$gender = $mysqli->real_escape_string($val);
						break;
					case 4:
						$state = $mysqli->real_escape_string($val);
						break;
					case 5:
						$lga = $mysqli->real_escape_string($val);
						break;
					case 6:
						$regno = $mysqli->real_escape_string($val);
						break;
					case 7:
						$level = $mysqli->real_escape_string($val);
						break;
					case 8:
						$cgpa = $mysqli->real_escape_string($val);
						break;
					case 9:
						$disability = $mysqli->real_escape_string($val);
						break;
					default:
						break;
				}
            }

			// Check if regNo, phone, and email are not empty
			if (!empty($regno) && !empty($phone) && !empty($email)) {
				// Check if the user already exists in the database
				$checkQuery = "SELECT regno, phone, email FROM students WHERE regno = '$regno' OR phone = '$phone' OR email = '$email'";
				$result = $mysqli->query($checkQuery);

				if ($result && $result->num_rows > 0) {
					// User already exists, add failure report to the failureReports array
					$failureReports[] = "Duplicate record found | $regno | $name | $phone";
				} else {
					// User does not exist, proceed with insertion
					$query = "INSERT INTO students (name, phone, email, gender, state, lga, regno, level, cgpa, disability) 
							VALUES ('$name', '$phone', '$email', '$gender', '$state', '$lga', '$regno', '$level', '$cgpa', '$disability')";
					$result = $mysqli->query($query);

					// Check for database error
					if ($result) {
						// Add success report to the successReports array
						$successReports[] = "Record inserted | $regno | $name | $phone";
					} else {
						// Add failure report to the failureReports array
						$failureReports[] = "Failed to insert record | $regno | $name | $phone";
					}
				}
			} else {
				// Add failure report to the failureReports array
				$failureReports[] = "Skipped record with missing data | $regno | $name | $phone";
			}
        }

		echo "<h4>Success Reports:</h4>";
		echo "<div class='table-responsive'>";
		echo "<table class='table table-striped table-bordered'>";
		echo "<thead><tr><th>Status</th><th>Reg No</th><th>Name</th><th>Phone</th></tr></thead>";
		echo "<tbody>";
		foreach ($successReports as $report) {
			// Split the report into regNo and Name
			list($reason, $regNo, $name) = explode("|", $report);
			echo "<tr><td>$reason</td><td>$regNo</td><td>$name</td><td>$phone</td></tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";

		echo "<h4>Failure Reports:</h4>";
		echo "<div class='table-responsive'>";
		echo "<table class='table table-striped table-bordered'>";
		echo "<thead><tr><th>Status</th><th>Reg No</th><th>Name</th><th>Phone</th></tr></thead>";
		echo "<tbody>";
		foreach ($failureReports as $report) {
			// Split the report into regNo and Name
			list($reason, $regNo, $name) = explode("|", $report);
			echo "<tr><td>$reason</td><td>$regNo</td><td>$name</td><td>$phone</td></tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";

        echo "<br/>Data inserted in Database";

        // Remove uploaded file
        unlink($file);
    } else {
        // Error message when file uploading fails
        echo '<span class="msg">File not uploaded' . $file . '.</span>';
    }
} else {
    // Error message when file extension is not allowed
    echo '<span class="msg">Please upload an Excel file with allowed extensions.</span>';
}

}
?>
            <!--  Table End -->
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