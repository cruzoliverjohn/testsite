<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin - User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">      
    <link rel="stylesheet" href="CSS/admin_userDet.css">
    <link rel="stylesheet" href="CSS/admin_facultyDone.css">
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
                    <h1 class="dashboard-title">User Details</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="admin_manage_users.php">Accounts Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="details-wrapper">
            <div class="student-details-rectangle">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-4 mb-4 ">
                            <?php
                            include_once("includes/db_connection.php");

                            $userID = $_GET['userID'];

                            $stmt = $pdo->prepare("SELECT userType FROM tbl_accounts WHERE userID = ?");
                            $stmt->execute([$userID]);
                            $user = $stmt->fetch(PDO::FETCH_ASSOC);

                            if ($user) {
                                $userType = $user['userType'];
                                $name = "";

                                if (strpos($userType, 'Student') !== false) {
                                    $stmt = $pdo->prepare("SELECT CONCAT(FirstName, ' ', COALESCE(MiddleName, ''), ' ', SurName) AS Name FROM tbl_students WHERE studentID = ?");
                                } else if (strpos($userType, 'Faculty') !== false) {
                                    $stmt = $pdo->prepare("SELECT CONCAT(FirstName, ' ', COALESCE(MiddleName, ''), ' ', SurName) AS Name FROM tbl_faculty WHERE facultyID = ?");
                                }
                                $stmt->execute([$userID]);
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($result) {
                                    $name = isset($result['Name']) ? $result['Name'] : "";
                                }             
                            } else {
                                echo "User not found.";
                            }
                            ?>
                        </div>
                        <div class="col-md-8 mb-4 text-center"> <!-- PAAYOS LAYOUT -->
                        <div class="student-details">
                            <span style="color: #4B2450;"><strong><?php echo $name; ?></strong></span>
                            <p style="margin-bottom: 1px; margin-right: 200px;">User ID: <?php echo $userID; ?></p>
                            <p style="margin-bottom: 1px; margin-right: 200px;">Role: <?php echo $userType; ?></p>
                            <div class='row mt-3'>
                                <div class='col-auto'>
                                    <form id="resetPasswordForm" action="includes/accounts_reset_password.php" method="POST">
                                        <input type="hidden" name="userID" value="<?php echo $userID; ?>">
                                        <button type="button" class="btn btn-custom mt-2" data-bs-toggle="modal" data-bs-target="#resetPasswordModal">Reset Password</button>
                                    </form>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-auto">
                                    <form id="changeUserTypeForm" action="includes/admin_change_usertype.php" method="POST">
                                        <input type="hidden" name="userID" value="<?php echo $userID; ?>">
                                        <label for="resetUserType" class="form-label">Change Usertype</label>
                                        <select class="form-select" id="resetUserType" name="userType" required>
                                            <option value="0" selected disabled >Select User Type</option>
                                            <option value="ADMIN">Admin</option>
                                            <option value="OSAS">Osas</option>
                                            <option value="ASSISTANT">Assistant</option>
                                            <option value="FACULTY">Faculty</option>
                                            <option value="STUDENT">Student</option>
                                        </select>
                                        <button type="submit" class="btn btn-custom mt-2" id="changeUserTypeBtn" disabled>Change User Type</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!--MODAL FOR RESET-->
<!-- Modal HTML -->
<div id="resetPasswordModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to reset the password?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="resetPasswordForm" action="includes/accounts_reset_password.php" method="POST">
                    <input type="hidden" name="userID" value="<?php echo $userID; ?>">
                    <button type="submit" form="resetPasswordForm" class="btn btn-custom mt-2">Reset Password</button>
                </form>
               
            </div>
        </div>
    </div>
</div>

<script src="https://kit.fontawesome.com/3b2e9f2e5b.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script src="JS/admin_user_details.js"></script>
<script>
    
    const resetUserTypeSelect = document.getElementById('resetUserType');
    
    const changeUserTypeBtn = document.getElementById('changeUserTypeBtn');

    
    resetUserTypeSelect.addEventListener('change', function() {
    
        if (resetUserTypeSelect.value !== '0') {
            changeUserTypeBtn.disabled = false;
        } else {
            changeUserTypeBtn.disabled = true;
        }
    });
</script>
</script>
</body>
</html>
