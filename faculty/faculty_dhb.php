<?php
include "../connection.php";
include '../config.php';

if ($_SESSION['role'] != 'Admin') {
    header("Location: ../dashboard.php");
    exit();
}

$limit = 5; // records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT faculty.*, users.name AS `name`, users.email AS `email`, department.name AS `department`
         FROM faculty 
         INNER JOIN users 
         ON users.id = faculty.user_id
         INNER JOIN department
         ON department.dept_id = faculty.dept_id 
	LIMIT $offset, $limit";
$result = $conn->query($sql);

$totalQuery = $conn->query("SELECT COUNT(*) AS total FROM `faculty`");
$total = $totalQuery->fetch_assoc()['total'];
$totalpages = ceil($total / $limit);

?>

    <?php include "../navbar.php" ?>
    <div class="container mt-3">
        <h3 class="mt-1 alert alert-success">Welcome, <?php echo $_SESSION['name']; ?></h3>

        <div class="table-responsive my-3 p-4 shadow rounded-3 ">
            <a href="add_faculty.php" class="btn btn-success float-end">Add Faculty</a>
            <h3 class="mt-2 text-center">Faculty List</h3>

            <table class="my-3 table table-bordered table-hover table-sm overflow-x-auto" style="min-width: 1000px;">
                <thead>
                    <tr class="text-center table-success">
                        <th>Id</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Qualification</th>
                        <th>Department</th>
                        <th>Salary</th>
                        <th>Joining Date</th>
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
                                <td class='text-center'>{$row['name']}</td>                                
                                <td class='text-center'>{$row['gender']}</td>                                
                                <td class='text-center'>{$row['email']}</td>
                                <td class='text-center'>{$row['mobile']}</td>
                                <td class='text-center'>{$row['qualification']}</td>                                
                                <td class='text-center'>";
                            if ($row['dept_id'] == 1) {
                                echo "<span class='badge bg-success'>" . $row['department'] . "</span>";
                            } elseif ($row['dept_id'] == 2) {
                                echo "<span class='badge bg-warning'>" . $row['department'] . "</span>";
                            } elseif ($row['dept_id'] == 3) {
                                echo "<span class='badge bg-danger'>" . $row['department'] . "</span>";
                            } elseif ($row['dept_id'] == 4) {
                                echo "<span class='badge bg-primary'>" . $row['department'] . "</span>";
                            } else {
                                echo "<span class='badge bg-secondary'>" . $row['department'] . "</span>";
                            }
                            echo "</td>                                
                                <td class='text-center'>{$row['salary']}</td>
                                <td class='text-center'>{$row['joining_date']}</td>
                                <td class='text-center'>
                                    <a href='update_faculty.php?id={$row['id']}' class='btn btn-sm btn-primary'>Edit</a>
                                    <a href='delete_faculty.php?id={$row['id']}' class='btn btn-sm btn-danger'>Delete</a>                               
                                </td>
                            </tr>                            
                            ";
                            $sr_no++;
                        }
                    } else {
                        echo "<tr><td colspan='10' class='text-center'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <?php if ($totalpages > 1): ?>
                <nav>
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>">&laquo;</a>
                        </li>
                        <?php for ($i = 1; $i <= $totalpages; $i++): ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= ($page == $totalpages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>">&raquo;</a>
                        </li>
                    </ul>  
                </nav>
            <?php endif; ?>
        </div>
    </div>

<?php include "../footer.php" ?>