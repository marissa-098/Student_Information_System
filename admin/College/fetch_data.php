<?php
// Your existing code to establish a database connection and other necessary configurations
include '../../config/conn.php';

if (isset($_GET['selectedOption'])) {
    $selectedOption = $_GET['selectedOption'];
    
    // Split the selected option to get the necessary values
    $values = explode(',', $selectedOption);
    $tblsem = $values[0];
    $tblsubrpt = $values[1];
    $studentId = $values[2];
    $yrLevel = $values[3];
    $sec = $values[4];

    try {
        // Create a PDO connection
        // Assuming you have a database connection named $conn_PDO and placeholders for :dbname

        $conn_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query to fetch data based on the selected option
		$dataSql = "SELECT DISTINCT t1.YrLevel, t1.Sec, t1.AcadYr, t1.Sem, t1.ID, t1.Code, t1.Description, t1.Instructor, t1.Lec, t1.Lab, t1.Unit, t1.Days, t1.TimeKo, t1.Room
					FROM $tblsubrpt t1
					INNER JOIN $tblsem t2 ON t1.ID = t2.id
					WHERE t1.studnum = :id AND t1.YrLevel = :yrLevel AND t1.Sec = :section";
		$dataStmt = $conn_PDO->prepare($dataSql);
		$dataStmt->bindParam(':id', $studentId, PDO::PARAM_STR);
		$dataStmt->bindParam(':yrLevel', $yrLevel, PDO::PARAM_STR);
		$dataStmt->bindParam(':section', $sec, PDO::PARAM_STR);
		$dataStmt->execute();
		$data = $dataStmt->fetchAll(PDO::FETCH_ASSOC);

        // Process the fetched data as needed
        // ...
		
        // Display the result in the specified HTML section
        echo '<div class="col-md-12">
                <div class="table-wrapper">
						<div class="form-group row">
									<label class="col-sm-9 col-form-label"><span id="yearSec"><b> '.$yrLevel ."-". $sec . '</b></span>,  <span id="AcadSem">' . $data[0]['Sem'] .  "<br> " . $data[0]['AcadYr'] .'</span></label>
									<div class="col-sm-3">
									</div>
								</div>
                    <div id="displaysched">
                        <div id="scheduleTbl" class="table-responsive">
                            <div class="table-title"></div>
                            <table class="table table-bordered table-striped">
                                <tr>
									<th >Code</th>
									<th>Description</th>
									<th >Instructor</th>
									<th>Lec</th>
									<th>Lab</th>
									<th>Unit</th>
									<th >Days</th>
									<th >Time</th>
									<th >Room</th>
                                </tr>';

        if (count($data) > 0) {
            foreach ($data as $row) {
                echo '<tr>';
				echo "<td>" . $row['Code'] . "</td>";
				echo "<td>" . $row['Description'] . "</td>";
				echo "<td>" . $row['Instructor'] . "</td>";
				echo "<td>" . $row['Lec'] . "</td>";
				echo "<td>" . $row['Lab'] . "</td>";
				echo "<td>" . $row['Unit'] . "</td>";
				echo "<td>" . $row['Days'] . "</td>";
				echo "<td>" . $row['TimeKo'] . "</td>";
				echo "<td>" . $row['Room'] . "</td>";
                echo '</tr>';
            }
        } else {
            echo '<tr>
                    <td colspan="10">No Records Found!</td>
                </tr>';
        }

        echo '</table></div></div></div></div>';

        // Close the database connection
        $conn_PDO = null;
    } catch (PDOException $e) {
        // Handle any errors
        echo 'Error: ' . $e->getMessage();
    }
}
?>