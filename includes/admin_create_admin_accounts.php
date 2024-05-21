<?php
include_once("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST['adminUserID'];
    $adminFirstName = $_POST['adminFirstName'];
    $adminMiddleName = $_POST['adminMiddleName'];
    $adminLastName = $_POST['adminLastName'];
    $userPassword = $_POST['adminPassword'];
    $userType = "ADMIN";

    $fullName = ucwords("$adminFirstName $adminMiddleName $adminLastName");

    $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

    $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM tbl_accounts WHERE userID = ?");
    $stmt_check->execute([$userID]);
    $count = $stmt_check->fetchColumn();

    if ($count > 0) {
        echo '<script>alert("User ID already exists."); window.location.href = "../admin_manage_users.php";</script>';
    } else {
        $stmt_insert = $pdo->prepare("INSERT INTO tbl_accounts (userID, userName, userPassword, userType) VALUES (?, ?, ?, ?)");
        if ($stmt_insert->execute([$userID, $fullName, $hashedPassword, $userType])) {
            echo '<script>alert("Admin account created successfully."); window.location.href = "../admin_manage_users.php";</script>';
        } else {
            echo '<script>alert("Error creating admin account."); window.location.href = "../admin_manage_users.php";</script>';
        }
    }
}
?>
