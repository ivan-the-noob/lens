<?php
session_start();
include '../../../../db/db.php';

// Ensure email is stored in session
if (!isset($_SESSION['email'])) {
    die('Email not found in session.');
}

$email = $_SESSION['email'];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $profession = isset($_POST['profession']) ? implode(',', $_POST['profession']) : '';
    $about_me = $_POST['about_me'];
    $age = $_POST['age'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $location_text = $_POST['location_text']; // Add this line to capture location text

    // Handle file upload
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_image']['tmp_name'];
        $fileName = $_FILES['profile_image']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Define allowed file extensions
        $allowedExts = array('jpg', 'jpeg', 'png');
        
        if (in_array($fileExtension, $allowedExts)) {
            // Define the path to upload the file
            $uploadFileDir = '../../../../assets/img/profile/';
            $dest_path = $uploadFileDir . basename($fileName);

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $profileImg = $dest_path;
            } else {
                die('Error moving uploaded file');
            }
        } else {
            die('Unsupported file type');
        }
    } else {
        // Set a default image if none uploaded
        $profileImg = 'default_image.jpg';
    }

    // Check if an entry with the given email already exists
    $stmt = $conn->prepare("SELECT COUNT(*) FROM about_me WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        // Update existing record
        $stmt = $conn->prepare("UPDATE about_me SET profile_image = ?, profession = ?, about_me = ?, age = ?, latitude = ?, longitude = ?, location_text = ? WHERE email = ?");
        $stmt->bind_param('ssssdsss', $profileImg, $profession, $about_me, $age, $latitude, $longitude, $location_text, $email);
    } else {
        // Insert new record
        $stmt = $conn->prepare("INSERT INTO about_me (profile_image, profession, about_me, age, latitude, longitude, location_text, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssdsss', $profileImg, $profession, $about_me, $age, $latitude, $longitude, $location_text, $email);
    }

    // Execute the query
    if ($stmt->execute()) {
        echo 'Data saved successfully!';
    } else {
        echo 'Error: ' . $stmt->error;
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>
