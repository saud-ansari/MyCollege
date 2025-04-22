<?php

include "../connection.php";
include '../config.php';

$limit = 5; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT course.*, department.name as department, users.name as faculty
        FROM course
        JOIN department ON course.dept_id = department.dept_id
        JOIN faculty ON course.faculty_id = faculty.id
        JOIN users ON faculty.user_id = users.id
        LIMIT $offset,$limit";
$result = $conn->query($sql);

$total_query = $conn->query("SELECT COUNT(*) AS total FROM course");
$total_records = $total_query->fetch_assoc()['total'];
$total_pages = ceil($total_records / $limit);

?>

    <?php include "../navbar.php"; ?>

    <div class="container mt-3">
        <h3 class="mt-1 alert alert-success">Welcome, <?php echo $_SESSION['name']; ?></h3>

        <div class="table-responsive my-3 p-4 shadow rounded-3">
            <a href="add_course.php" class="btn btn-success float-end">Add Course</a>
            <h3 class="mt-2 text-center">Course List</h3>

            <table class="table table-bordered table-hover table-sm my-3" style="min-width: 800px;">
                <thead>
                    <tr class="text-center table-success">
                        <th>Sr.</th>
                        <th>Name</th>
                        <th>Course Code</th>
                        <th>Course Type</th>
                        <th>Department</th>
                        <th>Faculty</th>
                        <th>Semester</th>
                        <th>Credits</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $sr_no = $offset + 1;
                        while ($row = $result->fetch_assoc()) {                           
                            echo "
                            <tr>
                                <td class='text-center'>{$sr_no}</td>
                                <td class=''>{$row['course_name']}</td>
                                <td class='text-center'>{$row['course_code']}</td>
                                <td class='text-center text-muted text-bg-light'>{$row['course_type']}</td>
                                <td class='text-center'>
                                <span class='text-uppercase badge text-bg-secondary'>{$row['department']}</span>
                                </td>
                                <td class='text-center'>                                
                                <span class='text-uppercase badge text-bg-warning'>{$row['faculty']}</span>
                                </td>
                                <td class='text-center'>
                                <span class='badge text-bg-info'>{$row['semester']} </span></td>
                                <td class='text-center'> 
                                <span class='badge text-bg-success'>{$row['credits']}</span></td>
                                <td class='text-center'>
                                    <a href='update_course.php?id={$row['course_id']}' class='btn btn-primary btn-sm'>Edit</a>
                                    <a href='delete_course.php?id={$row['course_id']}' class='btn btn-danger btn-sm'>Delete</a>
                            </tr>";
                            $sr_no++;
                        }
                    } else {
                        echo "<tr><td colspan='10' class='text-center'>No records found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
            <?php if ($total_pages > 1): ?>
                <nav>
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>">&laquo;</a>
                        </li>
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= ($page == $total_pages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>">&raquo;</a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>
<?php include "../footer.php"; ?>