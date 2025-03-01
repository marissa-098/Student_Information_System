<?php
// Include your database connection file
include "../config/conn.php";

try {
    // Get user ID or any other identifier
    $userId = $_SESSION["id"];

    // Get current password from the database
    $sql = "
    SELECT * FROM tblgradeschool
    WHERE StudNum = :userId
    ";
    $stmt = $conn_PDO->prepare($sql);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // // Check if the entered current password matches the one in the database
    // $rawPassword = strtoupper($_POST["currentPassword"]);
    // $hashPassword = strtoupper($result["user_pass"]); // Assuming the hashed password column is named "user_pass"

 
    $password = $_POST["currentPassword"];
    // $raw_password = $_POST["fr_studPass"];
    $HASHpassword = $result["user_pass"];
   

    if (password_verify($password, $HASHpassword) || ($password == $HASHpassword)){

        // Update the password in both tblsi and tblsiadd tables
        $password = $_POST['newPassword']; 
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


        $updateSql = "
        UPDATE tblgradeschool
        SET user_pass = :newPassword
        WHERE StudNum = :userId
        ";
        
        $updateStmt = $conn_PDO->prepare($updateSql);
        $updateStmt->bindParam(':newPassword', $hashedPassword);
        $updateStmt->bindParam(':userId', $userId);
        $updateStmt->execute();

        echo "Password updated successfully.";
    } else {
        echo "Current password is incorrect.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
