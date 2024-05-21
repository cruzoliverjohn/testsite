<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin - Violation Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/admin_violations.css">
    <link rel="stylesheet" href="CSS/admin_title.css">

</head>
<body>
    <div class="wrapper">
        <?php
            include("sidebars/admin_violation_sidebar.php");
            include_once("includes/db_connection.php");

            $stmt = $pdo->query("SELECT * FROM tbl_violations");
            $violations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <!-- MAIN CONTENT -->
        <section id="main-content">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12">
                        <h1 class="dashboard-title">Violation Management</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Violation Management</li>
                            </ol>
                        </nav>

                        <!-- VIOLATION LIST -->
                        <div class="table-container">
                            <table class="table-wrapper">
                                <thead>
                                    <tr>
                                        <th>Violation Name</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($violations as $violation): ?>
                                        <tr>
                                            <td><?php echo $violation['violationName']; ?></td>
                                            <td>
                                                <form action="includes/delete_violations.php" method="POST">
                                                    <input type="hidden" name="violationID" value="<?php echo $violation['violationID']; ?>">
                                                    <button type="button" class="btn btn-danger delete-violation-btn" data-bs-toggle="modal" data-bs-target="#deleteViolationModal" data-violation-id="<?php echo $violation['violationID']; ?>" data-violation-name="<?php echo $violation['violationName']; ?>">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addViolationModal">Add Violation</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<div class="modal fade" id="addViolationModal" tabindex="-1" aria-labelledby="addViolationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addViolationModalLabel"><b>Add Violation</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="includes/formhandler_addingToViolationList.php" method="POST">
                    <?php
                        $stmt_max_id = $pdo->query("SELECT MAX(violationID) AS max_id FROM tbl_violations");
                        $max_id_row = $stmt_max_id->fetch(PDO::FETCH_ASSOC);
                        $next_id = $max_id_row['max_id'] + 1;
                    ?>
                    <div class="mb-3">
                        <label for="violationID" class="form-label"><b>Violation ID - </b></label>
                        <label id="violationID" name="violationID"><?php echo $next_id; ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="violationName" class="form-label"><b>Violation Name</b></label>
                        <input type="text" class="form-control" id="violationName" name="violationName" required>
                    </div>
                    <button type="submit" class="btn btn-custom">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Delete Violation Modal -->
<div class="modal fade" id="deleteViolationModal" tabindex="-1" aria-labelledby="deleteViolationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteViolationModalLabel">Delete Violation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the violation <span id="deleteViolationName"></span>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteViolationBtn">Delete</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteViolationBtns = document.querySelectorAll(".delete-violation-btn");
        const deleteViolationModal = document.getElementById("deleteViolationModal");
        const deleteViolationName = document.getElementById("deleteViolationName");
        const confirmDeleteViolationBtn = document.getElementById("confirmDeleteViolationBtn");

        deleteViolationBtns.forEach(btn => {
            btn.addEventListener("click", function () {
                const violationID = this.getAttribute("data-violation-id");
                const violationName = this.getAttribute("data-violation-name");
                deleteViolationName.textContent = violationName;
                confirmDeleteViolationBtn.setAttribute("data-violation-id", violationID);
            });
        });

        confirmDeleteViolationBtn.addEventListener("click", function () {
    const violationID = this.getAttribute("data-violation-id");
    
    
    window.location.href = "includes/delete_violations.php?violationID=" + violationID;
});
        });
    
</script>

    <script src="https://kit.fontawesome.com/3b2e9f2e5b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="JS/admin_manage_Adding.js"></script>
</body>
</html>
