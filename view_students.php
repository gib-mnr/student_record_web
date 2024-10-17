<?php
// Include the database connection
include 'db_connection.php';

// Query to select all students
$sql = "SELECT id, name, email, phone, facebook, twitter, linkedin, dob, address, created_at FROM students";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
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
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #e8f4f8;
        }
        .social-link {
            color: #3498db;
            text-decoration: none;
        }
        .social-link:hover {
            text-decoration: underline;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        .edit-icon, .delete-icon {
            cursor: pointer;
            text-decoration: none;
            padding: 8px;
            border-radius: 4px;
            background-color: #3498db;
            color: white;
        }
        .delete-icon {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Merakitechs Team</h1>
       
        <?php
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Social Media</th><th>Date of Birth</th><th>Address</th><th>Added</th><th>Actions</th></tr>";
         
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["phone"]) . "</td>";
               
                echo "<td>";
                if (!empty($row["facebook"])) echo "<a href='" . htmlspecialchars($row["facebook"]) . "' class='social-link' target='_blank'>Facebook</a> ";
                if (!empty($row["twitter"])) echo "<a href='" . htmlspecialchars($row["twitter"]) . "' class='social-link' target='_blank'>Twitter</a> ";
                if (!empty($row["linkedin"])) echo "<a href='" . htmlspecialchars($row["linkedin"]) . "' class='social-link' target='_blank'>LinkedIn</a>";
                echo "</td>";
               

                echo "<td>" . htmlspecialchars($row["dob"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["address"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["created_at"]) . "</td>";
                echo "<td class='actions'>";
                echo "<a href='edit_student.php?id=" . htmlspecialchars($row["id"]) . "' class='edit-icon'>Edit</a>";
                echo "<a href='delete_student.php?id=" . htmlspecialchars($row["id"]) . "' class='delete-icon' onclick='return confirm(\"Are you sure you want to delete this student?\")'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='empty-message'>No records found.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
