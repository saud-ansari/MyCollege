<?php
include "../connection.php";
include '../config.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $qualification = $_POST['qualification'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];
    $joining_date = $_POST['joining_date'];

    $sql2 = "UPDATE `faculty` SET `gender`='$gender', `mobile`='$mobile', `qualification`='$qualification', `dept_id`='$department', `salary`='$salary', `joining_date`='$joining_date' WHERE id='$id'";
    if ($conn->query($sql2) === TRUE) {
        echo "
        <script>
        alert('Faculty updated successfully!'); 
        window.location.href='faculty_dhb.php';
        </script>
        ";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Get department list
$dept_query = "SELECT * FROM department";
$department_result = $conn->query($dept_query);

// Get users (faculty list)
$user_query = "SELECT * FROM users WHERE role='faculty'";
$users_result = $conn->query($user_query);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT faculty.*, users.name AS name, users.email AS email
            FROM faculty 
            INNER JOIN users ON users.id = faculty.user_id 
            WHERE faculty.id='$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $name = $row['name'];
        $email = $row['email'];
        $user_id = $row['user_id'];
        $mobile = $row['mobile'];
        $gender = $row['gender'];
        $qualification = $row['qualification'];
        $department = $row['dept_id'];
        $salary = $row['salary'];
        $joining_date = $row['joining_date'];
    } else {
        echo "<script>alert('No record found!');</script>";
        header("Location: faculty_dhb.php");
        exit;
    }
} else {
    echo "<script>alert('Invalid request!');</script>";
    header("Location: faculty_dhb.php");
    exit;
}
?>

    <?php include "../navbar.php" ?>
    <div class="container">
        <form action="" method="POST" class="card mt-3 p-4 shadow-sm mx-auto">
            <h4 class="mt-1 text-center">Update Faculty</h4>
            <div class="d-inline float-end">
                <label>Faculty ID:</label>
                <!-- Faculty ID badge -->
                <span class='badge text-bg-warning'><?php echo $id; ?></span>
            </div>
            <hr>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Name:</label>
                    <!-- Name dropdown -->
                    <select class="form-select form-select-sm" id="name" name="name" required>
                        <option value="" disabled>Select Faculty</option>
                        <?php
                        if ($users_result->num_rows > 0) {
                            while ($user = $users_result->fetch_assoc()) {
                                $selected = ($user['name'] == $name) ? "selected" : "";
                                echo "<option value='" . $user['name'] . "'$selected>" . $user['name'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Email:</label>
                    <input type="email" id="email" value="<?php echo $email; ?>" class="form-control form-control-sm" readonly>
                </div>

            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label>User Id:</label>
                    <input type="number" id="id" name="user_id" value="<?php echo $user_id; ?>" class="form-control form-control-sm" readonly>
                </div>
                <div class="col-md-4">
                    <label>Mobile No.:</label>
                    <input type="number" name="mobile" value="<?php echo $mobile; ?>" class="form-control form-control-sm" required>
                </div>
                <div class="col-md-4">
                    <div class="ms-5">
                        <label>Gender:</label><br>
                        <!-- Gender radio fix -->
                        <div class="form-check form-check-inline">
                            <input type="radio" name="gender" value="Male" class="form-check-input" <?php echo ($gender == 'Male') ? 'checked' : ''; ?> required>
                            <label class="form-check-label">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="gender" value="Female" class="form-check-input" <?php echo ($gender == 'Female') ? 'checked' : ''; ?> required>
                            <label class="form-check-label">Female</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Qualification:</label>
                    <input type="text" name="qualification" value="<?php echo $qualification; ?>" class="form-control form-control-sm" required>
                </div>
                <div class="col-md-6">
                    <label>Department:</label>
                    <!-- Department dropdown -->
                    <select class="form-select form-select-sm" id="department" name="department" required>
                        <option value="" disabled>Select Department</option>
                        <?php
                        if ($department_result->num_rows > 0) {
                            while ($dept = $department_result->fetch_assoc()) {
                                $selected = ($department == $dept['dept_id']) ? "selected" : "";
                                echo "<option value='" . $dept['dept_id'] . "' $selected>" . $dept['name'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Salary:</label>
                    <input type="number" name="salary" value="<?php echo $salary; ?>" class="form-control form-control-sm" required>
                </div>
                <div class="col-md-6">
                    <label>Joining Date:</label>
                    <input type="date" name="joining_date" value="<?php echo $joining_date; ?>" class="form-control form-control-sm" required>
                </div>
            </div>
            <div class="text-center">
                <a href="faculty_dhb.php" class="btn btn-secondary mt-3">Back</a>
                <input type="submit" name="update" value="Update Faculty" class="btn btn-primary mt-3">
            </div>
        </form>

    </div>

<?php include "../footer.php" ?>