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

    $sql = "SELECT DISTINCT t1.YrLevel, t1.Sec, t1.AcadYr, t1.Sem, t1.ID, t1.Code, t1.Description, t1.Instructor, t1.Lec, t1.Lab, t1.Unit, t1.Days, t1.TimeKo, t1.Room
            FROM $tblsubrpt t1
            INNER JOIN $tblsem t2 ON t1.ID = t2.id
            WHERE t1.studnum = :id and t1.YrLevel = :yrlevel and t1.Sec = :Section";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $stud_id, PDO::PARAM_STR);
     $stmt->bindParam(':yrlevel', $YearLevel, PDO::PARAM_STR);
      $stmt->bindParam(':Section', $Section, PDO::PARAM_STR);
   
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {

         echo "<div class='table-title'><span id='yearSec'><b>".$YearLevel ."-". $Section ."</span></b>, <span id='AcadSem'>" . $result[0]['Sem'] .  " AY:" . $result[0]['AcadYr'] ."<span></div>";
         echo "<div id='schedTbl' class='table-responsive'>";
        echo "<table  class='table table-bordered table-striped' border='3'>";
        echo "<tr>
                <th >Code</th>
                <th>Description</th>
                <th >Instructor</th>
                <th>Lec</th>
                <th>Lab</th>
                <th>Unit</th>
                <th >Days</th>
                <th >Time</th>
                <th >Room</th>
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
    } else {
      
        echo "<table  class='table table-bordered table-striped' border='3'>
             <tr>
                <th width ='5%'>ID</th>
                <th width ='7%' >Code</th>
                <th width ='25%'>Description</th>
                <th width ='12%'>Instructor</th>
                <th width ='3%'>Lec</th>
                <th width ='3%'>Lab</th>
                <th width ='3%'>Unit</th>
                <th width ='5%'>Days</th>
                <th width ='15%'>Time</th>
                <th width ='5%'>Room</th>
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
