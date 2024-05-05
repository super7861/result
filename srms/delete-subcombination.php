<?php
session_start();
include('includes/config.php');

if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);

        // Perform the delete operation in the database
        $sql = "DELETE FROM tblsubjectcombination WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        // Check if the delete operation was successful
        if ($query->rowCount() > 0) {
            $msg = "Record deleted successfully";
        } else {
            $error = "Error deleting record";
        }
    } else {
        $error = "Invalid request";
    }
}

header("Location: manage-subjectcombination.php?msg=$msg&error=$error");
?>
