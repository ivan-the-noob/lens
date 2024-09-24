<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: authentication/web/api/login.php");
    exit();
}

require '../../../../db/db.php';

// Fetch all images from the snapfeed table
$img_sql = "SELECT id, img_title, card_img FROM snapfeed ORDER BY id DESC";
$img_stmt = $conn->prepare($img_sql);
$img_stmt->execute();
$img_result = $img_stmt->get_result();

if ($img_result->num_rows > 0) {
    while ($img_row = $img_result->fetch_assoc()) {
        echo '
        <div class="col-md-4 mb-3 gallery-item">
            <img src="' . htmlspecialchars($img_row['card_img']) . '" class="img-fluid modal-img" alt="Image from Snapfeed" 
                 data-img-src="' . htmlspecialchars($img_row['card_img']) . '" 
                 data-img-title="' . htmlspecialchars($img_row['img_title']) . '" 
                 data-modal-id="' . $img_row['id'] . '" 
                 onclick="updateModalContent(this)">
            <p>ID: ' . htmlspecialchars($img_row['id']) . '</p> <!-- Display the ID here -->
        </div>';
    }
} else {
    echo '<p>No images found.</p>'; // Message if no images are available
}
?>
