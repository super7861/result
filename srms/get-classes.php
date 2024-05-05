<?php
include('includes/config.php');

// Check if the examType is provided in the GET request
if (isset($_GET['examType'])) {
    $examType = $_GET['examType'];

    // Use a switch statement to determine the appropriate table based on the examType
    switch ($examType) {
        case 'Internal Test-1':
            $tableName = 'tblclasses';
            break;
        case 'Internal Test-2':
            $tableName = 'tblclasses2';
            break;
        case 'Model Exam':
            $tableName = 'tblclasses3';
            break;
        case 'Board Exam':
            $tableName = 'tblclasses4';
            break;
        default:
            // Handle default case or validation if needed
            $tableName = '';
            break;
    }

    if ($tableName !== '') {
        // Fetch classes from the selected table
        $sql = "SELECT * FROM $tableName";
        $query = $dbh->prepare($sql);
        $query->execute();
        $classes = $query->fetchAll(PDO::FETCH_ASSOC);

        // Output classes as JSON
        header('Content-Type: application/json');
        echo json_encode($classes);
    } else {
        // Handle invalid examType
        echo json_encode([]);
    }
} else {
    // Handle missing examType parameter
    echo json_encode([]);
}
?>
