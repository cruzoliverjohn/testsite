<?php

session_start();

include "includes/db_connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin - Accounts Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/admin_manageUsers.css">
    <link rel="stylesheet" href="CSS/admin_buttons.css">
    <link rel="stylesheet" href="CSS/admin_title.css">

</head>
<body>
    <div class="wrapper">
        <?php
            include("sidebars/admin_users_sidebar.php")
        ?>
        <!-- MAIN CONTENT -->
        <section id="main-content">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12">
                        <h1 class="dashboard-title">Accounts Management</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Accounts Management</li>
                            </ol>
                        </nav>

                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="userTypeFilter" class="form-label">Filter by User Type:</label>
                                <select class="form-select" id="userTypeFilter">
                                    <option value="">All</option>
                                    <?php
                                        $stmt = $pdo->query("SELECT DISTINCT userType FROM tbl_accounts");
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . strtolower($row['userType']) . '">' . $row['userType'] . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="userIdSearch" class="form-label">Search by User ID:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="userIdSearch" placeholder="Enter User ID">
                                  
                                </div>
                            </div>
                        </div>

                        <div class="table-container">
                            <table id="userTable" class="table-wrapper">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>User Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $stmt = $pdo->query("SELECT userID, userName, userType FROM tbl_accounts");

                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                        <tr onclick="window.location='admin_user_details.php?userID=<?php echo $row['userID']; ?>';" style="cursor:pointer;">
                                            <td><?php echo $row['userID']; ?></td>
                                            <td><?php echo $row['userName']; ?></td>
                                            <td><?php echo $row['userType']; ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-6 col-sm-12 mb-3">
                            <button type="button" class="btn btn-custom btn-block" data-bs-toggle="modal" data-bs-target="#createStudentFacultyModal">Create New Student & Faculty Accounts</button>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-custom btn-block" data-bs-toggle="modal" data-bs-target="#createPersonnelModal">Create Personnel Accounts</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-custom btn-block" data-bs-toggle="modal" data-bs-target="#createAdminModal">Create Admin Accounts</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="createAdminModal" tabindex="-1" aria-labelledby="createAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAdminModalLabel">Create Admin Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createAdminForm" action="includes/admin_create_admin_accounts.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                        <label for="adminUserID" class="form-label">User ID</label>
                        <input type="text" class="form-control" id="adminUserID" name="adminUserID" required oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);">
                        </div>
                        <div class="mb-3">
                            <label for="adminFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="adminFirstName" name="adminFirstName" required>
                        </div>
                        <div class="mb-3">
                            <label for="adminMiddleName" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="adminMiddleName" name="adminMiddleName">
                        </div>
                        <div class="mb-3">
                            <label for="adminLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="adminLastName" name="adminLastName" required>
                        </div>
                        <div class="mb-3">
                            <label for="adminPassword" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="adminPassword" name="adminPassword" required>
                                <button class="btn btn-custom" type="button" id="toggleAdminPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-custom">Create Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Create New Student & Faculty Accounts Modal -->
<div class="modal fade" id="createStudentFacultyModal" tabindex="-1" aria-labelledby="createStudentFacultyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createStudentFacultyModalLabel">Are you sure you want to create new accounts?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="includes/accounts_creator.php" method="POST">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-custom">Create Accounts</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <div class="modal fade" id="createPersonnelModal" tabindex="-1" aria-labelledby="createPersonnelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPersonnelModalLabel">Create Personnel Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createPersonnelForm" action="includes/admin_create_personnel_accounts.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="personnelUserID" class="form-label">User ID</label>
                            <input type="text" class="form-control" id="personnelUserID" name="personnelUserID" required oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);">
                        </div>
                        <div class="mb-3">
                            <label for="personnelFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="personnelFirstName" name="personnelFirstName" required>
                        </div>
                        <div class="mb-3">
                            <label for="personnelMiddleName" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="personnelMiddleName" name="personnelMiddleName">
                        </div>
                        <div class="mb-3">
                            <label for="personnelLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="personnelLastName" name="personnelLastName" required>
                        </div>
                        <div class="mb-3">
                            <label for="personnelUserPassword" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="personnelUserPassword" name="personnelUserPassword" required>
                                <button class="btn btn-custom" type="button" id="togglePersonnelPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="personnelUserType" class="form-label">User Type</label>
                            <select class="form-select" id="personnelUserType" name="personnelUserType" required>
                                <option value="OSAS">Osas</option>
                                <option value="ASSISTANT">Assistant</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-custom">Create Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="JS\admin_manage_users.js"></script>
    <script src="https://kit.fontawesome.com/3b2e9f2e5b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        document.getElementById("toggleAdminPassword").addEventListener("click", function() {
            const passwordInput = document.getElementById("adminPassword");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });
    </script>

    <script>
        document.getElementById("togglePersonnelPassword").addEventListener("click", function() {
            const passwordInput = document.getElementById("personnelUserPassword");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });
    </script>

    <script>
        document.getElementById("userTypeFilter").addEventListener("change", function() {
            const userType = this.value.toLowerCase();
            const rows = document.querySelectorAll("#userTable tbody tr");
            rows.forEach(row => {
                const type = row.querySelector("td:nth-child(3)").textContent.toLowerCase();
                if (userType === "" || type === userType) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
        });

        document.getElementById("userIdSearch").addEventListener("input", function() {
            const userId = this.value.trim();
            const userTypeFilter = document.getElementById("userTypeFilter").value.toLowerCase();
            const rows = document.querySelectorAll("#userTable tbody tr");
            
            rows.forEach(row => {
                const userIdCell = row.querySelector("td:first-child").textContent;
                const type = row.querySelector("td:nth-child(3)").textContent.toLowerCase();
                
                if ((userTypeFilter === "" || type === userTypeFilter) && userIdCell.startsWith(userId)) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
        });

        document.getElementById("searchButton").addEventListener("click", function() {
            const userId = document.getElementById("userIdSearch").value.trim();
            if (userId !== "") {
                window.location.href = "admin_user_details.php?userID=" + userId;
            }
        });
    </script>
</body>
</html>
