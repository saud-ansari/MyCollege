<?php
include "../connection.php";
include '../config.php';

if (isset($_POST['update'])) {
    $dept_id = $_POST['dept_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql1 = "SELECT * FROM `department` WHERE name='$name' AND dept_id!='$dept_id'";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows == 1) {
        echo "
        <script>
        alert('Department Name Already Exist!');
        window.location.href='update_dept.php?id=$dept_id'; 
        </script>
        ";
        exit;
    }

    $sql = "UPDATE `department` SET `name`='$name',`description`='$description' WHERE dept_id='$dept_id'";
    if ($conn->query($sql) === TRUE) {
        echo "
        <script>
        alert('Department updated successfully!'); 
        window.location.href='dept_dhb.php';
        </script>
        ";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

if (isset($_GET['id'])) {
    $dept_id = $_GET['id'];
    $sql = "SELECT * FROM `department` WHERE dept_id='$dept_id'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $description = $row['description'];
    } else {
        echo "<script>
        alert('Department not found!'); 
        window.location.href='dept_dhb.php';
        </script>";
        exit;
    }
} else {
    echo "<script>
    alert('Invalid request!'); 
    window.location.href='dept_dhb.php';
    </script>";
    exit;
}

?>

<?php include "../navbar.php" ?>
<div class="container mt-3">
    <div class="card mt-4 p-4 shadow-sm">
        <h3 class="text-center">Update Department</h3>
        <form action="" method="POST">
            <input type="hidden" name="dept_id" value="<?php echo $dept_id; ?>">
            Name: <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required><br>
            Description: <textarea name="description" class="form-control" required><?php echo $description; ?>
                </textarea><br>
            <a href="dept_dhb.php" class="btn btn-secondary mt-3">Back</a>
            <input type="submit" name="update" value="Update" class="btn btn-primary mt-3">
        </form>
    </div>
</div>
<?php include "../footer.php" ?>