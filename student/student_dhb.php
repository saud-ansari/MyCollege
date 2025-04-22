<?php
include "../connection.php";
include_once '../config.php';

$limit = 5; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT students.*, users.email, department.name AS Department FROM students
INNER JOIN users ON students.user_id = users.id
INNER JOIN department ON students.dept_id = department.dept_id 
WHERE isActive=1
LIMIT $offset,$limit";
$result = $conn->query($sql);

$total_query = $conn->query("SELECT COUNT(*) AS total FROM students");
$total_records = $total_query->fetch_assoc()['total'];
$total_pages = ceil($total_records / $limit);

?>

<?php include "../navbar.php"; ?>
<div class="container mt-3">

    <h3 class="mt-1 alert alert-success">Welcome, <?php echo $_SESSION['name']; ?></h3>

    <div class="table-responsive my-3 p-4 shadow rounded-3">
        <a href="add_student.php" class="btn btn-success float-end">Add Student</a>
        <h3 class="mt-2 text-center">Student List</h3>

        <table class="table table-bordered table-hover table-sm my-3" style="min-width: 800px;">
            <thead>
                <tr class="text-center table-success">
                    <th>Sr.</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Roll No.</th>
                    <th>Department</th>
                    <th>Phone No.</th>
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
                            <td>{$sr_no}</td>
                            <td>{$row['full_name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['roll_no']}</td>
                            <td class='text-center' >
                            <span class='badge text-bg-warning'>{$row['Department']}</span></td>
                            <td>{$row['mobile']}</td>
                            <td class='text-center'>
                                <a href='update_student.php?id={$row['student_id']}' class='btn btn-primary btn-sm'>Edit</a>
                                <a href='delete_student.php?id={$row['student_id']}' class='btn btn-danger btn-sm'>Delete</a>
                            </td>
                            </tr>";
                        $sr_no++;
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No students found</td></tr>";
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