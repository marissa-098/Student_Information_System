<?php
$servername = "localhost";
$username = "icstitde_admin";
$password = "NS6^y&{*O,&6";
$dbname = "icstitde_sis_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $st_id = isset($_GET['studID']) ? $_GET['studID'] : null;
    $course = isset($_GET['course']) ? $_GET['course'] : null;
    $major = isset($_GET['major']) ? $_GET['major'] : null;
    $curriculum = isset($_GET['curriculum']) ? $_GET['curriculum'] : null;

    // Retrieve table names for tblsem%
                                                $stmtSem = $pdo->prepare("SELECT table_name
                                                                          FROM information_schema.tables
                                                                          WHERE table_schema = :dbname AND table_name LIKE 'tblsem%'
                                                                          ORDER BY CREATE_TIME DESC");
                                                $stmtSem->bindParam(':dbname', $dbname, PDO::PARAM_STR);
                                                $stmtSem->execute();
                                                $semTables = $stmtSem->fetchAll(PDO::FETCH_COLUMN);

                                                // Retrieve table names for tblsubrpt%
                                                $stmtSubrpt = $pdo->prepare("SELECT table_name
                                                                             FROM information_schema.tables
                                                                             WHERE table_schema = :dbname AND table_name LIKE 'tblsubrpt%'
                                                                             ORDER BY CREATE_TIME DESC");
                                                $stmtSubrpt->bindParam(':dbname', $dbname, PDO::PARAM_STR);
                                                $stmtSubrpt->execute();
                                                $subrptTables = $stmtSubrpt->fetchAll(PDO::FETCH_COLUMN);

                                                // Combine table names for both categories
                                                $allTables = array_merge($semTables, $subrptTables);

                                                // Build the dynamic UNION queries
                                                $unionSemQuery = "SELECT * FROM (";
                                                foreach ($semTables as $index => $tableName) {
                                                    $unionSemQuery .= "SELECT id, acadyr, equivalent, remarks FROM $tableName WHERE `studnum` = :st_id";
                                                    if ($index < count($semTables) - 1) {
                                                        $unionSemQuery .= " UNION ";
                                                    }
                                                }
                                                $unionSemQuery .= ") AS semCombinedTables";

                                                $unionSubrptQuery = "SELECT * FROM (";
                                                foreach ($subrptTables as $index => $tableName) {
                                                    $unionSubrptQuery .= "SELECT ID, Code FROM $tableName WHERE `studnum` = :st_id";
                                                    if ($index < count($subrptTables) - 1) {
                                                        $unionSubrptQuery .= " UNION ";
                                                    }
                                                }
                                                $unionSubrptQuery .= ") AS subrptCombinedTables";

                                                // Build the dynamic JOIN query
                                                $joinQuery = "SELECT * FROM ($unionSemQuery) AS semResult
                                                              JOIN ($unionSubrptQuery) AS subrptResult ON semResult.id = subrptResult.ID
                                                              RIGHT JOIN tblsubject ON tblsubject.Code = subrptResult.Code
                                                              WHERE tblsubject.Course = :course AND tblsubject.Major = :major AND tblsubject.Curriculum = :curriculum
                                                                ORDER BY
                                                                    CASE tblsubject.LevelKo
                                                                        WHEN 'First Year' THEN 1
                                                                        WHEN 'Second Year' THEN 2
                                                                        WHEN 'Third Year' THEN 3
                                                                        WHEN 'Fourth Year' THEN 4
                                                                        ELSE 5 -- or any other default value or order
                                                                    END,
                                                                    tblsubject.Sem";

    // Execute the query
    $stmt = $pdo->prepare($joinQuery);
    $stmt->bindParam(':st_id', $st_id, PDO::PARAM_STR);
    $stmt->bindParam(':course', $course, PDO::PARAM_STR);
    $stmt->bindParam(':major', $major, PDO::PARAM_STR);
    $stmt->bindParam(':curriculum', $curriculum, PDO::PARAM_STR);
    $stmt->execute();



     echo "<div class='table-title'><b>PROSPECTUS</b></div>";
        echo "<div class='table-responsive'>";
        echo "<table  class='table table-bordered table-striped' border='3'>";
        echo " <tr>
                             <th >CODE</th>
                             <th>DESCRIPTION</th>
                             <th>UNIT</th>
                             <th>YEAR LEVEL</th>
                             <th>SEMESTER</th>
                             <th>EQUIVALENT</th>
                             <th >REMARKS</th>
                            <tr>";

    // Fetch and display the results in an HTML table
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        echo "<tr>";
        echo "<td>{$row['Code']}</td>";
        echo "<td>{$row['Description']}</td>";
        echo "<td>{$row['Unit']}</td>";
        echo "<td>{$row['LevelKo']}</td>";
        echo "<td>{$row['Sem']}</td>";
        echo "<td>{$row['equivalent']}  {$row['acadyr']}</td>";
        echo "<td>{$row['remarks']}</td>";
        echo "</tr>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$pdo = null;
?>
