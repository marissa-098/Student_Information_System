<?php
include "../../config/conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION["id"]; // Use the null coalescing operator to handle the case when $_SESSION["id"] is not set
    $fr_Lname = $_POST['fr_Lname'];
    $fr_Fname = $_POST['fr_Fname'];
    $fr_Mname = $_POST['fr_Mname'];
    $fr_gender = $_POST['fr_gender'];
    $fr_glevel = $_POST['fr_glevel'];
    $fr_bplace = $_POST['fr_bplace'];
    $fr_nationality = $_POST['fr_nationality'];
    $fr_religion = $_POST['fr_religion'];
    $fr_sitio = $_POST['fr_sitio'];
    $fr_brgy = $_POST['fr_brgy'];
    $fr_town = $_POST['fr_town'];
    $fr_province = $_POST['fr_province'];
    $fr_email = $_POST['fr_email'];
    $fr_cnumber = $_POST['fr_cnumber'];
    $fr_fatherName = $_POST['fr_fatherName'];
    $fr_motherName = $_POST['fr_motherName'];
    $uniqueIdentifier = 'PN' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    $currentDate = date('Y-m-d h:i:s A');
    $status = "Pending";
	$data = isset($_POST['data']) ? $_POST['data'] : [];

    try {
        // Prepare SQL statement with named parameters
        $stmt = $conn_PDO->prepare("INSERT INTO reqchange (PN, StudNum,Lname, Fname, Mname, Sex, GradeLevel, BPlace, Nationality, Religion, Sitio, Brgy, Town, Province, CNumber, EmailAdd, Father, Mother, date, status, data) 
            VALUES (:pn, :id, :fr_Lname, :fr_Fname, :fr_Mname, :fr_gender, :fr_glevel, :fr_bplace, :fr_nationality, :fr_religion, :fr_sitio, :fr_brgy, :fr_town, :fr_province, :fr_cnumber, :fr_email, :fr_fatherName, :fr_motherName, :currentDate, :status,:data)");

        // Bind parameters
        $stmt->bindParam(':pn', $uniqueIdentifier);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':fr_Lname', $fr_Lname);
        $stmt->bindParam(':fr_Fname', $fr_Fname);
        $stmt->bindParam(':fr_Mname', $fr_Mname);
        $stmt->bindParam(':fr_gender', $fr_gender);
        $stmt->bindParam(':fr_glevel', $fr_glevel);
        $stmt->bindParam(':fr_bplace', $fr_bplace);
        $stmt->bindParam(':fr_nationality', $fr_nationality);
        $stmt->bindParam(':fr_religion', $fr_religion);
        $stmt->bindParam(':fr_sitio', $fr_sitio);
        $stmt->bindParam(':fr_brgy', $fr_brgy);
        $stmt->bindParam(':fr_town', $fr_town);
        $stmt->bindParam(':fr_province', $fr_province);
        $stmt->bindParam(':fr_email', $fr_email);
        $stmt->bindParam(':fr_cnumber', $fr_cnumber);
        $stmt->bindParam(':fr_fatherName', $fr_fatherName);
        $stmt->bindParam(':fr_motherName', $fr_motherName);
        $stmt->bindParam(':currentDate', $currentDate);
        $stmt->bindParam(':status', $status);
		
		$serializedData = json_encode($data); // or use json_encode($data) if you prefer JSON
        $stmt->bindParam(':data', $serializedData);
        // Execute the prepared statement
        $stmt->execute();

            echo '<script>';
            echo 'alert("Your request submitted successfully!");';
            echo 'window.location.href = "../index.php?page=profile";';
            echo '</script>';

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
