<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit;
}

include '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM `faculty` WHERE `id` = $id";
    if ($conn->query($sql) === TRUE) {
        echo "
        <script>
        alert('Faculty deleted successfully!');
        window.location.href='faculty_dhb.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Error deleting faculty: " . $conn->error . "');
        window.location.href='faculty_dhb.php';
        </script>
        ";
    }
}
?>
