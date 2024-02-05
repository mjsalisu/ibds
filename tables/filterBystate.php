<?php
error_reporting(0);
include(".././function/checkLogin.php");
include(".././api/dbcon.php");
checklogin();

if ($_SESSION["role"] == "0") {
  $_SESSION["msg"] = "You are not allowed to access this page";
  header("location: ./index.php");
}



$sql = "SELECT id, name, regno, level, state, lga FROM `students` ORDER BY `state` ASC, `lga` ASC";
$result = mysqli_query($con, $sql);
$num = mysqli_num_rows($result);
?>
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-1">Empower Students: Donate for Education</h5>
        <p>Make a difference in the lives of deserving students by supporting their academic aspirations.</p>
           
        <div class="card">  
            <div class="table-responsive-sm p-4">
                <h5 class="card-title fw-semibold mb-4"><?php echo $tableTitle; ?></h5>
                <table class="table table-sm table-hover" id="dataTableID">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Reg No.</th>
                        <th scope="col">Level</th>
                        <th scope="col">State</th>
                        <th scope="col">LGA</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                <tbody>

                <?php
                    if ($num <= 0) {
                      echo "<tr><td colspan='6' class='text-center text-muted py-4 h3'>
                      No data available for students
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
                    <td><?php echo $row["state"] ?></td>
                    <td><?php echo $row["lga"] ?></td>
                    <td>
                        <a href="payment.php?studentID=<?php echo $row["id"] ?>" 
                        class="btn btn-sm btn-light">Donate Now</a>
                    </td>
                </tr>
            <?php
                $i++;
    }
}
?>