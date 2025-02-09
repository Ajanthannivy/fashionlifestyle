<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fashiondress";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from userregister table based on interest
$sql = "SELECT interest, COUNT(*) AS count FROM userregister GROUP BY interest";
$result = $conn->query($sql);

$menCount = 0;
$womenCount = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['interest'] == 'Men') {
            $menCount = $row['count'];
        } elseif ($row['interest'] == 'Women') {
            $womenCount = $row['count'];
        }
    }
} else {
    echo "No data found";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Interest Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        canvas {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<h2>User Interest Chart (Men vs Women)</h2>

<canvas id="interestBarChart" width="400" height="200"></canvas>
<canvas id="interestPieChart" width="400" height="200"></canvas>

<script>
    // Fetch data passed from PHP to JavaScript
    const menCount = <?php echo $menCount; ?>;
    const womenCount = <?php echo $womenCount; ?>;

    // Create the bar chart
    const barChartCtx = document.getElementById('interestBarChart').getContext('2d');
    new Chart(barChartCtx, {
        type: 'bar',
        data: {
            labels: ['Men', 'Women'],
            datasets: [{
                label: 'User Interest Count',
                data: [menCount, womenCount],
                backgroundColor: ['#3498db', '#e74c3c'],
                borderColor: ['#2980b9', '#c0392b'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Create the pie chart
    const pieChartCtx = document.getElementById('interestPieChart').getContext('2d');
    new Chart(pieChartCtx, {
        type: 'pie',
        data: {
            labels: ['Men', 'Women'],
            datasets: [{
                data: [menCount, womenCount],
                backgroundColor: ['#3498db', '#e74c3c'],
                borderColor: ['#2980b9', '#c0392b'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });
</script>

</body>
</html>
