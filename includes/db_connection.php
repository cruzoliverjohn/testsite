<?php
    $databasename = "svms_schema_tester";
    $serverhost = "localhost";
    $username = "root";
    $password = ""; 

    try {
        $pdo = new PDO("mysql:host=$serverhost;dbname=$databasename", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection Failed: " . $e->getMessage();
        exit(); 
    }