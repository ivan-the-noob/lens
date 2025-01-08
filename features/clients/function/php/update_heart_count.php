<?php
// update_heart_count.php
include '../../../../db/db.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id']; // Get the ID of the current item
    $card_img = $_POST['card_img']; // Get the card image
    $email = $_POST['email']; // Get the session email or user email
    $action = $_POST['action']; // Get whether the heart is active or inactive

    // Determine the new heart count based on the action
    if ($action === 'active') {
        $query = "UPDATE snapfeed SET hearts_count = hearts_count + 1 WHERE id = ? AND card_img = ?";
    } else {
        $query = "UPDATE snapfeed SET hearts_count = hearts_count - 1 WHERE id = ? AND card_img = ?";
    }

    // Prepare and execute the query
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ss", $id, $card_img);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'action' => $action]);
        } else {
            echo json_encode(['status' => 'error']);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error']);
    }

    $conn->close();
}
?>
