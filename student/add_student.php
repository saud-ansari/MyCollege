<?php
include "../connection.php";
include '../config.php';

$user_sql = "SELECT * FROM `users` WHERE `role`='student'";
$user_result = $conn->query($user_sql);

$department_sql = "SELECT * FROM `department`";
$department_result = $conn->query($department_sql);

if (isset($_POST['submit'])) {
    $user_id = $_POST['email'];
    $fullname = $_POST['fullname'];
    $rollno = $_POST['rollno'];
    $department = $_POST['department'];
    $mobileno = $_POST['mobileno'];
    $isActive = 1;
    $address = $_POST['address'];

    $checkQuery = "SELECT users.email FROM students
    INNER JOIN users ON students.user_id = $user_id";
    $checkResult = $conn->query($checkQuery);
    if ($checkResult->num_rows > 0) {
        echo "
        <script>
        alert('Student is already added!');
        </script>
        ";
        exit;
    } else {

        $sql = "INSERT INTO `students` (`user_id`, `dept_id`, `full_name`, `roll_no`, `mobile`, `isActive`, `address`) 
            VALUES ('$user_id', '$department', '$fullname', '$rollno', '$mobileno', '$isActive', '$address')";
        if ($conn->query($sql) === TRUE) {
            echo "
        <script>
        alert('Student added successfully!'); 
        window.location.href='student_dhb.php';
        </script>
        ";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}
?>

    <?php include "../navbar.php"?>
    <div class="container">
        <div class="card my-3 p-4 shadow-sm">
            <div class="card-header">
                <h2 class="text-center">Add Student</h2>
            </div>

            <form action="" method="POST" class="mt-4">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Student Email: </label>
                        <select id="email" name="email" class="form-control form-control-sm" required onchange="updateinputs(this)">
                            <option value="">Select Email</option>
                            <?php
                            if ($user_result->num_rows > 0) {
                                while ($row = $user_result->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "' data-name= '" . $row['name'] . "'>" . $row['email'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No users found</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Name:</label>
                        <input type="text" id="name" name="name" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label>Full Name:</label>
                        <input type="text" id="fullname" name="fullname" class="form-control form-control-sm" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Department:</label>
                        <select id="department" name="department" class="form-control form-control-sm" required onchange="generateRollno()">
                            <option value="">Select Department</option>
                            <?php
                            if ($department_result->num_rows > 0) {
                                while ($row = $department_result->fetch_assoc()) {
                                    echo "<option value='" . $row['dept_id'] . "'>" . $row['name'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No departments found</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Roll No:</label>
                        <input type="text" id="rollno" name="rollno" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Mobile No:</label>
                        <input type="text" id="mobileno" name="mobileno" class="form-control form-control-sm" required>
                    </div>

                    <div class="col-md-6">
                        <label>Address:</label>
                        <input type="text" id="address" name="address" class="form-control form-control-sm" required>
                    </div>
                </div>
                <div class="text-center">
                    <a href="student_dhb.php" class="btn btn-danger">Cancel</a>
                    <input type="submit" name="submit" value="Add Student" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
    <script>
        function updateinputs(select) {
            var name = select.options[select.selectedIndex].getAttribute('data-name');
            document.getElementById('name').value = name;
        }

        function generateRollno() {
            var deptSelect = document.getElementById('department');
            var deptId = deptSelect.value;

            if (!deptId) {
                document.getElementById('rollno').value = "";
                return;
            }

            // Fetch roll number using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "get_rollno.php?dept_id=" + deptId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('rollno').value = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>

<?php include "../footer.php"?>