<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/admin_dashboard.css">
    <link rel="stylesheet" href="CSS/admin_responsiveDone.css">
</head>
<body>
    <div class="wrapper">
        <?php include 'includes/analytics_details.php'; ?>
        <?php include("sidebars/admin_dashboard_sidebar.php") ?>
        <!-- MAIN CONTENT -->
        <section id="main-content">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12">
                        <h1 class="dashboard-title">Admin Dashboard</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="admin_manage_users.php" class="card-link">
                            <div class="card text-center">
                                <div class="card-body">
                                    <i class="fa-solid fa-user"></i>
                                    <p class="card-title">User <br> Accounts</p>
                                    <h2 class="card-total"><?php echo getTotalAccounts(); ?></h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="admin_view_students.php" class="card-link">
                            <div class="card text-center">
                                <div class="card-body">
                                    <i class="fa-solid fa-user-graduate"></i>
                                    <p class="card-title">Student <br> Records</p>
                                    <h2 class="card-total"><?php echo getTotalStudents(); ?></h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="admin_view_faculty.php" class="card-link">
                            <div class="card text-center">
                                <div class="card-body">
                                    <i class="fa-solid fa-user-tie"></i>
                                    <p class="card-title">Faculty <br> Records</p>
                                    <h2 class="card-total"><?php echo getTotalFaculty(); ?></h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="admin_manage_violation.php" class="card-link">
                            <div class="card text-center">
                                <div class="card-body">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                    <p class="card-title">Violation <br> List</p>
                                    <h2 class="card-total"><?php echo getTotalViolations(); ?></h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="admin_manage_sanction.php" class="card-link">
                            <div class="card text-center">
                                <div class="card-body">
                                    <i class="fa-solid fa-gavel"></i>
                                    <p class="card-title">Sanction <br> List</p>
                                    <h2 class="card-total"><?php echo getTotalSanctions(); ?></h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="admin_academic_year.php" class="card-link">
                            <div class="card text-center">
                                <div class="card-body">
                                    <i class="fa-solid fa-calendar-week"></i>
                                    <p class="card-title">Academic Year & Semester</p>
                                    <h2 class="card-total small"><?php $academicYearAndSemester = getAcademicYearAndSemester(); echo $academicYearAndSemester['academicYear'] . "<br>" . " " . $academicYearAndSemester['semester']; ?></h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://kit.fontawesome.com/3b2e9f2e5b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="JS/admin_dashboard.js"></script>
</body>
</html>