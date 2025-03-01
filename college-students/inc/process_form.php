<?php
// Replace these with your actual database connection details
include "../../config/conn.php";
try {
    // Set the PDO error mode to exception
    $conn_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve data from the AJAX request
    // ... (you may need to add this part)

    // Assuming $id is set before using it in the query
    $id = $_SESSION["id"];

    $getName = $conn_PDO->prepare("SELECT * FROM tblsi WHERE StudNum = :id");
    $getName->bindParam(':id', $id);
    $getName->execute();

    if ($getName->rowCount() > 0) {
        while ($fetch_name = $getName->fetch(PDO::FETCH_ASSOC)) {
            // Fetching data from tblsi
            $Lname = $fetch_name["Lname"];
            $Fname = $fetch_name["Fname"];
            $Mname = $fetch_name["Mname"];
            $status = "Pending";

            // Other data from the user session or AJAX request
            $inquiryType = $_POST['Itype'];
            $message = $_POST['Imessages'];
            date_default_timezone_set('Asia/Manila');
            $currentDate = date('Y-m-d H:i:s');
            // Generate a unique identifier (PN+5 numbers)
            $uniqueIdentifier = 'PN' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

            // SQL query to insert data with LName, FName, and MName
            $sql = "INSERT INTO inquiry2324 (PN, Id, LName, FName, MName, inquiryType, message, date, status) 
                    VALUES (:pn, :id, :Lname, :Fname, :Mname, :Itype, :Imessage, :currentDate, :status)";

            // Prepare the statement
            $stmt = $conn_PDO->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':pn', $uniqueIdentifier);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':Lname', $Lname);
            $stmt->bindParam(':Fname', $Fname);
            $stmt->bindParam(':Mname', $Mname);
            $stmt->bindParam(':Itype', $inquiryType);
            $stmt->bindParam(':Imessage', $message);
            $stmt->bindParam(':currentDate', $currentDate);
            $stmt->bindParam(':status', $status);

            // Execute the statement
            $stmt->execute();
			
				$response = [
				'success' => true,
				'message' => 'Your inquiry submitted successfully!'
					];
					echo json_encode($response);
				}
    }  else {
				$response = [
					'success' => false,
					'message' => 'No user data found in table.'
				];
				echo json_encode($response);
			}
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

