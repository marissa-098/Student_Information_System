<?php

include("../../config/conn.php");
$id=$_SESSION["id"];


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
                $stmtUpdate = $conn_PDO->prepare("UPDATE inquiry2324 SET `studNotif` = 0 WHERE PN = :pn");
            } else {
                // Update notifications for reqchange
                $stmtUpdate = $conn_PDO->prepare("UPDATE reqchange SET `studNotif` = 0 WHERE PN = :pn");
            }

            $stmtUpdate->bindParam(':pn', $pn, PDO::PARAM_STR);
            $stmtUpdate->execute();
        }
    }
}



$stmt = $conn_PDO->prepare("  
    SELECT *
    FROM (
        SELECT 'inquiry2324' AS source,Id, PN, responseDate FROM inquiry2324 WHERE `studNotif` = 1
        UNION
        SELECT 'reqchange' AS source,StudNum, PN, responseDate FROM reqchange WHERE `studNotif` = 1
    ) AS combined_results
    WHERE Id = '$id'
    ORDER BY responseDate DESC
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