<?php
// Include your database connection file
require_once('db_connection.php');

// Check if the sanctionID is provided in the URL parameters
if (isset($_GET['sanctionID'])) {
    // Sanitize the input to prevent SQL injection
    $sanctionID = htmlspecialchars($_GET['sanctionID']);

    try {
        // Prepare a delete statement
        $stmt = $pdo->prepare("DELETE FROM tbl_sanctions WHERE sanctionID = ?");
        
        // Bind the parameter
        $stmt->bindParam(1, $sanctionID);
        
        // Execute the statement
        $stmt->execute();

        // Display an alert message using JavaScript
        echo "<script>alert('Sanction successfully deleted.'); window.location.href = '../admin_manage_sanction.php';</script>";
        exit();
    } catch (PDOException $e) {
        // If an error occurs, display an alert message using JavaScript
        echo "<script>alert('Error: Failed to delete sanction.'); window.location.href = '../admin_manage_sanction.php';</script>";
        exit();
    }
} else {
    // If 'sanctionID' is not provided in the URL parameters, redirect back to the page
    header("Location: ../admin_manage_sanction.php");
    exit();
}
?>
