<?php
// Include the database connection
include 'db_connection.php';

// Query to get total number of students
$sql = "SELECT COUNT(*) as total FROM students";
$result = $conn->query($sql);
$total_students = $result->fetch_assoc()['total'];

// Query to get the latest added student
$sql = "SELECT name, created_at FROM students ORDER BY created_at DESC LIMIT 1";
$result = $conn->query($sql);
$latest_student = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merakitechs System</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .dashboard-item {
            background-color: #3498db;
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
        .dashboard-item h2 {
            font-size: 2em;
            margin: 0;
        }
        .dashboard-item p {
            margin: 10px 0 0;
        }
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        .action-button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .action-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Merakitechs System</h1>
        
        <div class="dashboard-grid">
            <div class="dashboard-item">
                <h2><?php echo $total_students; ?></h2>
                <p>Total Students</p>
            </div>
            <div class="dashboard-item">
                <h2><?php echo $latest_student ? $latest_student['name'] : 'N/A'; ?></h2>
                <p>Latest Student Added</p>
                <p><?php echo $latest_student ? $latest_student['created_at'] : ''; ?></p>
            </div>
        </div>

        <div class="action-buttons">
            <a href="view_students.php" class="action-button">View All Students</a>
            <a href="student_info.php" class="action-button">Add New Student</a>
        </div>
    </div>
</body>
</html>