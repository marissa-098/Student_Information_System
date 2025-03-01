<?php
// getMajors.php

// Assuming you have a database connection established in your main file
include "../../config/conn.php";
// Check if the course parameter is set in the GET request
if (isset($_GET['course'])) {
    $selectedCourse = $_GET['course'];

    // Use your database connection and query to get majors for the selected course
    $select_majors = $conn_PDO->prepare("SELECT DISTINCT Major FROM tblsubject WHERE Course = :course");
    $select_majors->bindParam(':course', $selectedCourse, PDO::PARAM_STR);
    $select_majors->execute();

    $majors = array();

    // Fetch majors and add them to the array
    while ($fetch_major = $select_majors->fetch(PDO::FETCH_ASSOC)) {
        $majors[] = $fetch_major['Major'];
    }

    // Return the majors as a JSON-encoded array
    echo json_encode($majors);
} else {
    // If the course parameter is not set, return an empty array
    echo json_encode([]);
}
?>
