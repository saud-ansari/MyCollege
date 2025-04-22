<?php

include "../connection.php";
include "../config.php";

// PAGINATION LOGIC
$limit = 10; // records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch users for current page
$sql = "SELECT * FROM users LIMIT $offset, $limit";
$result = $conn->query($sql);

// Count total records for pagination
$total_query = $conn->query("SELECT COUNT(*) AS total FROM users");
$total_records = $total_query->fetch_assoc()['total'];
$total_pages = ceil($total_records / $limit);
?>

<?php include "../navbar.php"?>
    <div class="container mt-3">
        <h3 class="mt-1 alert alert-success">Welcome, <?php echo $_SESSION['name']; ?></h3>

        <div class="table-responsive my-3 p-4 shadow rounded-3">
            <a href="add_user.php" class="btn btn-success float-end">Add User</a>
            <h3 class="mt-2 text-center">User List</h3>

            <table class="table table-bordered table-hover table-sm my-3" style="min-width: 800px;">
                <thead class="table-success text-center">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $sr_no = $offset + 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                        <td>{$sr_no}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td class='text-center'>";
                            if ($row['role'] == 'Admin') echo "<span class='badge bg-danger'>Admin</span>";
                            else if ($row['role'] == 'Faculty') echo "<span class='badge bg-primary'>Faculty</span>";
                            else echo "<span class='badge bg-success'>Student</span>";
                            echo "</td>
                        <td class='text-center'>
                            <a href='update_user.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a> ";
                            if ($_SESSION['email'] != $row['email']) {
                                echo "<a href='delete_user.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
                            } else {
                                echo "<a href='#' class='btn btn-danger btn-sm disabled'>Delete</a>";
                            }
                            echo "</td></tr>";
                            $sr_no++;
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
<?php include "../footer.php"?>