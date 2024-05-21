<?php
// Include the database connection file
require_once('db_connection.php');

// Check if the violationID is provided in the URL
if (isset($_GET['violationID'])) {
    // Sanitize the input to prevent SQL injection
    $violationID = htmlspecialchars($_GET['violationID']);

    try {
        // Prepare a delete statement
        $stmt = $pdo->prepare("DELETE FROM tbl_violations WHERE violationID = ?");
        
        // Bind the parameter
        $stmt->bindParam(1, $violationID);
        
        // Execute the statement
        $stmt->execute();

        // Display an alert message using JavaScript and redirect back to the violation management page
        echo "<script>alert('Violation successfully deleted.'); window.location.href = '../admin_manage_violation.php';</script>";
        exit();
    } catch (PDOException $e) {
        // If an error occurs, display an alert message using JavaScript and redirect back to the violation management page
        echo "<script>alert('Error: Failed to delete violation.'); window.location.href = '../admin_manage_violation.php';</script>";
        exit();
    }
} else {
    // If the violationID is not provided, display an alert message using JavaScript and redirect back to the violation management page
    echo "<script>alert('Error: Violation ID not provided.'); window.location.href = '../admin_manage_violation.php';</script>";
    exit();
}
?>
