<?php

include 'db_connection.php';


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $formData = [
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'facebook' => $_POST['facebook'] ?? '',
        'twitter' => $_POST['twitter'] ?? '',
        'linkedin' => $_POST['linkedin'] ?? '',
        'dob' => $_POST['dob'] ?? '',
        'address' => $_POST['address'] ?? '',
    ];

    // Validate form data (you can add more validation as needed)
    $errors = [];
    if (empty($formData['name'])) {
        $errors[] = "Name is required";
    }
    if (empty($formData['email']) || !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    if (empty($formData['phone'])) {
        $errors[] = "Phone number is required";
    }
    if (empty($formData['dob'])) {
        $errors[] = "Date of birth is required";
    }
    if (empty($formData['address'])) {
        $errors[] = "Address is required";
    }

    // If there are no errors, insert the data into the database
    if (empty($errors)) {
        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO students (name, email, phone, facebook, twitter, linkedin, dob, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssssssss", 
            $formData['name'], 
            $formData['email'], 
            $formData['phone'], 
            $formData['facebook'], 
            $formData['twitter'], 
            $formData['linkedin'], 
            $formData['dob'], 
            $formData['address']
        );

        // Execute the statement
        if ($stmt->execute()) {
            echo "Form submitted successfully and data saved to the database!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // If there are errors, display them
        echo "Errors:<br>";
        foreach ($errors as $error) {
            echo htmlspecialchars($error) . "<br>";
        }
    }
} else {
    // If the form wasn't submitted, redirect back to the form page
    header("Location: student_info.html");
    exit();
}

// Close the database connection
$conn->close();
?>
