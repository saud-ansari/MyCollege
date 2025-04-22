<?php
include "../connection.php";
include '../config.php';

$sql = "SELECT * FROM `users` WHERE `role`='faculty'";
$user_result = $conn->query($sql);

$sql1 = "SELECT * FROM `department`";
$dept_result = $conn->query($sql1);

if (isset($_POST['submit'])) {
    $name = $_POST['course_name'];
    $code = $_POST['course_code'];
    $department = $_POST['dept_name'];
    $faculty = $_POST['dept_faculty'];
    $semester = $_POST['semester'];
    $credit = $_POST['credits'];
    $course_type = $_POST['course_type'];

    // Check if faculty already exists
    $checkQuery = "SELECT * FROM `course` WHERE `course_code` = '$code'";
    $checkResult = $conn->query($checkQuery);
    if ($checkResult->num_rows > 0) {
        echo "
    <script>
    alert('This course is already added!');
    </script>
    ";
    } else {
        // Insert new faculty
        $sql2 = "INSERT INTO `course` (`course_name`, `course_code`, `dept_id`, `faculty_id`, `semester`, `credits`, `course_type`) 
        VALUES (
            '$name', 
            '$code',     
            (SELECT dept_id FROM department WHERE `name`='$department'), 
            (SELECT faculty.id FROM faculty JOIN users ON faculty.user_id = users.id WHERE users.name='$faculty'), 
            '$semester', 
            '$credit',
            '$course_type'
        )";

        if ($conn->query($sql2) === TRUE) {
            echo "
        <script>
        alert('Course added successfully!'); 
        window.location.href='course_dhb.php';
        </script>
        ";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}

?>
    <?php include "../navbar.php" ?>
    <div class="container">
        <div class="card my-3 p-4 shadow-sm">
            <div class="card-header">
                <h2 class="text-center">Add Course</h2>
            </div>

            <form action="" method="POST" class="mt-4">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Course Name: </label>
                        <input type="text" name="course_name" class="form-control form-control-sm" required>
                    </div>

                    <div class="col-md-6">
                        <label>Course Code:</label>
                        <input type="text" id="course_code" name="course_code" class="form-control form-control-sm" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Departament Name:</label>
                        <select class="form-select form-select-sm" id="dept_name" name="dept_name">
                            <option value="" disabled selected>Select Department</option>
                            <?php
                            if ($dept_result->num_rows > 0) {
                                while ($row = $dept_result->fetch_assoc()) {
                                    echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No Faculty Found</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Faculty Name:</label>
                        <select class="form-select form-select-sm" id="dept_faculty" name="dept_faculty" required>
                            <option value="" disabled selected>Select Faculty</option>
                            <?php
                            if ($user_result->num_rows > 0) {
                                while ($row = $user_result->fetch_assoc()) {
                                    echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No Faculty Found</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div>
                            <label>Semester:</label><br>
                            <select class="form-select form-select-sm" id="semester" name="semester" required>
                                <option value="" disabled selected>Select Semester</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Credit:</label>
                        <input type="text" name="credits" class="form-control form-control-sm" required>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <label>Course Type:</label><br>
                            <select class="form-select form-select-sm" name="course_type" required>
                                <option value="" disabled selected>Select Type</option>
                                <option value="compulsory">Compulsory</option>
                                <option value="optional">Optional</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a href="course_dhb.php" class="btn btn-secondary mt-3">Back</a>
                    <input type="submit" name="submit" value="Add Cource" class="btn btn-primary mt-3">
                </div>
            </form>
        </div>
    </div>
<?php include "../footer.php" ?>