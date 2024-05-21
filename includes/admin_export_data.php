<?php

function exportDataToSQL($pdo, $tableName, $academicYear, $semester) {

    $fileName = "{$tableName}_{$academicYear}_{$semester}_data.sql";
    $downloadsPath = getenv('USERPROFILE') . '\Downloads'; // Path to the user's Downloads folder
    $folderPath = $downloadsPath . '\sqldata'; // Path to the 'sqldata' folder
    $filePath = $folderPath . '\\' . $fileName; // Full path to save the file

    // Create the 'sqldata' directory if it doesn't exist
    if (!file_exists($folderPath)) {
        mkdir($folderPath, 0755, true);
    }

    $stmt = $pdo->prepare("SELECT * FROM $tableName WHERE academicYear = ? AND semester = ?");
    $stmt->execute([$academicYear, $semester]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $fileHandle = fopen($filePath, 'w') or die("Unable to create file: {$fileName}");
    foreach ($data as $row) {
        $values = implode("','", array_map('addslashes', $row));
        fwrite($fileHandle, "INSERT INTO {$tableName} VALUES ('{$values}');\n");
    }
    fclose($fileHandle);

    return $fileName;
}

function deleteRecords($pdo, $tableName, $academicYear, $semester) {
    $stmt = $pdo->prepare("DELETE FROM $tableName WHERE academicYear = ? AND semester = ?");
    $stmt->execute([$academicYear, $semester]);
}

include_once("db_connection.php");

if (isset($_POST['academicYear']) && isset($_POST['semester'])) {
    $academicYear = $_POST['academicYear'];
    $semester = $_POST['semester'];

    $conferenceScheduleFile = exportDataToSQL($pdo, 'tbl_conferenceschedule', $academicYear, $semester);
    $complaintsFile = exportDataToSQL($pdo, 'tbl_complaints', $academicYear, $semester);
    $temporaryPassesFile = exportDataToSQL($pdo, 'tbl_temporarypasses', $academicYear, $semester);
    $violationRecordsFile = exportDataToSQL($pdo, 'tbl_violationrecords', $academicYear, $semester);
    $studentsFile = exportDataToSQL($pdo, 'tbl_admin_students_copy', $academicYear, $semester);
    
    deleteRecords($pdo, 'tbl_conferenceschedule', $academicYear, $semester);
    deleteRecords($pdo, 'tbl_complaints', $academicYear, $semester);
    deleteRecords($pdo, 'tbl_temporarypasses', $academicYear, $semester);
    deleteRecords($pdo, 'tbl_violationrecords', $academicYear, $semester);
    deleteRecords($pdo, 'tbl_admin_students_copy', $academicYear, $semester); //mas maganda ba idelete? YES!
    
    echo "<script>alert('Data has been successfully exported to your downloads folder.'); window.location.href = '../admin_export.php';</script>";
} else {
    echo "<script>alert('Please select an academic year and semester.'); window.location.href = '../admin_export.php';</script>";
}
?>
