<?php
// Include your database connection file
require_once('db_connection.php');

// Function to insert or update a faculty record into the database
function insertOrUpdateFaculty($pdo, $facultyID, $firstName, $middleName, $lastName, $department, $email, $contactNumber, $academicYear, $semester) {
    // Check if facultyID already exists
    $stmt_check = $pdo->prepare("SELECT * FROM tbl_faculty WHERE facultyID = ?");
    $stmt_check->execute([$facultyID]);
    $existingRecord = $stmt_check->fetch(PDO::FETCH_ASSOC);

    if ($existingRecord) {
        // Update existing record
        $stmt_update = $pdo->prepare("UPDATE tbl_faculty SET firstName = ?, middleName = ?, lastName = ?, department = ?, email = ?, contactNumber = ?, academicYear = ?, semester = ? WHERE facultyID = ?");
        $stmt_update->execute([$firstName, $middleName, $lastName, $department, $email, $contactNumber, $academicYear, $semester, $facultyID]);
    } else {
        // Insert new record
        $stmt_insert = $pdo->prepare("INSERT INTO tbl_faculty (facultyID, firstName, middleName, lastName, department, email, contactNumber, academicYear, semester) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_insert->execute([$facultyID, $firstName, $middleName, $lastName, $department, $email, $contactNumber, $academicYear, $semester]);
    }
}

// File upload handling
if(isset($_FILES['facultyFile'])){
   
    $file = $_FILES['facultyFile'];

    // Check if file is uploaded successfully
    if($file['error'] === UPLOAD_ERR_OK){
        echo "No upload error.<br>"; // Debug statement

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];

        // Check if file is CSV
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        if($fileExt == 'csv'){
            echo "File is a CSV.<br>"; // Debug statement

            // Read CSV file
            $fileHandle = fopen($fileTmpName, 'r');
            if($fileHandle){
                echo "CSV file opened successfully.<br>"; // Debug statement

                $header = fgetcsv($fileHandle); // Skip header row
                while(($row = fgetcsv($fileHandle)) !== false){
                    // Extract data from CSV row
                    $facultyID = $row[0];
                    $firstName = $row[1];
                    $middleName = $row[2];
                    $lastName = $row[3];
                    $department = $row[4];
                    $email = $row[5];
                    $contactNumber = $row[6];
                    $academicYear = $row[7];
                    $semester = $row[8];

                    // Insert or update faculty record into database
                    insertOrUpdateFaculty($pdo, $facultyID, $firstName, $middleName, $lastName, $department, $email, $contactNumber, $academicYear, $semester);
                }
                fclose($fileHandle);
                echo "<script>alert('Successfully Imported Faculty.')window.location.href = '../admin_import.php';</script>";
            } else {
                echo "<script>alert('Failed to import CSV file.')window.location.href = '../admin_import.php';</script>";
            }
        } else {
            echo "<script>alert('Please upload CSV file.')window.location.href = '../admin_import.php';</script>";
        }
    } else {
        echo "<script>alert('Error uploading file: " . $file['error'] . "')window.location.href = '../admin_import.php';</script>"; // Debug statement
    }
} else {
    echo "<script>alert('File not found.'); window.location.href = '../admin_import.php';</script>";
}

// Close database connection
$pdo = null;
?>
