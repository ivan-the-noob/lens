<?php
session_start();  // Start the session to access session variables

// Database connection
require '../../../../db/db.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the file upload for card image
    $target_dir = "../../../../assets/img/snapfeed/";  // Folder where images will be stored
    $card_img = $target_dir . basename($_FILES["card_img"]["name"]);

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["card_img"]["tmp_name"], $card_img)) {
        // File upload was successful

        // Use the session variable for the card title (assuming 'name' is already set)
        if (isset($_SESSION['name'])) {
            $card_title = $_SESSION['name'];  // Retrieve the name from the session
        } else {
            $card_title = "Unknown";  // Fallback in case the session name is not set
        }

        $card_text = $_POST['card_text'];
        $img_title = $_POST['img_title'];

        // Check if email is set in session
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
        } else {
            $email = "unknown@example.com";  // Fallback in case the session email is not set
        }

        // Insert data into the MySQL database
        $sql = "INSERT INTO snapfeed (img_title, card_img, card_text, email) 
                VALUES ('$img_title', '$card_img', '$card_text', '$email')";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../../web/api/snapfeed.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
