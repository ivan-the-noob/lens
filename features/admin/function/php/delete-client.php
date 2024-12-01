<?php
session_start();
require '../../../../db/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Client deleted successfully!";
    } else {
        $_SESSION['error'] = "Failed to delete the client. Please try again.";
    }

    header("Location: ../../web/api/registered-client.php");
    exit();
}
?>
