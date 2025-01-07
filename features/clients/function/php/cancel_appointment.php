<?php
include('../../../../db/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cancelReason = $_POST['cancelReason'];
    $appointmentId = $_POST['appointmentId'];

    $sql = "UPDATE appointment SET status = 'Cancelled', cancel_reason = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $cancelReason, $appointmentId);

    if ($stmt->execute()) {
        header('Location: ../../web/api/status.php?message=success');
        exit();
    } else {
        echo 'error';
    }

    $stmt->close();
    $conn->close();
}
?>
