<?php
session_start();
include('includes/config.php');

// Function to get classes based on exam type
function getClasses($dbh, $examType)
{
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
        $sql = "SELECT * FROM $tableName";
        $query = $dbh->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return [];
    }
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission logic here
    // ...

    // Get exam type from form submission
    $examType = isset($_POST['examType']) ? $_POST['examType'] : '';

    // Get classes based on exam type
    $classes = getClasses($dbh, $examType);

    // Output classes as JSON for JavaScript use
    header('Content-Type: application/json');
    echo json_encode($classes);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Result Management System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
    <link rel="stylesheet" href="css/icheck/skins/flat/blue.css">
    <link rel="stylesheet" href="css/main.css" media="screen">
    <script src="js/modernizr/modernizr.min.js"></script>
</head>

<body class="">
    <div class="main-wrapper">
        <div class="login-bg-color bg-black-300">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel login-box">
                        <div class="panel-heading">
                            <div class="panel-title text-center">
                                <h4> Result-Student</h4>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                            <form id="resultForm" method="post">
                                <div class="form-group">
                                    <label for="rollid">Enter your Reg No</label>
                                    <input type="text" class="form-control" id="rollid" placeholder="Enter Your Roll Id" autocomplete="off" name="rollid">
                                </div>
                                <div class="form-group">
                                    <label for="examType">Select Exam Type</label>
                                    <select name="examType" class="form-control" id="examType" required="required" onchange="updateClassOptions()">
                                        <option value="">Select Exam Type</option>
                                        <option value="Internal Test-1">Internal Test-1</option>
                                        <option value="Internal Test-2">Internal Test-2</option>
                                        <option value="Model Exam">Model Exam</option>
                                        <option value="Board Exam">Board Exam</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="default" class="col-sm-2 control-label">Class</label>
                                    <select name="class" class="form-control" id="default" required="required" disabled>
                                        <option value="">Select Class</option>
                                        <!-- Class options will be dynamically added here using JavaScript -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob">
                                </div>
                                <div class="form-group mt-20">
                                    <div class="">
                                        <button type="submit" class="btn btn-success btn-labeled pull-right">Search<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <a href="index.php">Back to Home</a>
                                </div>
                            </form>
                            <hr>
                        </div>
                    </div>
                    <p class="text-muted text-center"><small>Student Result Management System</small></p>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== COMMON JS FILES ========== -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="js/jquery-ui/jquery-ui.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/pace/pace.min.js"></script>
    <script src="js/lobipanel/lobipanel.min.js"></script>
    <script src="js/iscroll/iscroll.js"></script>

    <!-- ========== PAGE JS FILES ========== -->
    <script src="js/icheck/icheck.min.js"></script>

    <!-- ========== THEME JS ========== -->
    <script src="js/main.js"></script>
    <script>
        function updateClassOptions() {
            var examType = document.getElementById("examType").value;
            var classDropdown = document.getElementById("default");
            var form = document.getElementById("resultForm");

            // Clear existing options
            classDropdown.innerHTML = '<option value="">Select Class</option>';
            classDropdown.disabled = (examType === "");

            if (examType !== "") {
                // Fetch classes based on the selected exam type and update the options
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var classes = JSON.parse(xhr.responseText);

                        classes.forEach(function (classInfo) {
                            var option = document.createElement("option");
                            option.value = classInfo.id;
                            option.text = classInfo.ClassNameNumeric + ' - ' + classInfo.ClassName;
                            classDropdown.add(option);
                        });
                    }
                };

                // Use the same file (find-result.php) to handle the AJAX request
                xhr.open("POST", "", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("examType=" + encodeURIComponent(examType));
            }

            // Dynamically update the form action based on the selected exam type
            switch (examType) {
                case "Internal Test-1":
                    form.action = "result.php";
                    break;
                case "Internal Test-2":
                    form.action = "result-2.php";
                    break;
                case "Model Exam":
                    form.action = "result-3.php";
                    break;
                case "Board Exam":
                    form.action = "result-4.php";
                    break;
                default:
                    // Handle default case or validation if needed
                    break;
            }
        }
    </script>
</body>

</html>
