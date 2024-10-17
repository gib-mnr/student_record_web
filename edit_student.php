<?php
// Include the database connection
include 'db_connection.php';

// Check if it's an edit operation
$id = isset($_GET['id']) ? $_GET['id'] : '';
$student = null;

// If editing, fetch the student data based on the ID
if ($id) {
    $sql = "SELECT * FROM students WHERE id = " . intval($id);
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $student = $result->fetch_assoc();
    } else {
        die("Student not found.");
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get updated data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $linkedin = $_POST['linkedin'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];

    // Update the student's data in the database
    $sql = "UPDATE students SET 
            name='" . $conn->real_escape_string($name) . "', 
            email='" . $conn->real_escape_string($email) . "', 
            phone='" . $conn->real_escape_string($phone) . "', 
            facebook='" . $conn->real_escape_string($facebook) . "', 
            twitter='" . $conn->real_escape_string($twitter) . "', 
            linkedin='" . $conn->real_escape_string($linkedin) . "', 
            dob='" . $conn->real_escape_string($dob) . "', 
            address='" . $conn->real_escape_string($address) . "' 
            WHERE id=" . intval($id);

    if ($conn->query($sql) === TRUE) {
        echo "Student updated successfully!";
        header('Location: view_students.php');
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Info</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 16px;
            font-size: 1rem;
        }

        button {
            background-color: #4285f4;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #357ae8;
        }
    </style>
</head>
<body>
    <form id="editStudentForm" action="" method="POST">
        <h2>Edit Student Info</h2>
        
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>

        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($student['phone']); ?>" required>

        <label for="facebook">Facebook URL</label>
        <input type="url" id="facebook" name="facebook" value="<?php echo htmlspecialchars($student['facebook']); ?>">

        <label for="twitter">Twitter URL</label>
        <input type="url" id="twitter" name="twitter" value="<?php echo htmlspecialchars($student['twitter']); ?>">

        <label for="linkedin">LinkedIn URL</label>
        <input type="url" id="linkedin" name="linkedin" value="<?php echo htmlspecialchars($student['linkedin']); ?>">

        <label for="dob">Date of Birth</label>
        <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($student['dob']); ?>" required>

        <label for="address">Address</label>
        <textarea id="address" name="address" required><?php echo htmlspecialchars($student['address']); ?></textarea>

        <button type="submit">Update Student</button>
    </form>

    <script>
        document.getElementById('editStudentForm').addEventListener('submit', function(event) {
            console.log('Form submitted');
        });
    </script>
</body>
</html>