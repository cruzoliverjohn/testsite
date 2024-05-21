<?php
// Include your database connection file
require_once('db_connection.php');

// Function to delete unmatched student IDs from the database
function deleteUnmatchedStudents($pdo, $studentIDs) {
    // Prepare the DELETE query
    $numStudentIDs = count($studentIDs);
    if ($numStudentIDs > 0) {
        $placeholders = rtrim(str_repeat('?,', $numStudentIDs), ',');
        $stmt = $pdo->prepare("DELETE FROM tbl_students WHERE studentID NOT IN ($placeholders)");
        // Bind parameters
        for ($i = 0; $i < $numStudentIDs; $i++) {
            $stmt->bindParam($i + 1, $studentIDs[$i]);
        }
        // Execute the DELETE statement
        $stmt->execute();
        echo "DELETE statement executed successfully.";
    } else {
        echo "No student IDs to delete.";
    }
}

// Function to delete all student records from the database (for testing purposes)
function deleteAllStudents($pdo) {
    $stmt = $pdo->prepare("DELETE FROM tbl_students");
    $stmt->execute();
    echo "All student records deleted successfully.";
}

// File upload handling
if(isset($_FILES['studentsFile'])){
    $file = $_FILES['studentsFile'];

    // Check if file is uploaded successfully
    if($file['error'] === UPLOAD_ERR_OK){
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];

        // Check if file is CSV
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        if($fileExt == 'csv'){
            // Read CSV file
            $fileHandle = fopen($fileTmpName, 'r');
            if($fileHandle){
                // Initialize an array to store student IDs from the CSV file
                $csvStudentIDs = array();
                // Read each row of the CSV file
                while(($row = fgetcsv($fileHandle)) !== false){
                    // Extract student ID from the current row
                    $studentID = $row[0];
                    // Add student ID to the array
                    $csvStudentIDs[] = $studentID;
                }
                // Close the CSV file handle
                fclose($fileHandle);
                // Retrieve all existing studentIDs from the database
                $stmt = $pdo->query("SELECT studentID FROM tbl_students");
                $existingStudentIDs = $stmt->fetchAll(PDO::FETCH_COLUMN);
                // Identify student IDs that are not in the CSV file
                $studentIDsToDelete = array_diff($existingStudentIDs, $csvStudentIDs);
                // Delete unmatched student IDs from the database
                deleteUnmatchedStudents($pdo, $studentIDsToDelete);
            } else {
                echo "<script>alert('Failed to import csv.');</script>";
                echo "<script>window.location.href = '../admin_import.php';</script>";
            }
        } else {
            echo "<script>alert('Please upload csv file.');</script>";
            echo "<script>window.location.href = '../admin_import.php';</script>";
        }
    } else {
        echo "<script> alert('Error uploading file: " . $file['error'] . "');</script>";
        echo "<script> window.location.href = '../admin_import.php';</script>";
    }
} else {
    echo "<script>";
    echo "alert('File Not Uploaded.');";
    echo "window.location.href = '../admin_import.php';";
    echo "</script>";
}

// Call the deleteAllStudents function to delete all student records (for testing purposes)
deleteAllStudents($pdo);

// Close database connection
$pdo = null;
?>
