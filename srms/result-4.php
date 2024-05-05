<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Result Management System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
    <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
    <link rel="stylesheet" href="css/prism/prism.css" media="screen">
    <link rel="stylesheet" href="css/main.css" media="screen">
    <script src="js/modernizr/modernizr.min.js"></script>

    <!-- Add the style block here -->
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2; /* Background color for header cells */
        }

        td:first-child,
        th:first-child {
            background-color: #4CAF50; /* Background color for the first column */
            color: white; /* Text color for the first column */
        }
    </style>
</head>
<body>
<div class="main-wrapper">
    <div class="content-wrapper">
        <div class="content-container">
            <!-- /.left-sidebar -->
            <div class="main-page">
                <div class="container-fluid">
                    <div class="row page-title-div">
                        <div class="col-md-12">
                            <h2 class="title" align="center">Result Management System</h2>
                        </div>
                    </div>
                </div>

                <section class="section" id="exampl">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h3 align="center">Board Exam</h3>
                                            <hr />
                                            <?php
                                            // code Student Data
                                            $rollid = $_POST['rollid'];
                                            $classid = $_POST['class'];
                                            $dob = $_POST['dob']; // Add this line for DOB

                                            $_SESSION['rollid'] = $rollid;
                                            $_SESSION['classid'] = $classid;
                                            $_SESSION['dob'] = $dob; // Add this line for DOB

                                            // Update the first query
                                            $query = "SELECT tblstudents4.StudentName, tblstudents4.RollId, tblstudents4.RegDate, tblstudents4.StudentId, tblstudents4.Status, tblstudents4.DOB, tblclasses4.ClassNameNumeric, tblclasses4.ClassName
                                         FROM tblstudents4
                                         JOIN tblclasses4 ON tblclasses4.id=tblstudents4.ClassId
                                         WHERE tblstudents4.RollId=:rollid AND tblstudents4.ClassId=:classid OR tblstudents4.DOB=:dob"; // Add condition for DOB
                                            $stmt = $dbh->prepare($query);
                                            $stmt->bindParam(':rollid', $rollid, PDO::PARAM_STR);
                                            $stmt->bindParam(':classid', $classid, PDO::PARAM_STR);
                                            $stmt->bindParam(':dob', $dob, PDO::PARAM_STR); // Add this line for DOB

                                            $stmt->execute();
                                            $resultss = $stmt->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($stmt->rowCount() > 0) {
                                                foreach ($resultss as $row) {
                                                    ?>
                                                    <p><b>Student Name :</b> <?php echo htmlentities($row->StudentName); ?></p>
                                                    <p><b>Student Roll Id :</b> <?php echo htmlentities($row->RollId); ?></p>
                                                    <p><b>Student Class:</b> <?php echo htmlentities($row->ClassNameNumeric); ?>(<?php echo htmlentities($row->ClassName); ?>)</p>
                                                    <p><b>Date of Birth:</b> <?php echo htmlentities($row->DOB); ?></p> <!-- Add this line for DOB -->
                                                    <?php
                                                }
                                                ?>
                                    </div>
                                    <div class="panel-body p-20">
                                        <table class="table table-hover table-bordered" border="1" width="100%">
                                            <thead>
                                            <tr style="text-align: center">
                                                <th style="text-align: center">#</th>
                                                <th style="text-align: center"> Subject</th>
                                                <th style="text-align: center">Marks</th>
                                                <th style="text-align: center">Result</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            // Code for result
                                            $query = "SELECT t.StudentName,t.RollId,t.ClassId,t.marks,SubjectId,tblsubjects4.SubjectName
                                                    FROM (SELECT sts.StudentName,sts.RollId,sts.ClassId,tr.marks,SubjectId
                                                          FROM tblstudents4 AS sts
                                                          JOIN tblresult4 tr ON tr.StudentId=sts.StudentId) AS t
                                                          JOIN tblsubjects4 ON tblsubjects4.id=t.SubjectId
                                                    WHERE (t.RollId=:rollid AND t.ClassId=:classid)";
                                            $query = $dbh->prepare($query);
                                            $query->bindParam(':rollid', $rollid, PDO::PARAM_STR);
                                            $query->bindParam(':classid', $classid, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            $totlcount = 0;
                                            $outof = 0;
                                            $passOrFail = "Pass"; // Initialize as Pass
                                            if ($countrow = $query->rowCount() > 0) {
                                                foreach ($results as $result) {
                                                    ?>
                                                    <tr>
                                                        <th scope="row" style="text-align: center"><?php echo htmlentities($cnt); ?></th>
                                                        <td style="text-align: center"><?php echo htmlentities($result->SubjectName); ?></td>
                                                        <td style="text-align: center">
                                                            <?php
                                                            $totalmarks = htmlentities($result->marks);
                                                            echo $totalmarks;
                                                            ?>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <?php
                                                            if ($totalmarks < 40) {
                                                                echo "Fail";
                                                                $passOrFail = "Fail"; // Update to Fail if marks are below 40
                                                            } else {
                                                                echo "Pass";
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $totlcount += $totalmarks;
                                                    $cnt++;
                                                }
                                                ?>
                                                <tr>
                                                    <th scope="row" colspan="3" style="text-align: center">Total Marks</th>
                                                    <td style="text-align: center"><b><?php echo htmlentities($totlcount); ?></b> out of <b><?php echo htmlentities($outof = ($cnt - 1) * 100); ?></b></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="3" style="text-align: center">Percentage</th>
                                                    <td style="text-align: center"><b><?php echo htmlentities($totlcount * (100) / $outof); ?> %</b></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="3" style="text-align: center">Result</th>
                                                    <td style="text-align: center"><b><?php echo $passOrFail; ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" align="center"><i class="fa fa-print fa-2x" aria-hidden="true"
                                                                                       style="cursor:pointer"
                                                                                       OnClick="CallPrint(this.value)"></i></td>
                                                </tr>
                                            <?php } else { ?>
                                                <div class="alert alert-warning left-icon-alert" role="alert">
                                                    <strong>Notice!</strong> Your result has not been declared yet.
                                                </div>
                                            <?php } ?>
                                            <?php 
 } else
 {?>

<div class="alert alert-danger left-icon-alert" role="alert">
<strong>Oh snap!</strong>
<?php
echo htmlentities("Invalid Roll Id");
 }
?>
                                        </div>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-md-6 -->
                        <div class="form-group">
                            <div class="col-sm-6">
                                <a href="index.php">Back to Home</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.section -->
        </div>
        <!-- /.main-page -->
    </div>
    <!-- /.content-container -->
</div>
<!-- /.content-wrapper -->

<!-- ========== COMMON JS FILES ========== -->
<script src="js/jquery/jquery-2.2.4.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/pace/pace.min.js"></script>
<script src="js/lobipanel/lobipanel.min.js"></script>
<script src="js/iscroll/iscroll.js"></script>

<!-- ========== PAGE JS FILES ========== -->
<script src="js/prism/prism.js"></script>

<!-- ========== THEME JS ========== -->
<script src="js/main.js"></script>
<script>
    $(function ($) {

    });

    function CallPrint(strid) {
        var prtContent = document.getElementById("exampl");
        var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    }
</script>

</script>

<!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->

</body>
</html>
