<?php
include_once("db_connection.php");
function createAccounts($pdo, $tableName, $userIDField, $firstNameField, $middleNameField, $lastNameField) {
    $stmt = $pdo->query("SELECT $userIDField, $firstNameField, $middleNameField, $lastNameField FROM $tableName");

    $stmtSelect = $pdo->prepare("SELECT COUNT(*) AS count FROM tbl_accounts WHERE userID = ?");

    $stmtInsert = $pdo->prepare("INSERT INTO tbl_accounts (userID, userName, userPassword, userType) VALUES (?, ?, ?, ?)");

    $newAccountsCount = 0;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $userID = $row[$userIDField];
        $firstName = ucwords(strtolower($row[$firstNameField]));
        $middleName = ucwords(strtolower($row[$middleNameField]));
        $lastName = ucwords(strtolower($row[$lastNameField]));

        $userName = $firstName . " " . $middleName . " " . $lastName;

        $stmtSelect->execute([$userID]);
        $result = $stmtSelect->fetch(PDO::FETCH_ASSOC);
        $existingCount = $result['count'];

        if ($existingCount == 0) {
            $hashedPassword = password_hash($lastName, PASSWORD_DEFAULT);

            $userType = ($tableName == 'tbl_students') ? 'STUDENTS' : 'FACULTY';

            $stmtInsert->execute([$userID, $userName, $hashedPassword, $userType]);

            $newAccountsCount++;
        }
    }

    return $newAccountsCount;
}


$studentCount = createAccounts($pdo, 'tbl_students', 'studentID', 'firstName', 'middleName', 'lastName');
if ($studentCount > 0) {
    echo "<script>
            alert('Total new student accounts created: $studentCount');
            window.location.href = '../admin_manage_users.php';       
          </script>";
} else {
    echo "<script>
    alert('NO NEW STUDENT ACCOUNTS CREATED');
          </script>";
}

$facultyCount = createAccounts($pdo, 'tbl_faculty', 'facultyID', 'firstName', 'middleName', 'lastName');
if ($facultyCount > 0) {
    echo "<script>
            alert('Total new faculty accounts created: $facultyCount');
            window.location.href = '../admin_manage_users.php';
          </script>";
} else {
    echo "<script>
            alert('NO NEW FACULTY ACCOUNTS CREATED');
            window.location.href = '../admin_manage_users.php';
          </script>";
}
?>