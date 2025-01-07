<?php
include '../../../../db/db.php'; 

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    $stmt = $conn->prepare("UPDATE users SET disable_status = 1 WHERE email = ?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $update_status_stmt = $conn->prepare("UPDATE recovery_requests SET status = 'active' WHERE email = ?");
        $update_status_stmt->bind_param("s", $email);

        if ($update_status_stmt->execute()) {
            $_SESSION['success'] = "Account has been unbanned and recovery request status updated.";
        } else {
            $_SESSION['error'] = "Error updating recovery request status.";
        }

        $update_status_stmt->close();
    } else {
        $_SESSION['error'] = "There was an error unbanning the account.";
    }

    $stmt->close();
    header("Location: ../../web/api/recover.php");
    exit();
}
?>
