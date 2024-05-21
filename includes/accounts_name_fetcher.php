<?php
include_once("db_connection.php");

function getUserInfo($pdo, $userID) {
    $name = "";
    $stmt = $pdo->prepare("SELECT FirstName, MiddleName, SurName, Ext FROM tbl_students WHERE StudentID = ? AND MiddleName IS NOT NULL AND Ext IS NOT NULL");
    $stmt->execute([$userID]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($student) {
        $name = $student['FirstName'];
        if (!empty($student['MiddleName'])) {
            $name .= ' ' . $student['MiddleName'];
        }
        $name .= ' ' . $student['SurName'];
        if (!empty($student['Ext'])) {
            $name .= ' (' . $student['Ext'] . ')';
        }
    } else {
        $stmt = $pdo->prepare("SELECT FirstName, MiddleName, SurName, Ext FROM tbl_faculty WHERE FacultyID = ? AND MiddleName IS NOT NULL AND Ext IS NOT NULL");
        $stmt->execute([$userID]);
        $faculty = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($faculty) {
            $name = $faculty['FirstName'];
            if (!empty($faculty['MiddleName'])) {
                $name .= ' ' . $faculty['MiddleName'];
            }
            $name .= ' ' . $faculty['SurName'];
            if (!empty($faculty['Ext'])) {
                $name .= ' (' . $faculty['Ext'] . ')';
            }
        } else {
            $stmt = $pdo->prepare("SELECT FirstName, MiddleName, SurName, Ext FROM tbl_personnel WHERE PersonnelID = ? AND MiddleName IS NOT NULL AND Ext IS NOT NULL");
            $stmt->execute([$userID]);
            $personnel = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($personnel) {
                $name = $personnel['FirstName'];
                if (!empty($personnel['MiddleName'])) {
                    $name .= ' ' . $personnel['MiddleName'];
                }
                $name .= ' ' . $personnel['SurName'];
                if (!empty($personnel['Ext'])) {
                    $name .= ' (' . $personnel['Ext'] . ')';
                }
            }
        }
    }

    return $name;
}
?>

