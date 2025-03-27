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
    $vehicleNumber = $_POST["Vehicle Number"];
    $route = $_POST["Route"];
    $departure = $_POST["Departure"];
    $destination = $_POST["Destination"];
    $currentLocation = $_POST["current location"];
    $departureTimings = $_POST["Departure timing"];

    // Validate that the vehicle number starts with "KA"
    if (strpos($vehicleNumber, "KA") !== 0) {
        echo "Error: Vehicle number must start with 'KA'.";
        exit;
    }

    // Insert data into the database
    $sql = "INSERT INTO bus_add (Vehicle Number, Route, Departure, Destination, current location, departure timing)
            VALUES ('$vehicleNumber', '$route', '$departure', '$destination', '$currentLocation', '$departureTimings')";

    if ($conn->query($sql) === TRUE) {
        echo "Bus successfully added!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>