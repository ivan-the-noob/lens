<?php 

require '../../../../db/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['fullname'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $event = $_POST['event'];
    $time = $_POST['time'];
    $selected_date = $_POST['selected_date'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO appointment (name, latitude, longitude, event, time, selected_date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sddsss", $name, $latitude, $longitude, $event, $time, $selected_date);

    // Execute and check for success
    if ($stmt->execute()) {
        echo "Appointment booked successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>