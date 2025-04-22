<?php
include "../connection.php";
include '../config.php';

$sql = "SELECT * FROM `users` WHERE `role`='faculty'";
$result = $conn->query($sql);

$sql1 = "SELECT * FROM `department`";
$result1 = $conn->query($sql1);

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $qualification = $_POST['qualification'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];
    $joining_date = $_POST['joining_date'];

    // Check if faculty already exists
    $checkQuery = "SELECT * FROM `faculty` WHERE `user_id` = '$id'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        echo "
    <script>
    alert('This faculty is already added!');
    </script>
    ";
    } else {
        // Insert new faculty
        $sql2 = "INSERT INTO `faculty` (`user_id`, `gender`, `mobile`, `qualification`, `dept_id`, `salary`, `joining_date`) 
             VALUES ('$id', '$gender', '$mobile', '$qualification', $department, '$salary', '$joining_date')";

        if ($conn->query($sql2) === TRUE) {
            echo "
        <script>
        alert('Faculty added successfully!'); 
        window.location.href='faculty_dhb.php';
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
                <h2 class="text-center">Add Faculty</h2>
            </div>

            <form action="" method="POST" class="mt-4">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Email:</label>
                        <select class="form-select form-select-sm" id="email" name="email" required onchange="updateinputs(this)">
                            <option value="" disabled selected>Select Faculty</option>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['email'] . "' data-name='" . $row['name'] . "'data-id='" . $row['id'] . "'>" . $row['email'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No Faculty Found</option>";
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
                    <div class="col-md-4">
                        <label>User Id:</label>
                        <input type="number" id="id" name="id" class="form-control form-control-sm" readonly>
                    </div>
                    <div class="col-md-4">
                        <label>Mobile No.:</label>
                        <input type="number" name="mobile" class="form-control form-control-sm" required>
                    </div>
                    <div class="col-md-4">
                        <div class="ms-5">
                            <label>Gender:</label><br>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="gender" value="Male" class="form-check-input" required>
                                <label class="form-check-label">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="gender" value="Female" class="form-check-input" required>
                                <label class="form-check-label">Female</label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Qualification:</label>
                        <input type="text" name="qualification" class="form-control form-control-sm" required>
                    </div>
                    <div class="col-md-6">
                        <label>Department:</label>
                        <select class="form-select form-select-sm" id="department" name="department" required>
                            <option value="" disabled selected>Select Department</option>
                            <?php
                            if ($result1->num_rows > 0) {
                                while ($row = $result1->fetch_assoc()) {
                                    echo "<option value='" . $row['dept_id'] . "'>" . $row['name'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No Department Found</option>";
                            }
                            ?>
                        </select>

                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Salary:</label>
                        <input type="number" name="salary" class="form-control form-control-sm" required>
                    </div>
                    <div class="col-md-6">
                        <label>Joining Date:</label>
                        <input type="date" name="joining_date" class="form-control form-control-sm" required>
                    </div>
                </div>
                <div class="text-center">
                    <a href="faculty_dhb.php" class="btn btn-secondary mt-3">Back</a>
                    <input type="submit" name="submit" value="Add Faculty" class="btn btn-primary mt-3">
                </div>

            </form>
        </div>
    </div>

    <script>
        function updateinputs(select) {
            var id = select.options[select.selectedIndex].getAttribute('data-id');
            document.getElementById('id').value = id;
            var name = select.options[select.selectedIndex].getAttribute('data-name');
            document.getElementById('name').value = name;
        }
    </script>

<?php include "../footer.php" ?>