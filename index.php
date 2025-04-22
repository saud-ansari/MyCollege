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
    </style>
</head>

<body>
    <?php include "header.php";?>
    <!-- Header -->
    <header class="text-center bg-warning text-white py-5">
        <h1 class="display-3 pt-5 mb-3">Welcome to <span class="text-dark">MyCollege</span></h1>
        <p class="container lead mb-4">
            Empowering students with quality education, innovative learning, and a future full of possibilities. Discover courses, engage in campus life, and shape your tomorrow with us.
        </p>
        <button class="btn btn-dark btn-lg">Explore</button>
    </header>

    <!-- First Grid -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <!-- Text Column -->
                <div class="col-lg-8">
                    <h1 class="mb-4">About <span class="text-warning">MyCollege</span></h1>
                    <p class="lead mb-3">
                        MyCollege is a premier educational institution dedicated to nurturing academic excellence, leadership, and innovation. With a strong commitment to holistic learning, we offer state-of-the-art infrastructure, experienced faculty, and diverse programs in Science, Commerce, Arts, and Technology.
                    </p>
                    <p class="text-muted">
                        Our goal is to equip students with knowledge, values, and practical skills to thrive in a competitive world.
                        We believe in fostering a vibrant campus culture that encourages creativity, collaboration, and personal growth.
                        Join us in shaping a brighter future through education and empowerment.
                    </p>
                </div>

                <!-- Icon Column -->
                <div class="col-lg-4 text-center">
                    <div class="bg-secondary text-white p-4 rounded shadow-sm">
                        <i class="fas fa-university fa-5x text-warning mb-3"></i>
                        <h5 class="mt-2">Empowering Education</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Second Grid -->
    <section class="bg-dark text-warning py-5">
        <div class="container">
            <h1 class="mb-4">Campus Life & Academics</h1>

            <div class="row row-cols-1 row-cols-md-2 g-4">
                <!-- Departments Card -->
                <div class="col bg">
                    <div class="card h-100 shadow-sm bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Departments</h5>
                            <p class="card-text">
                                We offer a wide range of undergraduate and postgraduate programs across departments like Computer Science, Management Studies, Humanities, and Life Sciences.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Research & Innovation Card -->
                <div class="col">
                    <div class="card h-100 shadow-sm bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Research & Innovation</h5>
                            <p class="card-text">
                                Encouraging curiosity and critical thinking through projects, workshops, and hands-on research experiences.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Clubs & Activities Card -->
                <div class="col">
                    <div class="card h-100 shadow-sm bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Clubs & Activities</h5>
                            <p class="card-text">
                                From coding clubs to drama societies, MyCollege ensures students grow not just academically but socially and creatively.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Career Services Card -->
                <div class="col">
                    <div class="card h-100 shadow-sm bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Career Services</h5>
                            <p class="card-text">
                                Our placement cell, internships, and training programs connect students to real-world opportunities.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Quote Section -->
    <section class="quote-section text-center py-5 bg-light">
        <div class="container">
            <i class="fas fa-quote-left fa-2x text-warning mb-3"></i>
            <h3 class="display-6 fw-semibold">
                "Education is the most powerful weapon which you can use to change the world."
            </h3>
            <p class="lead mt-3 text-muted">– Nelson Mandela</p>
        </div>
    </section>

<?php include "footer.php"?>