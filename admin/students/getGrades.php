<?php
$servername = "localhost";
$username = "icstitde_admin";
$password = "NS6^y&{*O,&6";
$dbname = "icstitde_sis_db";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $tblsem = isset($_GET['tblsem']) ? $_GET['tblsem'] : null;
    $tblsubrpt = isset($_GET['tblsubrpt']) ? $_GET['tblsubrpt'] : null;
    $stud_id = isset($_GET['studID']) ? $_GET['studID'] : null;
    $YearLevel = isset($_GET['YearLevel']) ? $_GET['YearLevel'] : null;
    $Section = isset($_GET['section']) ? $_GET['section'] : null;

    $sql = "SELECT DISTINCT t1.id, t2.Code,t2.Description,t2.Unit, t1.mtotal, t1.ftotal, t1.finalgrade, t1.equivalent, t1.reexam, t1.credit,  t1.remarks,  t2.Instructor,t2.AcadYr,t2.Sem
    FROM $tblsem  t1
    INNER JOIN $tblsubrpt t2 ON t1.id = t2.ID
    WHERE t1.studnum = :id and t2.YrLevel = :yrlevel and t2.Sec = :Section";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $stud_id, PDO::PARAM_STR);
    $stmt->bindParam(':yrlevel', $YearLevel, PDO::PARAM_STR);
    $stmt->bindParam(':Section', $Section, PDO::PARAM_STR);
   
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {

        echo "<div class='table-title'><span id='yearSecGrades'><b>".$YearLevel ."-". $Section ."</b></span>, <span id='AcadSem'>  " . $result[0]['Sem'] .  " AY:" . $result[0]['AcadYr'] ."</span></div>";
        echo "<table  class='table table-bordered table-striped' border='3'>";
        echo " <tr>
    
                <th width ='7%' >Code</th>
                <th width ='25%'>Subject Description</th>
                <th width ='10%'>1st Quarter</th>
                <th width ='10%'>2nd Quarter</th>
                <th width ='10%'>Sem Grade</th>
                <th width ='10%'>Remarks</th>
                <th width ='15%'>Instructor</th>
            <tr>";

        foreach ($result as $row) {
            echo "<tr>";
            
            echo "<td>" . $row['Code'] . "</td>";
            echo "<td>" . $row['Description'] . "</td>";
            echo "<td>" . $row['mtotal'] . "</td>";
            echo "<td>" . $row['ftotal'] . "</td>";
            echo "<td>" . $row['finalgrade'] . "</td>";
            echo "<td>" . $row['remarks'] . "</td>";
            echo "<td>" . $row['Instructor'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
      
        echo "<table  class='table table-bordered table-striped' border='3'>
             <tr>
                             <th width ='5%'>ID</th>
                              <th width ='7%' >Code</th>
                              <th width ='25%'>Subject Description</th>
                              <th width ='10%'>1st Quarter</th>
                              <th width ='10%'>2nd Quarter</th>
                              <th width ='10%'>Sem Grade</th>
                              <th width ='10%'>Remarks</th>
                              <th width ='15%'>Instructor</th>
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
?>
