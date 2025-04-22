<?php
include "../connection.php";
include '../config.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql = "DELETE FROM `users` WHERE id='$user_id'";
    if ($conn->query($sql) === TRUE) {
        echo "
        <script>
        alert('User deleted successfully!'); 
        window.location.href='user_dhb.php';
        </script>
        ";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>