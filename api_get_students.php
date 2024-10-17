<?php
// Include the database connection
include 'db_connection.php';

// Set the content-type to JSON
header('Content-Type: application/json');

// Query to select all students
$sql = "SELECT id, name, email, phone, facebook, twitter, linkedin, dob, address, created_at FROM students";
$result = $conn->query($sql);

// Prepare an array to store the results
$students = array();

if ($result->num_rows > 0) {
    // Fetch all rows and push them into the $students array
    while($row = $result->fetch_assoc()) {
        $students[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'social_links' => array(
                'facebook' => $row['facebook'],
                'twitter' => $row['twitter'],
                'linkedin' => $row['linkedin'],
            ),
            'dob' => $row['dob'],
            'address' => $row['address'],
            'created_at' => $row['created_at'],
        );
    }
}

// Close the database connection
$conn->close();

// Wrap the students array in a named key (e.g., "students")
$response = array(
    'students' => $students
);

// Output the data in JSON format
echo json_encode($response);
?>
