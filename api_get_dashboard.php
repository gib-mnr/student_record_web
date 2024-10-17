<?php
// Include the database connection
include 'db_connection.php';

// Set the content-type to JSON
header('Content-Type: application/json');

// Array to store the response
$response = array();

// Query to get the total number of students
$sql = "SELECT COUNT(*) as total FROM students";
$result = $conn->query($sql);
$response['total_students'] = $result->fetch_assoc()['total'];

// Query to get the latest added student
$sql = "SELECT name, created_at FROM students ORDER BY created_at DESC LIMIT 1";
$result = $conn->query($sql);
$latest_student = $result->fetch_assoc();
$response['latest_student'] = $latest_student ? $latest_student : null;

// Close the database connection
$conn->close();

// Output the data in JSON format
echo json_encode($response);
?>
