<?php

include "../connection.php";
include '../config.php';

if(isset($_POST['update'])){
    $id = $_POST['student_id'];    
    $fullname = $_POST['fullname'];
    $rollno = $_POST['rollno'];
    $mobile = $_POST['mobileno'];
    $address = $_POST['address'];
    $department = $_POST['department'];

    print_r($_POST);

    $sql2 = "UPDATE `students` SET `full_name`='$fullname',`roll_no`='$rollno', `mobile`='$mobile', `address`='$address', `dept_id`='$department' WHERE student_id='$id'";
    
    if($conn->query($sql2) === TRUE){
        echo "<script>alert('Student updated successfully!'); 
        window.location.href='student_dhb.php';</script>";
    }else{
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}


$dept_query = "SELECT * FROM department";
$department_result = $conn->query($dept_query);

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $sql = "SELECT students.*, users.name, users.email FROM students
    INNER JOIN users ON students.user_id = users.id
    WHERE students.student_id='$id'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $id = $row['student_id'];
        $user_id = $row['user_id'];
        $email = $row['email'];
        $name = $row['name'];
        $full_name = $row['full_name'];
        $roll_no = $row['roll_no'];
        $department = $row['dept_id'];
        $mobile = $row['mobile'];
        $address = $row['address'];
    }else{
        echo "<script>alert('No student found with this ID!');</script>";
        exit;
    }
}

?>

<?php include "../navbar.php"?>
    <div class="container">
        <form action="" method="POST" class="card my-3 p-4 shadow-sm mx-auto">
            <h3 class="mt-2 text-center">Update Student</h3>
            <div class="d-inline float-end">
                <label>Student ID:</label>
                <!-- Faculty ID badge -->
                <span class='badge text-bg-warning'><?php echo $id; ?></span>
            </div>
            <hr>

            <input type="hidden" id="student_id" name="student_id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Student Email: </label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>" class="form-control form-control-sm" required readonly>
                </div>                   

                <div class="col-md-6">
                    <label>Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $name; ?>" class="form-control form-control-sm" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label>Full Name:</label>
                    <input type="text" id="fullname" name="fullname" value="<?php echo $full_name; ?>" class="form-control form-control-sm" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Department:</label>
                    <select id="department" name="department" class="form-select form-select-sm" required onchange="generateRollno()">
                        <option value="" disabled>Select Department</option>
                        <?php
                        if ($department_result->num_rows > 0) {
                            while ($dept = $department_result->fetch_assoc()) {
                                $selected = ($department == $dept['dept_id']) ? "selected" : "";
                                echo "<option value='" . $dept['dept_id'] . "' $selected>" . $dept['name'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No departments found</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Roll No:</label>
                    <input type="text" id="rollno" name="rollno" value="<?php echo $roll_no; ?>" class="form-control form-control-sm" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Mobile No:</label>
                    <input type="text" id="mobileno" name="mobileno" value="<?php echo $mobile; ?>" class="form-control form-control-sm" required>
                </div>

                <div class="col-md-6">
                    <label>Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo $address; ?>" class="form-control form-control-sm" required>
                </div>
            </div>
            <div class="text-center">
                <a href="student_dhb.php" class="btn btn-danger">Cancel</a>
                <input type="submit" name="update" value="update Student" class="btn btn-primary">
            </div>
        </form>
    </div>
    <script>
        
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