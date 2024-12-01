<?php
require '../../../../db/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['fullname'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $event = $_POST['event'];
    $time = $_POST['time'];
    $selected_date = $_POST['selected_date'];
    $email_uploader = $_POST['email_uploader'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO appointment (name, latitude, longitude, event, time, selected_date, email_uploader, email) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sddsssss", $name, $latitude, $longitude, $event, $time, $selected_date, $email_uploader, $email);

    if ($stmt->execute()) {
        echo "Appointment booked successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
