<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin - Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/admin_studentDet.css">
</head>
<body>
    <div class="wrapper d-flex flex-column flex-md-row">
        <?php include("sidebars/admin_students_sidebar.php"); ?>
        <!-- MAIN CONTENT -->
        <section id="main-content" class="flex-grow-1">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12">
                        <h1 class="dashboard-title">Student Details</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="admin_view_students.php">Student Records</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Student Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card p-4 bg-white shadow rounded violet-line">
                            <div class="card-body">
                                <?php
                                    include_once("includes/db_connection.php");

                                    if (isset($_GET['studentReference'])) {
                                        $StudentID = $_GET['studentReference'];

                                        $stmt = $pdo->prepare("SELECT * FROM tbl_admin_students_copy WHERE studentReference = ?");
                                        $stmt->execute([$StudentID]);

                                        $studentDetails = $stmt->fetch(PDO::FETCH_ASSOC);

                                        if ($studentDetails) {
                                            echo '<div class="profile-details-container d-flex flex-column flex-md-row align-items-center">';
                                            
                                            if (!empty($studentDetails['profilePicture'])) {
                                                $imageData = base64_encode($studentDetails['profilePicture']);
                                                $src = 'data:image/jpeg;base64,'.$imageData;
                                                echo '<div class="profile-picture-container"><img src="' . $src . '" alt="Profile Picture" class="img-fluid rounded-circle"></div>';
                                            }

                                            echo '<div class="student-details mt-3 mt-md-0 ms-md-4 text-center text-md-start">';
                                            echo '<h5 style="color: #4B2450;"><strong>' . $studentDetails['firstName'] . ' ' . $studentDetails['middleName'] . ' ' . $studentDetails['lastName'] . ' ' . $studentDetails['extensions'] . '</strong></h5>';
                                            echo '<p>' .  $studentDetails['yearLevel'] . " - " . $studentDetails['course'] . '</p>';
                                            echo '</div>'; 
                                            echo '</div>'; 

                                            echo '<div class="other-details-container mt-4">';
                                            echo '<p><strong>Student ID:</strong> ' . $studentDetails['studentID'] . '</p>';
                                            echo '<p><strong>Classified As:</strong> ' . $studentDetails['classifiedAs'] . ' Student</p>';
                                            echo '<p><strong>Age:</strong> ' . $studentDetails['age'] . '</p>';
                                            echo '<p><strong>Sex:</strong> ' . $studentDetails['sex'] . '</p>';
                                            echo '<p><strong>Phone:</strong> ' . $studentDetails['contactNumber'] . '</p>';
                                            echo '<p><strong>Email:</strong> ' . $studentDetails['email'] . '</p>';
                                            echo '<p><strong>Year Enrolled:</strong> ' . $studentDetails['academicYear'] . '</p>';
                                            echo '<p><strong>Semester:</strong> ' . $studentDetails['semester'] . '</p>';
                                            echo '</div>'; 
                                        } else {
                                            echo '<p>Student not found.</p>';
                                        }

                                        $stmt->closeCursor();
                                    } else {
                                        echo '<p>Invalid request. Please provide a student ID.</p>';
                                    }

                                    $pdo = null;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>   
    <script src="https://kit.fontawesome.com/3b2e9f2e5b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="JS/admin_student_details.js"></script>
</body>
</html>
