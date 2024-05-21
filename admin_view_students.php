<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin - Student Records</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/admin_view_students.css">
</head>
<body>
    <?php include("sidebars/admin_students_sidebar.php")?>
    <div class="wrapper"> 
    <!-- MAIN CONTENT -->
    <section id="main-content">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    <h1 class="dashboard-title">Student Records</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Student Records</li>
                        </ol>
                    </nav>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="courseFilter" class="form-label">Filter by Course:</label>
                            <select id="courseFilter" class="form-select">
                                <option value="">All Courses</option>
                                <?php
                                include 'includes/db_connection.php';
                                    $stmt_selectedyear = $pdo->query("SELECT academicYear, semester FROM tbl_selectedyear WHERE selectedID = '1'");
                                    $selectedYear = $stmt_selectedyear->fetch(PDO::FETCH_ASSOC);

                                    if ($selectedYear) {
                                        $academicYear = $selectedYear['academicYear'];
                                        $semester = $selectedYear['semester'];

                                        $query = "SELECT DISTINCT course FROM tbl_admin_students_copy WHERE academicYear = ? AND semester = ?";
                                        $statement = $pdo->prepare($query);
                                        $statement->execute([$academicYear, $semester]);

                                        $courses = $statement->fetchAll(PDO::FETCH_ASSOC);
                                        
                                        foreach ($courses as $course) {
                                            echo "<option value=\"" . $course['course'] . "\">" . $course['course'] . "</option>";
                                        }
                                    }
                                    ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="studentIdSearch" class="form-label">Search by Student ID:</label>
                            <div class="input-group">
                                <input type="text" id="studentIdSearch" class="form-control" placeholder="Enter Student ID...">
                                
                            </div>
                        </div>
                    </div>
                    <div class="table-container">
                        <div class="table-wrapper">
                            <table id="studentTable">
                                <tr>
                                    <th>Student ID</th>
                                    <th>Status</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Extension</th>
                                    <th>Course</th>
                                    <th>Year Level</th>
                                    <th>Age</th>
                                    <th>Sex</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                    <th>Year Enrolled</th>
                                    <th>Semester</th>
                                </tr>
                                <?php
                                $stmt_selectedyear = $pdo->query("SELECT academicYear, semester FROM tbl_selectedyear WHERE selectedID ='1'");
                                $selectedYear = $stmt_selectedyear->fetch(PDO::FETCH_ASSOC);

                                if ($selectedYear) {
                                    $academicYear = $selectedYear['academicYear'];
                                    $semester = $selectedYear['semester'];

                                    $stmt_students = $pdo->prepare("SELECT * FROM tbl_admin_students_copy WHERE academicYear = ? AND semester = ?");
                                    $stmt_students->execute([$academicYear, $semester]);

                                    while ($student = $stmt_students->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr class='studentRow' onclick=\"window.location='admin_student_details.php?studentReference={$student['studentReference']}';\" style=\"cursor:pointer;\">";
                                        echo "<td>{$student['studentID']}</td>";
                                        echo "<td>{$student['classifiedAs']}</td>";
                                        echo "<td>{$student['lastName']}</td>";
                                        echo "<td>{$student['firstName']}</td>";
                                        echo "<td>{$student['middleName']}</td>";
                                        echo "<td>{$student['extensions']}</td>";
                                        echo "<td>{$student['course']}</td>";
                                        echo "<td>{$student['yearLevel']}</td>";
                                        echo "<td>{$student['age']}</td>";
                                        echo "<td>{$student['sex']}</td>";
                                        echo "<td>{$student['email']}</td>";
                                        echo "<td>{$student['contactNumber']}</td>";
                                        echo "<td>{$student['academicYear']}</td>";
                                        echo "<td>{$student['semester']}</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </table>
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
    <script>
        function filterStudents() {
        var input = document.getElementById('studentIdSearch').value.trim().toUpperCase();
        var selectedCourse = document.getElementById('courseFilter').value;
        var rows = document.getElementsByClassName('studentRow');

        for (var i = 0; i < rows.length; i++) {
            var course = rows[i].getElementsByTagName('td')[6].innerText.trim();
            var studentID = rows[i].getElementsByTagName('td')[0].innerText.toUpperCase();

            if ((studentID.includes(input) || input === '') && (selectedCourse === '' || course === selectedCourse)) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }

    document.getElementById('studentIdSearch').addEventListener('input', filterStudents);

    document.getElementById('courseFilter').addEventListener('change', filterStudents);

    window.addEventListener('load', filterStudents);
    </script>
</body>
</html>
