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
    <link rel="stylesheet" href="CSS/admin_academic_year.css">
</head>
<body>
    <div class="wrapper">
        <?php include("sidebars/admin_academicyear_sidebar.php"); ?>

        <!-- MAIN CONTENT HEADER -->
        <section id="main-content">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12">
                        <h1 class="dashboard-title">Academic Year & Semester</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Selection</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- MAIN CONTENT HEADER -->
                <div class="row">
                    <div class="md-6 mb-4">
                        <form id="updateForm" action="includes/admin_selected_year.php" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="academicYear" class="form-label">Academic Year:</label>
                                    <select id="academicYear" name="academicYear" class="form-select" required>
                                        <option value="" selected disabled hidden>Select Academic Year</option>
                                        <?php
                                        include 'includes/db_connection.php';
                                            $stmt = $pdo->query("SELECT DISTINCT academicYear FROM tbl_admin_students_copy");
                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                $academicYear = $row['academicYear'];
                                                list($startYear, $endYear) = explode("-", $academicYear);
                                                echo "<option value='$academicYear'>$startYear-$endYear</option>";
                                            }
                                        ?>
                                    </select>

                                </div>
                                <div class="col-md-6">
                                    <label for="semester" class="form-label">Semester:</label>
                                    <select id="semester" name="semester" class="form-select">
                                        <option value="" selected disabled>Select Semester</option>    
                                        <option value="1st">1st Semester</option>
                                        <option value="2nd">2nd Semester</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="button" class="btn btn-custom" id="confirmButton" data-bs-toggle="modal" data-bs-target="#confirmationModal">Confirm</button>
                                </div>
                            </div>
                            <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmationModalLabel">Confirm Selection</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p id="confirmationMessage"></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <input type="submit" class="btn btn-custom" id="okButton" value="Submit">
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

   
    <script src="JS\admin_view_students.js"></script>
    <script src="https://kit.fontawesome.com/3b2e9f2e5b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        document.getElementById('confirmButton').addEventListener('click', function() {
            const academicYearSelect = document.getElementById('academicYear');
            const semesterSelect = document.getElementById('semester');

            const selectedAcademicYear = academicYearSelect.value;
            const selectedSemester = semesterSelect.value;

            document.getElementById('confirmationMessage').innerText = `Are you sure you want to go to ${selectedAcademicYear} + (${selectedSemester}) Semester?`;
        });

        document.getElementById('okButton').addEventListener('click', function() {
            document.getElementById('updateForm').submit();
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the select elements
        const academicYearSelect = document.getElementById('academicYear');
        const semesterSelect = document.getElementById('semester');
        const confirmButton = document.getElementById('confirmButton');

        // Function to enable/disable the confirm button based on field values
        function checkFields() {
            if (academicYearSelect.value !== '' && semesterSelect.value !== '') {
                confirmButton.disabled = false;
            } else {
                confirmButton.disabled = true;
            }
        }

        // Event listeners to check fields on change
        academicYearSelect.addEventListener('change', checkFields);
        semesterSelect.addEventListener('change', checkFields);

        // Initial check on page load
        checkFields();
    });
</script>

</body>
</html>