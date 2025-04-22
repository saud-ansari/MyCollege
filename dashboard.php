<?php include "config.php" ?>
<?php include "navbar.php" ?>
<div class="container mt-4">
    <h2>Dashboard</h2>
    <p>Here you can manage your college information.</p>

    <div class="mt-4 accordion" id="accordionFlushExample">

        <!-- User Accordion -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    User Management
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <p>Manage platform users such as Admin, Staff, and Students. Perform actions like Add, Update, Delete user profiles, and control their access rights.</p>
                    <a href="user/user_dhb.php" class="btn btn-primary">Manage Users</a>
                </div>
            </div>
        </div>

        <!-- Department Accordion -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Department Management
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <p>Organize your institution’s departments like Science, Commerce, Arts etc. Add new departments, assign department heads, and track their performance.</p>
                    <a href="department/dept_dhb.php" class="btn btn-warning">Manage Departments</a>
                </div>
            </div>
        </div>

        <!-- Faculty Accordion -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    Faculty Management
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <p>Manage faculty details including profile management, subjects assigned, attendance records, and performance evaluations.</p>
                    <a href="faculty/faculty_dhb.php" class="btn btn-danger">Manage Faculty</a>
                </div>
            </div>
        </div>

        <!-- Course Accordion -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                    Course Management
                </button>
            </h2>
            <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <p>Handle course-related information like course name, duration, syllabus, credits, and assigning faculty to specific courses.</p>
                    <a href="courses/course_dhb.php" class="btn btn-secondary">Manage Courses</a>
                </div>
            </div>
        </div>

        <!-- Student Accordion -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                    Student Management
                </button>
            </h2>
            <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <p>Maintain student records including registration, attendance, academic performance, and communication details.</p>
                    <a href="student/student_dhb.php" class="btn btn-success">Manage Students</a>
                </div>
            </div>
        </div>

    </div>

</div>

<?php include "footer.php"?>