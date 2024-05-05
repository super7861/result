<?php
include('includes/config.php');

// Code to fetch students based on class
if (!empty($_POST["classid"])) {
    $cid = intval($_POST['classid']);
    if (!is_numeric($cid)) {
        echo htmlentities("Invalid Class");
        exit;
    } else {
        $stmt = $dbh->prepare("SELECT StudentName,StudentId FROM tblstudents4 WHERE ClassId= :id ORDER BY StudentName");
        $stmt->execute(array(':id' => $cid));
        ?><option value="">Select Student </option><?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
            <option value="<?php echo htmlentities($row['StudentId']); ?>"><?php echo htmlentities($row['StudentName']); ?></option>
<?php
        }
    }
}

// Code for Subjects and marks input boxes
if (!empty($_POST["classid1"])) {
    $cid1 = intval($_POST['classid1']);
    if (!is_numeric($cid1)) {
        echo htmlentities("Invalid Class");
        exit;
    } else {
        $status = 0;
        $stmt = $dbh->prepare("SELECT tblsubjects4.SubjectName, tblsubjects4.id FROM tblsubjectcombination4 JOIN tblsubjects4 ON tblsubjects4.id=tblsubjectcombination4.SubjectId WHERE tblsubjectcombination4.ClassId=:cid AND tblsubjectcombination4.status!=:stts ORDER BY tblsubjects4.SubjectName");
        $stmt->execute(array(':cid' => $cid1, ':stts' => $status));

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
            <p>
                <?php echo htmlentities($row['SubjectName']); ?>
                <input type="text" name="marks[]" value="" class="form-control" required="" placeholder="Enter marks out of 100" autocomplete="off">
                <span class="mark-validation" style="color: red;"></span> <!-- Validation message placeholder -->
            </p>

<?php
        }
    }
}

// Code to check if result is already declared
if (!empty($_POST["studclass"])) {
    $id = $_POST['studclass'];
    $dta = explode("$", $id);
    $id = $dta[0];
    $id1 = $dta[1];
    $query = $dbh->prepare("SELECT StudentId,ClassId FROM tblresult4 WHERE StudentId=:id1 AND ClassId=:id ");
    $query->bindParam(':id1', $id1, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
?>
        <p>
            <?php
            echo "<span style='color:red'>Result Already Declared.</span>";
            echo "<script>$('#submit').prop('disabled',true);</script>";
            ?>
        </p>
<?php
    }
}

// Validation for marks 100 or below
if (!empty($_POST["marks"])) {
    $marks = $_POST["marks"];
    foreach ($marks as $mark) {
        if (intval($mark) > 100) {
?>
            <p>
                <span style='color:red'>Marks should be 100 or below. Please enter valid marks.</span>
            </p>
<?php
            break; // Exit the loop if any mark is above 100
        }
    }
}
?>

<script>
    // Add JavaScript to validate marks on input change
    $(document).ready(function () {
        $("input[name='marks[]']").on('input', function () {
            var mark = $(this).val();
            var validationMsg = $(this).siblings('.mark-validation');
            if (parseInt(mark) > 100) {
                validationMsg.text('Marks should be 100 or below.');
            } else {
                validationMsg.text('');
            }
        });
    });
</script>
