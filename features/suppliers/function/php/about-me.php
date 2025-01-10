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
    $name = $_POST['name'];
    $profession = isset($_POST['profession']) ? implode(',', $_POST['profession']) : '';
    $about_me = $_POST['about_me'];
    $age = $_POST['age'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $location_text = $_POST['location_text'];
    $price = $_POST['price'];

    // Handle file upload
    $profileImg = ''; // Initialize variable
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_image']['tmp_name'];
        $fileName = $_FILES['profile_image']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Define allowed file extensions
        $allowedExts = array('jpg', 'jpeg', 'png');
        
        if (in_array($fileExtension, $allowedExts)) {
            // Define the absolute path to upload the file
            $uploadFileDir = $_SERVER['DOCUMENT_ROOT'] . '/lens/assets/img/profile/';
            $dest_path = $uploadFileDir . 'profile.png'; // Only save as profile.png

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $profileImg = 'profile.png'; // Only store the filename in database
            } else {
                die('Error moving uploaded file');
            }
        } else {
            die('Unsupported file type');
        }
    }

    // Check if an entry with the given email already exists
    $stmt = $conn->prepare("SELECT profile_image FROM about_me WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($currentProfileImg);
    $stmt->fetch();
    $stmt->close();

    // Use the existing profile image if no new image is uploaded
    if (empty($profileImg)) {
        $profileImg = $currentProfileImg;
    }

    if ($currentProfileImg) {
        // Update existing record
        $stmt = $conn->prepare("UPDATE about_me SET name = ?, profile_image = ?, profession = ?, about_me = ?, age = ?, latitude = ?, longitude = ?, location_text = ?, price = ? WHERE email = ?");
        $stmt->bind_param('sssssdssss', $name, $profileImg, $profession, $about_me, $age, $latitude, $longitude, $location_text, $price, $email);
    } else {
        // Insert new record
        $stmt = $conn->prepare("INSERT INTO about_me (name, profile_image, profession, about_me, age, latitude, longitude, location_text, price, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssdssss', $name, $profileImg, $profession, $about_me, $age, $latitude, $longitude, $location_text, $price, $email);
    }

    // Execute the query
    if ($stmt->execute()) {
       header('Location: ../../web/api/about-me.php');
       exit();
    } else {
        echo 'Error: ' . $stmt->error;
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>
