<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin - Faculty Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/admin_view_faculty.css">
</head>
<body>
    <div class="wrapper">
        <?php
            include("sidebars/admin_faculty_sidebar.php")
        ?>
        <!-- MAIN CONTENT -->
        <section id="main-content">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12">
                        <h1 class="dashboard-title">Faculty Records</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Faculty Records</li>
                            </ol>
                        </nav>

                        <?php
                            include_once("includes/db_connection.php");
                           
                            // Fetch distinct departments
                            $stmt_departments = $pdo->query("SELECT DISTINCT Department FROM tbl_faculty");
                            $departments = $stmt_departments->fetchAll(PDO::FETCH_ASSOC);

                            // Fetch faculty records
                            $stmt_faculty = $pdo->query("SELECT * FROM tbl_faculty");
                            $faculty = $stmt_faculty->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="department" class="form-label">Filter by Department:</label>
                                <select class="form-select" id="department" onchange="filterAndSearchFaculty()">
                                    <option value="">All Departments</option>
                                    <?php foreach ($departments as $dept): ?>
                                        <option value="<?php echo $dept['Department']; ?>"><?php echo $dept['Department']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="searchInput" class="form-label">Search by Faculty ID:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="facultySearchInput" placeholder="Enter Faculty ID...">
                                </div>
                            </div>
                        </div>

                        <div class="table-container">
                            <table id="facultyTable" class="table-wrapper">
                                <thead>
                                    <tr>
                                        <th>Faculty ID</th>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Ext</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                        <th>Department</th>
                                        <th>Academic Year</th>
                                        <th>Semester</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($faculty as $faculty): ?>
                                        <tr class="table-row" data-department="<?php echo $faculty['department']; ?>" onclick="window.location.href='admin_faculty_details.php?facultyID=<?php echo $faculty['facultyID']; ?>'">
                                            <td><?php echo $faculty['facultyID']; ?></td>
                                            <td><?php echo $faculty['lastName']; ?></td>
                                            <td><?php echo $faculty['firstName']; ?></td>
                                            <td><?php echo $faculty['middleName']; ?></td>
                                            <td><?php echo $faculty['extensions']; ?></td>
                                            <td><?php echo $faculty['age']; ?></td>
                                            <td><?php echo $faculty['sex']; ?></td>
                                            <td><?php echo $faculty['email']; ?></td>
                                            <td><?php echo $faculty['contactNumber']; ?></td>
                                            <td><?php echo $faculty['department']; ?></td>
                                            <td><?php echo $faculty['academicYear']; ?></td>
                                            <td><?php echo $faculty['semester']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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
    <script src="JS/admin_view_faculty.js"></script>   
    <script>
    function filterAndSearchFaculty() {
        var selectedDepartment = document.getElementById("department").value.toUpperCase();
        var input, filter, tableRows, department, facultyID, i;
        input = document.getElementById("facultySearchInput");
        filter = input.value.trim().toUpperCase();
        tableRows = document.querySelectorAll("#facultyTable tbody tr");

        for (i = 0; i < tableRows.length; i++) {
            department = tableRows[i].getElementsByTagName("td")[9].innerText.toUpperCase();
            facultyID = tableRows[i].getElementsByTagName("td")[0].innerText.toUpperCase();
            if ((selectedDepartment === '' || department === selectedDepartment) && facultyID.indexOf(filter) > -1) {
                tableRows[i].style.display = "";
            } else {
                tableRows[i].style.display = "none";
            }
        }
    }

    document.getElementById("department").addEventListener("change", filterAndSearchFaculty);
    document.getElementById("facultySearchInput").addEventListener("input", filterAndSearchFaculty);
</script>


</body>
</html>
