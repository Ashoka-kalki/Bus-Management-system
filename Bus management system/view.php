<?php
// Database connection
$host = "localhost";
$username = "myadmin"; // Replace with your database username
$password = "admin"; // Replace with your database password
$dbname = "bus management system";

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the database
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $vehicleNumber = isset($_GET["vehicleNumber"]) ? $_GET["vehicleNumber"] : null;

    // SQL query to fetch data
    $sql = "SELECT * FROM bus_add";
    if ($vehicleNumber) {
        $sql .= " WHERE vehicle_number = '$vehicleNumber'";
    }

    $result = $conn->query($sql);

    $buses = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $buses[] = $row;
        }
    }

    echo json_encode($buses);

    // Close the database connection
    $conn->close();
}
?>