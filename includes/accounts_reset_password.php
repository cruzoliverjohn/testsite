<?php
include_once("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST['userID'];

    $stmt = $pdo->prepare("SELECT userName FROM tbl_accounts WHERE userID = ?");
    $stmt->execute([$userID]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    $userName = $userData['userName'];
    $lastName = explode(" ", $userName);
    $lastName = end($lastName);

    $newPassword = password_hash($lastName, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE tbl_accounts SET userPassword = ? WHERE userID = ?");
    $stmt->execute([$newPassword, $userID]);

    echo "<script>alert('Password changed successfully!'); window.location.href = '../admin_user_details.php?userID=$userID&passwordChanged=true';</script>";
    exit();
}
?>
