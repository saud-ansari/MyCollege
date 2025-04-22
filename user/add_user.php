<?php
include "../connection.php";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql1 = "SELECT * FROM `users` WHERE email='$email'";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows == 1) {
        echo "
        <script>
        alert('Email Id Already Exist!'); 
        window.location.href='add_user.php';
        </script>
        ";
        exit;
    }

    $sql = "INSERT INTO `users` (`name`, `email`, `password`, `createdat`, `role`) VALUES ('$name', '$email', '$password', NOW(), '$role')";
    if ($conn->query($sql) === TRUE) {
        echo "
        <script>
        alert('User added successfully!'); 
        window.location.href='user_dhb.php';
        </script>
        ";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

$conn->close();
?>

<?php include "../navbar.php"; ?>
    <div class="container">
        <form action="" method="POST" class="my-3 card p-4 shadow-sm w-50 mx-auto">
            <h3 class="mt-2">Add User</h3>
            <hr>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control  form-control-sm" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select form-select-sm" id="role" name="role" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="Admin">Admin</option>
                    <option value="Faculty">Faculty</option>
                    <option value="Student">Student</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control  form-control-sm" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control  form-control-sm" id="password" name="password" required>
            </div>
            <div class="text-center">
                <a href="user_dhb.php" class="btn btn-secondary btn-sm  w-25">Back</a>
                <input type="submit" class="btn btn-primary btn-sm w-25" name="submit" value="submit">
            </div>
        </form>
    </div>
<?php include "../footer.php"; ?>