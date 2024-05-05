// get-marks.php
<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (isset($_POST['studentId'])) {
    $studentId = $_POST['studentId'];

    // Query to fetch marks based on studentId
    $sql = "SELECT SubjectName, marks FROM tblresult WHERE StudentId = :studentId";
    $query = $dbh->prepare($sql);
    $query->bindParam(':studentId', $studentId, PDO::PARAM_INT);
    $query->execute();
    
    $marks = $query->fetchAll(PDO::FETCH_ASSOC);

    // Output marks as JSON
    echo json_encode($marks);
} else {
    echo 'Invalid request';
}
?>
