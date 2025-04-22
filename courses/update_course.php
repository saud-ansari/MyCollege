<?php
include "../connection.php";
include '../config.php';

if (isset($_POST['update'])) {
    $course_id = $_POST['course_id'];
    $name = $_POST['course_name'];
    $code = $_POST['course_code'];
    $department_id = $_POST['department']; // dept_id directly
    $faculty_id = $_POST['faculty']; // faculty.id directly
    $semester = $_POST['semester'];
    $credit = $_POST['credits'];
    $course_type = $_POST['course_type'];

    // Check for duplicate course code (other than current course)
    $checkQuery = "SELECT * FROM `course` WHERE `course_code` = '$code' AND course_id != '$course_id'";
    $checkResult = $conn->query($checkQuery);
    if ($checkResult->num_rows > 0) {
        echo "<script>alert('This course is already added!');</script>";
    } else {
        // Update course
        $sql = "UPDATE `course` SET 
                `course_name` = '$name', 
                `dept_id` = '$department_id', 
                `faculty_id` = '$faculty_id', 
                `semester` = '$semester', 
                `credits` = '$credit', 
                `course_type` = '$course_type' 
                WHERE course_id = '$course_id'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Course updated successfully!'); window.location.href='course_dhb.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}

// Get dropdown data
$dept_result = $conn->query("SELECT * FROM department");
$faculty_result = $conn->query("SELECT faculty.id, users.name FROM faculty JOIN users ON faculty.user_id = users.id");

if (isset($_GET['id'])) {
    $course_id = $_GET['id'];
    $sql = "SELECT course.*, department.dept_id, department.name AS department_name, users.name AS faculty_name, faculty.id AS faculty_id
            FROM course
            JOIN department ON course.dept_id = department.dept_id
            JOIN faculty ON course.faculty_id = faculty.id
            JOIN users ON faculty.user_id = users.id
            WHERE course.course_id = '$course_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $course_code = $row['course_code'];
        $course_name = $row['course_name'];
        $department_id = $row['dept_id'];
        $faculty_id = $row['faculty_id'];
        $semester = $row['semester'];
        $credits = $row['credits'];
        $course_type = $row['course_type'];
    } else {
        echo "<script>alert('Course not found!');</script>";
        exit;
    }
} else {
    echo "<script>alert('No course ID provided!');</script>";
    exit;
}
?>

    <?php include "../navbar.php" ?>

    <div class="container">
        <form action="" method="POST" class="card my-3 p-4 shadow-sm mx-auto">
            <h4 class="mt-2 text-center">Update Course</h4>
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
            <hr>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Course Name:</label>
                    <input type="text" name="course_name" value="<?php echo $course_name; ?>" class="form-control form-control-sm" required>
                </div>
                <div class="col-md-6">
                    <label>Course Code:</label>
                    <input type="text" name="course_code" value="<?php echo $course_code; ?>" class="form-control form-control-sm" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Department:</label>
                    <select class="form-select form-select-sm" name="department" required>
                        <option value="" disabled>Select Department</option>
                        <?php
                        while ($row = $dept_result->fetch_assoc()) {
                            $selected = ($department_id == $row['dept_id']) ? "selected" : "";
                            echo "<option value='{$row['dept_id']}' $selected>{$row['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Faculty:</label>
                    <select class="form-select form-select-sm" name="faculty" required>
                        <option value="" disabled>Select Faculty</option>
                        <?php
                        while ($row = $faculty_result->fetch_assoc()) {
                            $selected = ($faculty_id == $row['id']) ? "selected" : "";
                            echo "<option value='{$row['id']}' $selected>{$row['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Semester:</label>
                    <select class="form-select form-select-sm" name="semester" required>
                        <option value="" disabled>Select Semester</option>
                        <?php
                        for ($i = 1; $i <= 6; $i++) {
                            $selected = ($semester == $i) ? "selected" : "";
                            echo "<option value='$i' $selected>$i</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Credits:</label>
                    <input type="number" name="credits" value="<?php echo $credits; ?>" class="form-control form-control-sm" required>
                </div>
                <div class="col-md-4">
                    <label>Course Type:</label>
                    <select class="form-select form-select-sm" name="course_type" required>
                        <option value="" disabled>Select Course Type</option>
                        <option value="compulsory" <?php echo ($course_type == 'compulsory') ? "selected" : ""; ?>>Compulsory</option>
                        <option value="optional" <?php echo ($course_type == 'optional') ? "selected" : ""; ?>>Optional</option>
                    </select>
                </div>
            </div>

            <div class="text-center">
                <a href="course_dhb.php" class="btn btn-secondary mt-3">Back</a>
                <input type="submit" name="update" value="Update Course" class="btn btn-primary mt-3">
            </div>
        </form>
    </div>

<?php include "../footer.php" ?>
