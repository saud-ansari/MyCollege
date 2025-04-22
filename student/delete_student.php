<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

include '../config.php';

$sql ="UPDATE `students` SET `isActive`=0 && roll_no='' WHERE student_id = {$_GET['id']}";
$result = $conn->query($sql);
if ($result) {
    echo "
    <script>
    alert('Student deleted successfully!'); 
    window.location.href='student_dhb.php';
    </script>
    ";
} else {
    echo "<script>alert('Error: " . $conn->error . "');</script>";
}
$conn->close();
?>