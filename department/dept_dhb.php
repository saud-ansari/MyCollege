<?php
include "../connection.php";
include '../config.php';

$limit = 5; // Number of records per page
$page = isset($_GET['page']) ? (int)$_Get['page'] : 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT department.*, users.name AS added_by
         FROM department 
         INNER JOIN users 
         ON users.id = department.added_by
	LIMIT $offset,$limit";
$result = $conn->query($sql);

$totalquery = $conn->query("SELECT COUNT(*) AS total FROM department");
$total = $totalquery->fetch_assoc()['total'];
$total_pages = ceil($total / $limit);
?>
<?php include '../navbar.php'; ?>
<div class="container mt-3">
    <h3 class="mt-1 alert alert-success">Welcome, <?php echo $_SESSION['name']; ?></h3>

    <div class="table-responsive my-3 p-4 shadow rounded-3">
        <a href="add_dept.php" class="btn btn-success float-end">Add Department</a>
        <h3 class="mt-2 text-center">Department List</h3>

        <table class="my-3 table table-bordered table-hover table-sm" style="min-width: 800px;">
            <thead>
                <tr class="text-center table-success">
                    <th>Id</th>
                    <th>Department Name</th>
                    <th>Description</th>
                    <th>Added By</th>
                    <th style="width: 130px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
                            <tr>
                                <td>{$row['dept_id']}</td>
                                <td>{$row['name']}</td>
                                <td class='fw-lighter'>{$row['description']}</td>
                                <td class='text-center'>
                                    <span class='text-uppercase badge text-bg-warning'>{$row['added_by']}</span>                               
                                </td>
                                <td class='text-center'>
                                    <a href='update_dept.php?id={$row['dept_id']}' class='btn btn-sm btn-primary'>Edit</a>
                                    <a href='delete_dept.php?id={$row['dept_id']}' class='btn btn-sm btn-danger'>Delete</a>
                                </td>
                            </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No records found</td></tr>";
                }
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
<?php include '../footer.php'; ?>