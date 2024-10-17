<?php

// Database connection parameters
    $host = 'localhost'; // MAMP default host
    $dbname = 'student_portal'; // Your database name
    $username = 'root'; // MAMP default username
    $password = 'root'; // MAMP default password

// Create a connection
    $conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


?>
