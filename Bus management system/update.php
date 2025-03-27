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

// Retrieve the current data for a given vehicle number
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["vehicleNumber"])) {
    $vehicleNumber = $_GET["vehicleNumber"];

    $sql = "SELECT * FROM bus_add WHERE vehicle_number = '$vehicleNumber'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $bus = $result->fetch_assoc();
        echo json_encode($bus); // Send the current bus details as JSON
    } else {
        echo json_encode(["error" => "No record found for this vehicle number."]);
    }
    $conn->close();
    exit;
}

// Update the bus details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicleNumber = $_POST["vehicleNumber"];
    $route = $_POST["route"];
    $departure = $_POST["departure"];
    $destination = $_POST["destination"];
    $currentLocation = $_POST["currentLocation"];
    $departureTimings = $_POST["departureTimings"];

    // Validate that the vehicle number starts with "KA"
    if (strpos($vehicleNumber, "KA") !== 0) {
        echo "Error: Vehicle number must start with 'KA'.";
        exit;
    }

    // Update the database record
    $sql = "UPDATE bus_add 
            SET route = '$route', 
                departure = '$departure', 
                destination = '$destination', 
                current_location = '$currentLocation', 
                departure_timings = '$departureTimings' 
            WHERE vehicle_number = '$vehicleNumber'";

    if ($conn->query($sql) === TRUE) {
        if ($conn->affected_rows > 0) {
            echo "Bus details updated successfully!";
        } else {
            echo "No changes made or no record found with the specified vehicle number.";
        }
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>