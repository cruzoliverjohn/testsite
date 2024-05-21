<?php
// Include your database connection file
require_once('db_connection.php');

function insertIntoAdminStudentsCopy($pdo, $studentID, $academicYear, $semester, $firstName, $middleName, $lastName, $age, $sex, $email, $contactNumber, $course, $yearLevel, $extensions, $classifiedAs) {
    // Check if the record already exists
    $existingStmt = $pdo->prepare("SELECT * FROM tbl_admin_students_copy WHERE studentID = ? AND academicYear = ? AND semester = ?");
    $existingStmt->execute([$studentID, $academicYear, $semester]);
    $existingRecord = $existingStmt->fetch(PDO::FETCH_ASSOC);

    // If the record doesn't exist, insert a new record
    if (!$existingRecord) {
        $stmt = $pdo->prepare("INSERT INTO tbl_admin_students_copy (studentID, academicYear, semester, firstName, middleName, lastName, age, sex, email, contactNumber, course, yearLevel, extensions, classifiedAs) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$studentID, $academicYear, $semester, $firstName, $middleName, $lastName, $age, $sex, $email, $contactNumber, $course, $yearLevel, $extensions, $classifiedAs]);
    }
}

function deleteAllStudents($pdo) {
    $stmt = $pdo->prepare("DELETE FROM tbl_students");
    $stmt->execute();
    echo "All student records deleted successfully.<br>";
}

function updateSelectedYear($pdo) {
    // Select academicYear and semester from tbl_students
    $stmt = $pdo->prepare("SELECT academicYear, semester FROM tbl_students ORDER BY studentID DESC LIMIT 1");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $academicYear = $row['academicYear'];
        $semester = $row['semester'];

        // Update academicYear and semester in tbl_selectedyear
        $updateStmt = $pdo->prepare("UPDATE tbl_selectedyear SET academicYear = ?, semester = ? WHERE selectedID = '2'");
        $updateStmt->execute([$academicYear, $semester]);
        echo "Selected year updated successfully.<br>";
        echo "Fetched academicYear: $academicYear, semester: $semester<br>";
    } else {
        echo "No academic year and semester found in tbl_students.<br>";
    }
}

function checkExistingRecords($pdo, $tableName) {
    // Check if there are existing records in the specified table
    $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM $tableName");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $row['count'] > 0;
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
            // Check existing records in specified tables
            $complaintsExist = checkExistingRecords($pdo, 'tbl_complaints');
            $temporarypassesExist = checkExistingRecords($pdo, 'tbl_temporarypasses');
            $violationrecordsExist = checkExistingRecords($pdo, 'tbl_violationrecords');
            $conferencescheduleExist = checkExistingRecords($pdo, 'tbl_conferenceschedule');

            // If any of the specified tables has existing records, display alert and redirect back to admin_import.php
            if ($complaintsExist || $temporarypassesExist || $violationrecordsExist || $conferencescheduleExist) {
                echo "<script>alert('Existing records found in one or more tables. Insertion or deletion not allowed.');</script>";
                echo "<script>window.location.href = '../admin_import.php';</script>";
                exit(); // Exit to prevent further execution
            } else {
                // Delete all existing student records
                deleteAllStudents($pdo);

                // Read CSV file
                $fileHandle = fopen($fileTmpName, 'r');
                if($fileHandle){
                    $header = fgetcsv($fileHandle);  // Skip header row
                    while(($row = fgetcsv($fileHandle)) !== false){
                        // Extract data from CSV row
                        $studentID = $row[0];
                        $classifiedAs = $row[1];
                        $firstName = $row[2];
                        $middleName = $row[3];
                        $lastName = $row[4];
                        $extensions = $row[5];
                        $age = $row[6];
                        $sex = $row[7];
                        $email = $row[8];
                        $contactNumber = $row[9];
                        $course = $row[10];
                        $yearLevel = $row[11];
                        $academicYear = $row[12];
                        $semester = $row[13];

                        // Insert student record into tbl_students
                        $insertStmt = $pdo->prepare("INSERT INTO tbl_students (studentID, firstName, middleName, lastName, age, sex, email, contactNumber, course, yearLevel, academicYear, semester, extensions, classifiedAs) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $insertStmt->execute([$studentID, $firstName, $middleName, $lastName, $age, $sex, $email, $contactNumber, $course, $yearLevel, $academicYear, $semester, $extensions, $classifiedAs]);

                        // Insert student record into tbl_admin_students_copy
                        insertIntoAdminStudentsCopy($pdo, $studentID, $academicYear, $semester, $firstName, $middleName, $lastName, $age, $sex, $email, $contactNumber, $course, $yearLevel, $extensions, $classifiedAs);
                        
                    }

                    // Insert academicYear and semester into tbl_selectedyear
                
                    fclose($fileHandle);
                    updateSelectedYear($pdo);
                } else {
                   echo "<script>alert('Failed to import csv.');</script>";
                   echo "<script>window.location.href = '../admin_import.php';</script>";
                }
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

// Close database connection
$pdo = null;
?>
