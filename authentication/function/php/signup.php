<?php

session_start();
include '../../../db/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Default profile image
    $profileImg = 'profile.jpg';

    $sql = "INSERT INTO users (role, name, email, password, profile_img) VALUES ('$role', '$name', '$email', '$password', '$profileImg')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['signup_success'] = "Sign up successful! Log in to your account.";
        header("Location: ../../web/api/login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
