<?php
include_once("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['academicYear']) && isset($_POST['semester'])) {
        $academicYear = htmlspecialchars($_POST['academicYear']);
        $semester = htmlspecialchars($_POST['semester']);

        $stmt = $pdo->prepare("UPDATE tbl_selectedyear SET academicYear = ?, semester = ? WHERE selectedID = '1'");
        $stmt->execute([$academicYear, $semester]);

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Academic year and semester updated successfully.'); window.location.href = '../admin_dashboard.php?success=1';</script>";
            exit();
        } else {
            echo "<script>alert('Error: Failed to update academic year and semester.'); window.location.href = '../admin_dashboard.php?error=1';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Error: Academic year and semester not provided.'); window.location.href = '../admin_dashboard.php?error=2';</script>";
        exit();
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href = '../admin_dashboard.php';</script>";
    exit();
}
?>
