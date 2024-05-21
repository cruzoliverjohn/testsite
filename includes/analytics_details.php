<?php

include 'db_connection.php';

function getTotalStudents()
{
    $totalStudents = 0;

    global $pdo;

    try {
        $stmt_selectedyear = $pdo->query("SELECT academicYear, semester FROM tbl_selectedyear WHERE selectedID = '1'");
        $selectedYear = $stmt_selectedyear->fetch(PDO::FETCH_ASSOC);

        if ($selectedYear) {
            $academicYear = $selectedYear['academicYear'];
            $semester = $selectedYear['semester'];

            $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM tbl_admin_students_copy WHERE academicYear = ? AND semester = ?");
            $stmt->bindParam(1, $academicYear);
            $stmt->bindParam(2, $semester);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalStudents = $result['total'];
        } else {
            echo "No academic year and semester selected.";
        }
    } catch(PDOException $e) {
        echo "Query Failed: " . $e->getMessage();
    }

    return $totalStudents;
}

function getTotalFaculty()
{

    $totalFaculty = 0;

    global $pdo;

    try {
        
        $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM tbl_faculty");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalFaculty = $result['total'];
    } catch(PDOException $e) {
        echo "Query Failed: " . $e->getMessage();
    }

    return $totalFaculty;
}


// Function to get total number of accounts
function getTotalAccounts()
{
    // Initialize count
    $totalAccounts = 0;

    global $pdo; // Access the PDO connection object from db_connection.php

    try {
        // Prepare the SQL query to fetch total number of accounts
        $stmt = $pdo->query("SELECT COUNT(*) AS total FROM tbl_accounts");
        // Fetch result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // Get total count
        $totalAccounts = $result['total'];
    } catch(PDOException $e) {
        // Handle database connection error
        echo "Query Failed: " . $e->getMessage();
    }

    // Return total number of accounts
    return $totalAccounts;
}

// Function to get total number of violations
function getTotalViolations()
{
    // Initialize count
    $totalViolations = 0;

    global $pdo; // Access the PDO connection object from db_connection.php

    try {
        // Prepare the SQL query to fetch total number of violations
        $stmt = $pdo->query("SELECT COUNT(*) AS total FROM tbl_violations");
        // Fetch result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // Get total count
        $totalViolations = $result['total'];
    } catch(PDOException $e) {
        // Handle database connection error
        echo "Query Failed: " . $e->getMessage();
    }

    // Return total number of violations
    return $totalViolations;
}

// Function to get total number of sanctions
function getTotalSanctions()
{
    // Initialize count
    $totalSanctions = 0;

    global $pdo; // Access the PDO connection object from db_connection.php

    try {
        // Prepare the SQL query to fetch total number of sanctions
        $stmt = $pdo->query("SELECT COUNT(*) AS total FROM tbl_sanctions");
        // Fetch result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // Get total count
        $totalSanctions = $result['total'];
    } catch(PDOException $e) {
        // Handle database connection error
        echo "Query Failed: " . $e->getMessage();
    }

    // Return total number of sanctions
    return $totalSanctions;
}
// Function to fetch academic year and semester from tbl_selectedyear
function getAcademicYearAndSemester()
{
    // Initialize academic year and semester
    $academicYear = "";
    $semester = "";

    global $pdo; // Access the PDO connection object from db_connection.php

    try {
        // Fetch academic year and semester from tbl_selectedyear
        $stmt_selectedyear = $pdo->query("SELECT academicYear, semester FROM tbl_selectedyear");
        $selectedYear = $stmt_selectedyear->fetch(PDO::FETCH_ASSOC);

        // Check if academic year and semester are fetched successfully
        if ($selectedYear) {
            // Extract academic year and semester from the fetched row
            $academicYear = $selectedYear['academicYear'];
            $semester = $selectedYear['semester'];
        }
    } catch(PDOException $e) {
        // Handle database connection error or query failure
        echo "Query Failed: " . $e->getMessage();
    }

    // Return academic year and semester as an associative array
    return array("academicYear" => $academicYear, "semester" => $semester);
}
?>
