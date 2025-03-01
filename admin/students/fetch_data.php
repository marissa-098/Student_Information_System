<?php
// Your existing code to establish a database connection and other necessary configurations
include '../../config/conn.php';

if (isset($_GET['selectedOption'])) {
    $selectedOption = $_GET['selectedOption'];

    // Split the selected option to get the necessary values
    $values = explode(',', $selectedOption);

    if (count($values) >= 5) {
        $tblsem = $values[0];
        $tblsubrpt = $values[1];
        $studentId = $values[2];
        $yrLevel = $values[3];
        $sec = $values[4];

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT DISTINCT t1.YrLevel, t1.Sec, t1.AcadYr, t1.Sem, t1.ID, t1.Code, t1.Description, t1.Instructor, t1.Lec, t1.Lab, t1.Unit, t1.Days, t1.TimeKo, t1.Room
                    FROM $tblsubrpt t1
                    INNER JOIN $tblsem t2 ON t1.ID = t2.id
                    WHERE t1.studnum = :id AND t1.YrLevel = :yrlevel AND t1.Sec = :Section";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $studentId, PDO::PARAM_STR);
            $stmt->bindParam(':yrlevel', $yrLevel, PDO::PARAM_STR);
            $stmt->bindParam(':Section', $sec, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) > 0) {
				echo "<div  class='table-responsive'>";
                echo "<div class='table-title'><span id='yearSec'><b>".$yrLevel ."-". $sec ."</b></span>, <span id='AcadSem'> " . $result[0]['Sem'] .  " AY:" . $result[0]['AcadYr'] ."</span></div>";
				echo "<div id='scheduleTbl'>";
                echo "<table  class='table table-bordered table-striped' border='3'>";
                echo "<tr>
                        
                        <th width ='7%' >Code</th>
                        <th width ='25%'>Description</th>
                        <th width ='12%'>Instructor</th>
                        <th width ='3%'>Lec</th>
                        <th width ='3%'>Lab</th>
                        <th width ='3%'>Units</th>
                        <th width ='5%'>Days</th>
                        <th width ='15%'>Time</th>
                        <th width ='5%'>Room</th>
                      </tr>";

                foreach ($result as $row) {
                    echo "<tr>";
                   
                    echo "<td>" . $row['Code'] . "</td>";
                    echo "<td>" . $row['Description'] . "</td>";
                    echo "<td>" . $row['Instructor'] . "</td>";
                    echo "<td>" . $row['Lec'] . "</td>";
                    echo "<td>" . $row['Lab'] . "</td>";
                    echo "<td>" . $row['Unit'] . "</td>";
                    echo "<td>" . $row['Days'] . "</td>";
                    echo "<td>" . $row['TimeKo'] . "</td>";
                    echo "<td>" . $row['Room'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
				echo "</div>";
            } else {
                echo "<table  class='table table-bordered table-striped' border='3'>
                     <tr>
                        
                        <th width ='7%' >Code</th>
                        <th width ='25%'>Description</th>
                        <th width ='12%'>Instructor</th>
                        <th width ='3%'>Lec</th>
                        <th width ='3%'>Lab</th>
                        <th width ='3%'>Unit</th>
                        <th width ='5%'>Days</th>
                        <th width ='15%'>Time</th>
                        <th width ='5%'>Room</th>
                      </tr>
                      <tr>
                        <td colspan='10' align='left' >No Records Found!</td>
                      </tr>
                     </table>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null;
        }
	}
}