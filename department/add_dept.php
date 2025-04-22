<?php
include "../connection.php";
include '../config.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $added_by = $_SESSION['id'];

    $sql1 = "SELECT * FROM `department` WHERE name='$name'";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows == 1) {
        echo "
        <script>
        alert('Department Name Already Exist!'); 
        window.location.href='add_dept.php';
        </script>
        ";
        exit;
    }

    $sql = "INSERT INTO `department` (`name`, `description`, `added_by`) VALUES ('$name', '$description', '$added_by')";
    if ($conn->query($sql) === TRUE) {
        echo "
        <script>
        alert('Department added successfully!'); 
        window.location.href='dept_dhb.php';
        </script>
        ";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// print_r($_SESSION);

?>

<?php include "../navbar.php" ?>
<div class="container">
    <div class="card mt-3 p-4 shadow-sm  ">
        <div class="card-header">
            <h2 class="text-center">Add Department</h2>
        </div>
        <form action="" method="POST">
            Name: <input type="text" name="name" class="form-control" required>
            Description: <textarea name="description" class="form-control" required></textarea>
            <a href="dept_dhb.php" class="btn btn-secondary mt-3">Back</a>
            <input type="submit" name="submit" value="Add Department" class="btn btn-primary mt-3">
        </form>

    </div>
</div>
<?php include "../footer.php" ?>