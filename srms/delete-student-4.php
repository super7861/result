<?php
include('includes/config.php');

if (isset($_GET['stid']) && !empty($_GET['stid'])) {
    $studentId = $_GET['stid'];

    // Perform the delete operation
    $sql = "DELETE FROM tblstudents4 WHERE StudentId = :studentId";
    $query = $dbh->prepare($sql);
    $query->bindParam(':studentId', $studentId, PDO::PARAM_INT);
    $query->execute();

    // Check if the delete operation was successful
    if ($query) {
        $msg = "Student record deleted successfully";
    } else {
        $error = "Error deleting student record";
    }
} else {
    $error = "Invalid request";
}

// Redirect back to the page with a success or error message
header("location: manage-students-4.php?msg=$msg&error=$error");
?>
