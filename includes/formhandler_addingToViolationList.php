<?php
require_once("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['violationName'])) {
        $newViolation = $_POST['violationName'];

        $newViolationLower = strtolower($newViolation);

        $queryCheck = "SELECT COUNT(*) AS count FROM tbl_violations WHERE LOWER(violationName) = :newViolationLower";
        $stmtCheck = $pdo->prepare($queryCheck);
        $stmtCheck->bindParam(":newViolationLower", $newViolationLower);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($resultCheck['count'] == 0) {
            $queryInsert = "INSERT INTO tbl_violations (violationName) VALUES (:newViolation)";
            $stmtInsert = $pdo->prepare($queryInsert);
            $stmtInsert->bindParam(":newViolation", $newViolation);
            
            try {
                $stmtInsert->execute();
                echo '<script>alert("Violation added successfully!"); window.location.href = "../admin_manage_violation.php";</script>';
                exit;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo '<script>alert("Violation already exists!"); window.location.href = "../admin_manage_violation.php";</script>';
            exit;
        }
    } else {
        echo '<script>alert("Violation name not provided."); window.location.href = "../admin_manage_violation.php";</script>';
        exit;
    }
}
?>
