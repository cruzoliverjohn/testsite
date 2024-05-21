<?php
    session_start();
    
    include_once("db_connection.php");

    if(isset($_POST['userID']) && isset($_POST['userType'])) {
        $userID = filter_var($_POST['userID'], FILTER_SANITIZE_STRING);
        $userType = filter_var($_POST['userType'], FILTER_SANITIZE_STRING);


        $stmt = $pdo->prepare("UPDATE tbl_accounts SET userType = ? WHERE userID = ?");
        if($stmt->execute([$userType, $userID])) {
            echo "<script>alert('User type updated successfully.');</script>";
        } else {
            echo "<script>alert('Failed to update user type.');</script>";
        }
    } else {
        header("Location: ../admin_manage_users.php");
        exit();
    }

    echo "<script>window.location.href = '../admin_user_details.php?userID=$userID';</script>";
?>
