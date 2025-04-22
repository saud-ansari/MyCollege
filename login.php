<?php
include "connection.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        echo " 
        <script>
        alert('Invalid email or password!'); 
        </script>
        ";
    } else {
        $row = $result->fetch_assoc();

        session_start();
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = $row['role'];
        
        header("Location: dashboard.php");
    }
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
    <div class="container">

        <h2 class="text-center mt-5">My College</h2>
  

        <form action="" method="POST" class="mt-5 card p-4 shadow-sm w-25 mx-auto">
            <h3 class="mt-2 text-center">Login</h3>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control form-control-sm" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control form-control-sm" id="password" name="password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary btn-sm">Login</button>
        </form>
    </div>
</body>