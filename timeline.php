<?php
// Include the database connection
include 'db_connection.php';

// Query to fetch student data
$sql = "SELECT id, name, created_at FROM students ORDER BY created_at";
$result = $conn->query($sql);

$students = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

$conn->close();

// Calculate the date range for all students
$start_date = min(array_column($students, 'created_at'));
$end_date = max(array_column($students, 'created_at'));
$date_range = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Timeline</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
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
            text-align: center;
            color: #333;
        }
        .timeline-chart {
            overflow-x: auto;
        }
        .timeline-header {
            display: flex;
            border-bottom: 1px solid #ddd;
        }
        .timeline-header-cell {
            flex: 0 0 50px;
            text-align: center;
            font-size: 12px;
            padding: 5px;
            border-right: 1px solid #ddd;
        }
        .timeline-row {
            display: flex;
            border-bottom: 1px solid #eee;
        }
        .timeline-row-label {
            flex: 0 0 200px;
            padding: 10px;
            font-weight: bold;
            border-right: 1px solid #ddd;
        }
        .timeline-row-marker {
            flex: 1;
            position: relative;
            height: 40px;
        }
        .timeline-marker {
            position: absolute;
            height: 30px;
            width: 30px;
            top: 5px;
            background-color: #3498db;
            border-radius: 50%;
            color: white;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .timeline-marker:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Timeline</h1>
        <div class="timeline-chart">
            <div class="timeline-header">
                <?php
                for ($i = 0; $i <= $date_range; $i += 7) {  // Display weekly intervals
                    $date = date('M d', strtotime($start_date . ' + ' . $i . ' days'));
                    echo "<div class='timeline-header-cell'>$date</div>";
                }
                ?>
            </div>
            <?php foreach ($students as $student): ?>
                <div class="timeline-row">
                    <div class="timeline-row-label"><?php echo htmlspecialchars($student['name']); ?></div>
                    <div class="timeline-row-marker">
                        <?php
                        $student_start = (strtotime($student['created_at']) - strtotime($start_date)) / (60 * 60 * 24);
                        $margin_left_percent = ($student_start / $date_range) * 100;
                        ?>
                        <div class="timeline-marker" style="margin-left: <?php echo $margin_left_percent; ?>%;" data-student-id="<?php echo $student['id']; ?>">
                            +
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const timelineMarkers = document.querySelectorAll('.timeline-marker');
            
            timelineMarkers.forEach(marker => {
                marker.addEventListener('click', function() {
                    const studentId = this.getAttribute('data-student-id');
                    const studentName = this.closest('.timeline-row').querySelector('.timeline-row-label').textContent;
                    alert('Student ID: ' + studentId + '\nName: ' + studentName + '\nJoined: ' + new Date(this.style.marginLeft).toLocaleDateString());
                    // Here you can add more interactive features, like opening a modal with student details
                });
            });
        });
    </script>
</body>
</html>