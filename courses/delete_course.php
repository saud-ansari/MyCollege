<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit;
}

include '../config.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM `course` WHERE `course_id`='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "
        <script>
        alert('Course deleted successfully!'); 
        window.location.href='course_dhb.php';
        </script>
        ";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
    exit;
} else{
    echo "
    <script>
    alert('Invalid request!'); 
    window.location.href='course_dhb.php';
    </script>
    ";
}
?>