<?php
// Database connection
$host = "localhost:3306";
$username = "myadmin"; // Replace with your database username
$password = "admin"; // Replace with your database password
$dbname = "bus management system";

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicleNumber = $_POST["vehicleNumber"];

    // Validate that the vehicle number starts with "KA"
    if (strpos($vehicleNumber, "KA") !== 0) {
        echo "Error: Vehicle number must start with 'KA'.";
        exit;
    }

    // Delete the record from the database
    $sql = "DELETE FROM bus_add WHERE vehicle_number = '$vehicleNumber'";

    if ($conn->query($sql) === TRUE) {
        if ($conn->affected_rows > 0) {
            echo "Bus with vehicle number '$vehicleNumber' has been successfully deleted!";
        } else {
            echo "No record found with vehicle number '$vehicleNumber'.";
        }
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>