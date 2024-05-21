<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin - Sanction Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/admin_sanctions.css">
    <link rel="stylesheet" href="CSS/admin_title.css">
</head>
<body>
    <div class="wrapper">
        <?php
        include("sidebars/admin_sanction_sidebar.php")
        ?>
        <!-- MAIN CONTENT -->
        <section id="main-content">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12">
                        <h1 class="dashboard-title">Sanction Management</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Sanction Management</li>
                            </ol>
                        </nav>
                        <?php
                        include_once("includes/db_connection.php");

                        $query = "SELECT sanctionID, sanctionName FROM tbl_sanctions";
                        $stmt = $pdo->query($query);
                        $sanctions = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <!-- SANCTION LIST -->
                        <div class="table-container">
                            <table class="table-wrapper">
                                <thead>
                                    <tr>
                                        <th>Sanction Name</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($sanctions as $sanction): ?>
                                        <tr>
                                            <td><?php echo $sanction['sanctionName']; ?></td>
                                            <td>
                                                <form action="includes/delete_sanctions.php" method="POST">
                                                    <input type="hidden" name="sanctionID" value="<?php echo $sanction['sanctionID']; ?>">
                                                    <button type="button" class="btn btn-danger delete-sanction-btn" data-bs-toggle="modal" data-bs-target="#deleteSanctionModal" data-sanction-id="<?php echo $sanction['sanctionID']; ?>" data-sanction-name="<?php echo $sanction['sanctionName']; ?>">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addSanctionModal">Add Sanction</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="addSanctionModal" tabindex="-1" aria-labelledby="addSanctionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSanctionModalLabel"><b>Add Sanction</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="includes/formhandler_addingToSanctionList.php" method="POST">
                        <?php
                        $stmt_max_id = $pdo->query("SELECT MAX(sanctionID) AS max_id FROM tbl_sanctions");
                        $max_id_row = $stmt_max_id->fetch(PDO::FETCH_ASSOC);
                        $next_id = $max_id_row['max_id'] + 1;
                        ?>
                        <div class="mb-3">
                            <label for="sanctionID" class="form-label"><b>Sanction ID - </b></label>
                            <label id="sanctionID" name="sanctionID"><?php echo $next_id; ?></label>
                        </div>
                        <div class="mb-3">
                            <label for="sanctionName" class="form-label"><b>Sanction Name</b></label>
                            <input type="text" class="form-control" id="sanctionName" name="sanctionName" required>
                        </div>
                        <button type="submit" class="btn btn-custom">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Delete Sanction Modal -->
<div class="modal fade" id="deleteSanctionModal" tabindex="-1" aria-labelledby="deleteSanctionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSanctionModalLabel">Delete Sanction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the sanction <span id="deleteSanctionName"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteSanctionBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/3b2e9f2e5b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="JS/admin_manage_Adding.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const deleteSanctionBtns = document.querySelectorAll(".delete-sanction-btn");
            const deleteSanctionModal = document.getElementById("deleteSanctionModal");
            const deleteSanctionName = document.getElementById("deleteSanctionName");
            const confirmDeleteSanctionBtn = document.getElementById("confirmDeleteSanctionBtn");

            deleteSanctionBtns.forEach(btn => {
                btn.addEventListener("click", function () {
                    const sanctionID = this.getAttribute("data-sanction-id");
                    const sanctionName = this.getAttribute("data-sanction-name");
                    deleteSanctionName.textContent = sanctionName;
                    confirmDeleteSanctionBtn.setAttribute("data-sanction-id", sanctionID);
                });
            });

            confirmDeleteSanctionBtn.addEventListener("click", function () {
                const sanctionID = this.getAttribute("data-sanction-id");
                
                
                window.location.href = "includes/delete_sanctions.php?sanctionID=" + sanctionID;
            });
        });
    </script>
</body>
</html>