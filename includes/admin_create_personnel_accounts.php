<?php
// Include file to handle database connection
include_once("db_connection.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $userID = $_POST['personnelUserID']; // Update to match the input field ID in the modal
    $userType = $_POST['personnelUserType']; // Get userType from the form
    
    // Check if userID already exists
    $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM tbl_accounts WHERE userID = ?");
    $stmt_check->execute([$userID]);
    $count = $stmt_check->fetchColumn();
    
    if ($count > 0) {
        // User ID already exists
        echo '<script>alert("User ID already exists. Please choose a different one.");</script>';
        echo '<script>window.location.href = "../admin_manage_users.php";</script>';
    } else {
        // Format the fullName in the desired format (capitalize each part)
        $firstName = $_POST['personnelFirstName']; // Update to match the input field ID in the modal
        $middleName = $_POST['personnelMiddleName']; // Update to match the input field ID in the modal
        $lastName = $_POST['personnelLastName']; // Update to match the input field ID in the modal
        $fullName = ucwords(strtolower("$firstName $middleName $lastName")); // Capitalize each part and concatenate
        
        $userPassword = $_POST['personnelUserPassword']; // Update to match the input field ID in the modal
        
        // Hash the password for security
        $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

        // Prepare SQL statement to insert data into tbl_accounts
        $stmt = $pdo->prepare("INSERT INTO tbl_accounts (userID, userName, userPassword, userType) VALUES (:userID, :userName, :userPassword, :userType)");

        // Bind parameters and execute the statement
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':userName', $fullName);
        $stmt->bindParam(':userPassword', $hashedPassword);
        $stmt->bindParam(':userType', $userType); // Use userType from the form

        // Execute the statement
        if ($stmt->execute()) {
            // Data inserted successfully
            echo '<script>alert("Account created successfully.");</script>';
            echo '<script>window.location.href = "../admin_manage_users.php";</script>';
        } else {
            // Error occurred
            echo '<script>alert("Error creating account.");</script>';
            echo '<script>window.location.href = "../admin_manage_users.php";</script>';
        }
    }
}
?>
