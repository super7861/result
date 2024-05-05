<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_GET['classid'])) {
        $classId = $_GET['classid'];

        // Perform the delete operation here
        $sql = "DELETE FROM tblclasses2 WHERE id = :classId";
        $query = $dbh->prepare($sql);
        $query->bindParam(':classId', $classId, PDO::PARAM_INT);

        if ($query->execute()) {
            $msg = "Class deleted successfully";
        } else {
            $error = "Error deleting class";
        }
    } else {
        $error = "Invalid class ID";
    }
    header("Location: manage-classes-2.php?msg=$msg&error=$error");
}
?>
