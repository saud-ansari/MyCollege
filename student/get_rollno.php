<?php
include '../config.php';

if (isset($_GET['dept_id'])) {
    $dept_id = $_GET['dept_id'];

    // Get department name
    $dept_query = "SELECT name FROM department WHERE dept_id = $dept_id";
    $dept_result = $conn->query($dept_query);
    $dept_prefix = "";
    if ($dept_result->num_rows > 0) {
        $dept_row = $dept_result->fetch_assoc();
        $dept_prefix = strtoupper(substr($dept_row['name'], 0, 3));
    }

    // Get latest roll number in this department
    $roll_query = "SELECT roll_no FROM students WHERE isActive=1 && dept_id = $dept_id ORDER BY student_id DESC LIMIT 1";
    $roll_result = $conn->query($roll_query);

    $new_rollno = $dept_prefix . "001"; // default if no record exists

    if ($roll_result->num_rows > 0) {
        $last_roll = $roll_result->fetch_assoc()['roll_no'];
        $number = (int)substr($last_roll, 3); // extract numeric part
        $number += 1;
        $new_rollno = $dept_prefix . str_pad($number, 3, '0', STR_PAD_LEFT);
    }

    echo $new_rollno;
}
?>
