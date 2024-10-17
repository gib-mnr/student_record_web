<?php
// Include the database connection
include 'db_connection.php';

$id = $_GET['id'];

// Query to delete the student
$sql = "DELETE FROM students WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully!";
    header('Location: view_students.php');
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
