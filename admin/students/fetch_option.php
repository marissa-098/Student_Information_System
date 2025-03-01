<?php
// Your existing code to establish a database connection and other necessary configurations
include '../../config/conn.php';
try {
    // Create a PDO connection
    // Assuming you have a database connection named $conn_PDO and placeholders for :dbname

    $conn_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to get table names and creation dates for 'tblsem%'
    $sql = "SELECT table_name
            FROM information_schema.tables
            WHERE table_schema = :dbname AND table_name LIKE 'tblsem%'
            ";

    $sql1 = "SELECT table_name 
             FROM information_schema.tables
             WHERE table_schema = :dbname AND table_name LIKE 'tblsubrpt%'
             ";

    // Prepare and execute the first query
    $stmt = $conn_PDO->prepare($sql);
    $stmt->bindParam(':dbname', $dbname, PDO::PARAM_STR);
    $stmt->execute();
    $results1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Prepare and execute the second query
    $stmt = $conn_PDO->prepare($sql1);
    $stmt->bindParam(':dbname', $dbname, PDO::PARAM_STR);
    $stmt->execute();
    $results2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $maxRowCount = max(count($results1), count($results2));

    $options = ''; // Variable to store the HTML options
    $optionCount = 0; // Flag variable

    for ($i = 0; $i < $maxRowCount; $i++) {
        // Column 1 (tblsem)
        if (isset($results1[$i]['TABLE_NAME']) || isset($results2[$i]['TABLE_NAME'])) {
            $tblsem = $results1[$i]['TABLE_NAME'];
            $tblsubrpt = $results2[$i]['TABLE_NAME'];

            $checkColumnsSql = "SELECT table_name
                                FROM information_schema.columns
                                WHERE table_schema = :dbname
                                AND table_name = :tableName
                                AND column_name IN ('AcadYr', 'Sem')";

            $checkColumnsStmt = $conn_PDO->prepare($checkColumnsSql);
            $checkColumnsStmt->bindParam(':dbname', $dbname, PDO::PARAM_STR);
            $checkColumnsStmt->bindParam(':tableName', $tblsubrpt, PDO::PARAM_STR);
            $checkColumnsStmt->execute();
            $hasColumnsResult = $checkColumnsStmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($hasColumnsResult)) {
                // Table has 'Acadyr' and 'Sem' columns
                // Retrieve distinct values
                $studentId = $_GET['stid'];
                $distinctValuesSql = "SELECT DISTINCT AcadYr, Sem, YrLevel, Sec
                                      FROM $tblsubrpt 
                                      WHERE StudNum = :id";  // Use the actual table name

                $distinctValuesStmt = $conn_PDO->prepare($distinctValuesSql);
                $distinctValuesStmt->bindParam(':id', $studentId, PDO::PARAM_STR);
                $distinctValuesStmt->execute();
                $distinctValues = $distinctValuesStmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($distinctValues as $row) {
                    $options .= '<option value="'.$tblsem.','.$tblsubrpt.','.$_GET['stid'].','.$row['YrLevel'] .','. $row['Sec'].'">' . $row['Sem'] ." AY: ". $row['AcadYr'] . '</option>';
                }

                $optionCount += count($distinctValues); // Increment the count
            }
        }
    }

    // Add the 'selected' attribute if there is only one option
    if ($optionCount === 1) {
        $options = str_replace('<option', '<option selected', $options);
    }

    // Return the HTML options
    echo $options;
} catch (PDOException $e) {
    // Handle any errors
    echo "Error: " . $e->getMessage();
} finally {
    // Close the database connection
    $conn_PDO = null;
}
?>