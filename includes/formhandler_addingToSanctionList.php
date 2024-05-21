<?php
require_once("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['sanctionName'])) {
        $newSanctionName = $_POST['sanctionName'];

        // Convert the sanction name to lowercase for case-insensitive comparison
        $newSanctionNameLower = strtolower($newSanctionName);

        // Check if the sanction name already exists
        $queryCheck = "SELECT COUNT(*) AS count FROM tbl_sanctions WHERE LOWER(sanctionName) = :newSanctionNameLower";
        $stmtCheck = $pdo->prepare($queryCheck);
        $stmtCheck->bindParam(":newSanctionNameLower", $newSanctionNameLower);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($resultCheck['count'] == 0) {
            // Insert the new sanction
            $queryInsert = "INSERT INTO tbl_sanctions (sanctionName) VALUES (:newSanctionName)";
            $stmtInsert = $pdo->prepare($queryInsert);
            $stmtInsert->bindParam(":newSanctionName", $newSanctionName);
            
            try {
                $stmtInsert->execute();
                // Display success message as an alert
                echo '<script>alert("Sanction added successfully!"); window.location.href = "../admin_manage_sanction.php";</script>';
                exit; // Stop further execution after redirect
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            // Display error message as an alert
            echo '<script>alert("Sanction already exists!"); window.location.href = "../admin_manage_sanction.php";</script>';
            exit; // Stop further execution after redirect
        }
    } else {
        // Display error message as an alert
        echo '<script>alert("Sanction name not provided."); window.location.href = "../admin_manage_sanction.php";</script>';
        exit; // Stop further execution after redirect
    }
}
?>
