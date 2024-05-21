<?php 
    session_start();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Admin - Import</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="CSS/admin_importFinal.css">
        <link rel="stylesheet" href="CSS/admin_buttons.css">
    </head>
    <body>
        <div class="wrapper">
            <?php include("sidebars/admin_import_sidebar.php"); ?>
            <!-- MAIN CONTENT HEADER -->
            <section id="main-content">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="dashboard-title">Import</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Import</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- MAIN CONTENT HEADER -->
                    <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Import Students
                            </div>
                            <div class="card-body">
                                <form id="importStudentsForm" action="includes/import_students.php" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="studentsFile" class="form-label">Choose CSV file to import:</label>
                                        <input type="file" class="form-control" id="studentsFile" name="studentsFile" accept=".csv" required>
                                    </div>
                                    <button type="submit" class="btn btn-custom">Import Students</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Import Faculty
                            </div>
                            <div class="card-body">
                                <form id="importFacultyForm" action="includes/import_faculty.php" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="facultyFile" class="form-label">Choose CSV file to import:</label>
                                        <input type="file" class="form-control" id="facultyFile" name="facultyFile" accept=".csv" required>
                                    </div>
                                    <button type="submit" class="btn btn-custom">Import Faculty</button>
                                </form>
                            </div>
                        </div>
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
    </body>
    </html>
