<?php
session_start();
error_reporting(0);
include('includes/config.php');
require 'vendor/autoload.php';

// Initialize variables
$error = '';
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['excel_file']) && isset($_POST['upload_option'])) {
    $fileTmpPath = $_FILES['excel_file']['tmp_name'];
    $fileName = $_FILES['excel_file']['name'];
    $fileSize = $_FILES['excel_file']['size'];
    $fileType = $_FILES['excel_file']['type'];
    $uploadOption = $_POST['upload_option'];

    // Validate the file
    $allowedExtensions = ['xlsx', 'xls'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions)) {
        $error = "Invalid file type. Please upload a valid Excel file.";
    } elseif ($fileSize > 5000000) {
        $error = "File size exceeds 5MB. Please upload a smaller file.";
    } else {
        try {
            // Database Connection
            $dbh = new PDO("mysql:host=localhost;dbname=srms", "root", "");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Load the Excel file
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileTmpPath);

            // Get the first worksheet
            $worksheet = $spreadsheet->getActiveSheet();

            // Create an array to store SubjectId for each SubjectName
            $subjectIdMap = [];

            // Create an array to store ClassId for each ClassNameNumeric + ClassName combination
            $classIdMap = [];

            // Determine the tables based on the selected option
            switch ($uploadOption) {
                case 'internal_test_1':
                    $resultTable = 'tblresult';
                    $studentsTable = 'tblstudents';
                    $classesTable = 'tblclasses';
                    $subjectsTable = 'tblsubjects';
                    break;
                case 'internal_test_2':
                    $resultTable = 'tblresult2';
                    $studentsTable = 'tblstudents2';
                    $classesTable = 'tblclasses2';
                    $subjectsTable = 'tblsubjects2';
                    break;
                case 'model_exam':
                    $resultTable = 'tblresult3';
                    $studentsTable = 'tblstudents3';
                    $classesTable = 'tblclasses3';
                    $subjectsTable = 'tblsubjects3';
                    break;
                case 'board_exam':
                    $resultTable = 'tblresult4';
                    $studentsTable = 'tblstudents4';
                    $classesTable = 'tblclasses4';
                    $subjectsTable = 'tblsubjects4';
                    break;
                default:
                    $resultTable = ''; // Handle this case accordingly
                    $studentsTable = '';
                    $classesTable = '';
                    $subjectsTable = '';
                    break;
            }

            if ($resultTable && $studentsTable && $classesTable && $subjectsTable) {
                // Loop through rows
                foreach ($worksheet->getRowIterator() as $row) {
                    $rowData = [];
                    foreach ($row->getCellIterator() as $cell) {
                        $rowData[] = $cell->getValue();
                    }

                    // Assuming your Excel sheet has columns in the following order:
                    // 0: Student Name, 1: Roll Id, 2: ClassNameNumeric, 3: ClassName,
                    // 4: Subject1, 5: Marks1, 6: Subject2, 7: Marks2, 8: Subject3, 9: Marks3, 10: Subject4, 11: Marks4
                    $studentName = $rowData[0];
                    $rollId = $rowData[1];
                    $classNumeric = $rowData[2];
                    $className = $rowData[3];

                    // Check if ClassId is already stored for this ClassNameNumeric + ClassName combination
                    $classKey = $classNumeric . '-' . $className;
                    if (!isset($classIdMap[$classKey])) {
                        // Class data not found, insert it
                        $sqlInsertClass = "INSERT INTO $classesTable (ClassNameNumeric, ClassName)
                                           VALUES (:classNumeric, :className)";
                        $queryInsertClass = $dbh->prepare($sqlInsertClass);
                        $queryInsertClass->bindParam(':classNumeric', $classNumeric, PDO::PARAM_STR);
                        $queryInsertClass->bindParam(':className', $className, PDO::PARAM_STR);
                        $queryInsertClass->execute();

                        // Get the ClassId
                        $classId = $dbh->lastInsertId();

                        // Store ClassId in the map
                        $classIdMap[$classKey] = $classId;
                    } else {
                        // Retrieve ClassId from the map
                        $classId = $classIdMap[$classKey];
                    }

                    // Check if the student with the same RollId and ClassId already exists
                    $sqlCheckStudent = "SELECT StudentId FROM $studentsTable WHERE RollId = :rollId AND ClassId = :classId";
                    $queryCheckStudent = $dbh->prepare($sqlCheckStudent);
                    $queryCheckStudent->bindParam(':rollId', $rollId, PDO::PARAM_STR);
                    $queryCheckStudent->bindParam(':classId', $classId, PDO::PARAM_INT);
                    $queryCheckStudent->execute();
                    $existingStudent = $queryCheckStudent->fetch(PDO::FETCH_ASSOC);

                    if ($existingStudent) {
                        // Update existing student
                        $studentId = $existingStudent['StudentId'];
                        $sqlStudents = "UPDATE $studentsTable SET StudentName = :studentName WHERE StudentId = :studentId";
                        $queryStudents = $dbh->prepare($sqlStudents);
                        $queryStudents->bindParam(':studentName', $studentName, PDO::PARAM_STR);
                        $queryStudents->bindParam(':studentId', $studentId, PDO::PARAM_INT);
                        $queryStudents->execute();
                    } else {
                        // Insert new student
                        $sqlStudents = "INSERT INTO $studentsTable (StudentName, RollId, ClassId, Status)
                                        VALUES (:studentName, :rollId, :classId, 1)";
                        $queryStudents = $dbh->prepare($sqlStudents);
                        $queryStudents->bindParam(':studentName', $studentName, PDO::PARAM_STR);
                        $queryStudents->bindParam(':rollId', $rollId, PDO::PARAM_STR);
                        $queryStudents->bindParam(':classId', $classId, PDO::PARAM_INT);
                        $queryStudents->execute();
                    }

                    // Get or update student ID
                    $studentId = $dbh->lastInsertId();

                    // Loop through subjects and marks
                    for ($i = 4; $i <= 11; $i += 2) {
                        $subject = $rowData[$i];
                        $marks = $rowData[$i + 1];

                        if (!empty($subject) && !empty($marks)) {
                            // Check if SubjectId is already stored for this SubjectName
                            if (!isset($subjectIdMap[$subject])) {
                                // Subject data not found, insert it
                                $sqlInsertSubject = "INSERT INTO $subjectsTable (SubjectName)
                                                    VALUES (:subject)";
                                $queryInsertSubject = $dbh->prepare($sqlInsertSubject);
                                $queryInsertSubject->bindParam(':subject', $subject, PDO::PARAM_STR);
                                $queryInsertSubject->execute();

                                // Get the SubjectId
                                $subjectId = $dbh->lastInsertId();

                                // Store SubjectId in the map
                                $subjectIdMap[$subject] = $subjectId;
                            } else {
                                // Retrieve SubjectId from the map
                                $subjectId = $subjectIdMap[$subject];
                            }

                            // Insert or update result table
                            $sqlMarks = "INSERT INTO $resultTable (StudentId, ClassId, SubjectId, Marks)
                                         VALUES (:studentId, :classId, :subjectId, :marks)
                                         ON DUPLICATE KEY UPDATE Marks = :marks";
                            $queryMarks = $dbh->prepare($sqlMarks);
                            $queryMarks->bindParam(':studentId', $studentId, PDO::PARAM_INT);
                            $queryMarks->bindParam(':classId', $classId, PDO::PARAM_INT);
                            $queryMarks->bindParam(':subjectId', $subjectId, PDO::PARAM_INT);
                            $queryMarks->bindParam(':marks', $marks, PDO::PARAM_INT);
                            $queryMarks->execute();
                        }
                    }
                }

                $msg = "Data imported successfully!";
            } else {
                $error = "Invalid upload option selected.";
            }

        } catch (\Exception $e) {
            $error = "Error processing the Excel file: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* Add some basic styles for visibility */
        #excel_file {
            display: block;
            margin-bottom: 10px;
        }

        #import_button {
            display: block;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #progress_bar {
            display: none;
            margin-top: 10px;
            width: 100%;
            background-color: #f1f1f1;
        }

        #progress {
            height: 30px;
            line-height: 30px;
            text-align: center;
            width: 0;
            background-color: #4caf50;
            color: white;
        }
    </style>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <!-- Your HTML content here -->

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if (!empty($msg)): ?>
        <div class="alert alert-success"><?php echo $msg; ?></div>
    <?php endif; ?>

    <form action="upload.php" method="post" enctype="multipart/form-data" id="upload_form">
        <label for="excel_file">Choose an Excel file to upload:</label>
        <input type="file" name="excel_file" id="excel_file" accept=".xlsx, .xls" required>
        <label for="upload_option">Choose an upload option:</label>
        <select name="upload_option" id="upload_option" required>
            <option value="internal_test_1">Internal Test 1</option>
            <option value="internal_test_2">Internal Test 2</option>
            <option value="model_exam">Model Exam</option>
            <option value="board_exam">Board Exam</option>
        </select>
        <button type="button" id="import_button" onclick="uploadFile()">Import</button>
    </form>

    <!-- Loading Bar -->
    <div id="progress_bar">
        <div id="progress">0%</div>
    </div>

    <!-- Your remaining HTML content here -->

    <!-- Your script includes here -->
    <script>
        function uploadFile() {
            var formData = new FormData($('#upload_form')[0]);

            $.ajax({
                url: 'upload.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                xhr: function () {
                    var xhr = new XMLHttpRequest();

                    // Upload progress
                    xhr.upload.addEventListener('progress', function (event) {
                        if (event.lengthComputable) {
                            var percent = Math.round((event.loaded / event.total) * 100);
                            $('#progress').html(percent + '%');
                            $('#progress').css('width', percent + '%');
                        }
                    }, false);

                    return xhr;
                },
                success: function (data) {
                    // Handle success, update UI
                    alert("Successfully Imported Spreadsheet");
                    location.reload(); // Reload the page on success (you can replace this with your logic)
                },
                error: function (error) {
                    // Handle error, update UI
                    alert("Error");
                }
            });
        }
    </script>
</body>
</html>
