<?php
include "../connection.php";
include '../config.php';

if (isset($_GET['id'])) {
    $dept_id = $_GET['id'];
    $sql = "DELETE FROM `department` WHERE dept_id = '$dept_id'";
    if ($conn->query($sql) === TRUE) {
        echo "
    <script>
    alert('Department deleted successfully!'); 
    window.location.href='dept_dhb.php';
    </script>
    ";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
} else {
    echo "<script>alert('No department ID provided!'); window.location.href='dept_dhb.php';</script>";
    exit();
}
