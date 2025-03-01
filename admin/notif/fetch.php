<?php

	include '../../config/conn.php';
if (isset($_POST['view'])) {

    if ($_POST["view"] != '') {
    $pn = $_POST["view"];

    $sql = "SELECT 'inquiry2324' AS notifList
            FROM inquiry2324
            WHERE inquiry2324.PN = :pn
            UNION ALL
            SELECT 'reqchange' AS notifList
            FROM reqchange
            WHERE reqchange.PN = :pn";

    $stmt = $conn_PDO->prepare($sql);
    $stmt->execute(array(':pn' => $pn)); // Use ':pn' for binding the parameter
    $count0 = $stmt->rowCount();

    if ($count0 > 0) {
        $res = $stmt->fetchAll();

        foreach ($res as $newRes) {
            if ($newRes["notifList"] == "inquiry2324") {
                // Update notifications for inquiry2324
                $stmtUpdate = $conn_PDO->prepare("UPDATE inquiry2324 SET `notif` = 0 WHERE PN = :pn");
            } else {
                // Update notifications for reqchange
                $stmtUpdate = $conn_PDO->prepare("UPDATE reqchange SET `notif` = 0 WHERE PN = :pn");
            }

            $stmtUpdate->bindParam(':pn', $pn, PDO::PARAM_STR);
            $stmtUpdate->execute();
        }
    }
}



$stmt = $conn_PDO->prepare("  
    SELECT *
    FROM (
        SELECT 'inquiry2324' AS source, PN, Id,LName,FName,MName, date FROM inquiry2324 WHERE `notif` = 1
        UNION
        SELECT 'reqchange' AS source, PN, StudNum,Lname,Fname,Mname, date FROM reqchange WHERE `notif` = 1
    ) AS combined_results
    ORDER BY date DESC
    LIMIT 5");

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = count($result);
$data = array(
    'notification' => $result,
    'unseen_notification' => $count
);

// Output only JSON content
header('Content-Type: application/json');
echo json_encode($data);
}

?>