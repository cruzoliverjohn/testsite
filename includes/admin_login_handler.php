<?php
include "db_connection.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("SELECT * FROM tbl_accounts WHERE userID = ? AND userType = 'ADMIN'");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
 
    if ($user) {
        if (password_verify($password, $user['userPassword'])) {
            $stmt_name = $pdo->prepare("SELECT userName FROM tbl_accounts WHERE userID = ?");
            $stmt_name->execute([$username]);
            $full_name = $stmt_name->fetchColumn();

            $_SESSION['user_name'] = $full_name;
            $_SESSION['user_id'] = $user['userID'];
            $_SESSION['user_type'] = $user['userType'];

            header("Location: ../admin_dashboard.php");
            exit();
        } else {
            echo '<script>alert("Incorrect password."); window.location.href = "../index.php";</script>';
            exit();
        }
    } else {
        echo '<script>alert("User not found or is not an admin."); window.location.href = "../index.php";</script>';
        exit();
    }
}
?>
