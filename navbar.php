<?php include_once 'connection.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>MyCollege</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Add Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Lato', sans-serif;
        }

        .active {
            background-color: #ffc107 !important;
            color: black !important;
            border-radius: 5px !important;

        }
        
    </style>
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container py-3">
            <a class="navbar-brand text-warning" href="#">
                <i class="fas fa-university"></i>
                MyCollege</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <?php
            function isActiveNav($pathSegment)
            {
                $currentPath = strtolower($_SERVER['PHP_SELF']);
                return (strpos($currentPath, strtolower($pathSegment)) !== false) ? 'active' : '';
            }
            ?>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= isActiveNav('/dashboard')  ?>" href="<?php echo BASE_URL . 'dashboard.php'; ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link <?= isActiveNav('/user/') ?>" href="<?= BASE_URL . 'user/user_dhb.php'; ?>">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isActiveNav('/department/') ?>" href="<?php echo BASE_URL . 'department/dept_dhb.php'; ?>">Departments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isActiveNav('/faculty/') ?>" href="<?php echo BASE_URL . 'faculty/faculty_dhb.php'; ?>">Faculties</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isActiveNav('/courses/') ?>" href="<?php echo BASE_URL . 'courses/course_dhb.php'; ?>">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isActiveNav('/student/') ?>" href="<?php echo BASE_URL . 'student/student_dhb.php'; ?>">Students</a>
                    </li>
                </ul>

                <!-- Session-based login/logout buttons -->
                <div class="d-flex">
                    <a href="logout.php" class="btn btn-danger ">Logout</a>
                </div>
            </div>
        </div>
    </nav>
