<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin - Archive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/admin_export.css">
</head>
<body>
    <div class="wrapper">
        <?php include("sidebars/admin_export_sidebar.php"); ?>
        <!-- MAIN CONTENT HEADER -->
        <section id="main-content">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12">
                        <h1 class="dashboard-title">Archive</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Archive</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- MAIN CONTENT HEADER -->
                <div class="row">
                    <div class="col-12">
                        <form id="exportForm" action="includes/admin_export_data.php" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="academicYear" class="form-label">Academic Year:</label>
                                    <select id="academicYear" name="academicYear" class="form-select" required>
                                    <option value="" selected disabled hidden>Select Academic Year </option>
                                        <?php
                                            include_once("includes/db_connection.php");
                                            $stmt = $pdo->query("SELECT DISTINCT academicYear FROM tbl_admin_students_copy");
                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                echo '<option value="' . $row['academicYear'] . '">' . $row['academicYear'] . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="semester" class="form-label">Semester:</label>
                                    <select id="semester" name="semester" class="form-select" required>
                                    <option value="" selected disabled hidden>Select Semester </option>
                                        <?php
                                            $stmt = $pdo->query("SELECT DISTINCT semester FROM tbl_admin_students_copy");
                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                echo '<option value="' . $row['semester'] . '">' . $row['semester'] . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#exportModal">
                                        Archive Data
                                    </button>
                                </div>
                            </div>
                            <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exportModalLabel">Confirm Export</h5>
                                            
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure to export <span id="selectedAcademicYear"></span> <span id="selectedSemester"></span> semester?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-custom" form="exportForm">Export</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    

    <script>
        document.getElementById('exportModal').addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var academicYear = document.getElementById('academicYear').value;
            var semester = document.getElementById('semester').value;
            document.getElementById('selectedAcademicYear').textContent = academicYear;
            document.getElementById('selectedSemester').textContent = semester;
        });
    </script>
    <script src="JS\admin_view_students.js"></script>
    <script src="https://kit.fontawesome.com/3b2e9f2e5b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>
