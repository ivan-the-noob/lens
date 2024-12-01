<?php

session_start();
include '../../../db/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $profileImg = 'profile.jpg';

    $isActive = 0;

    $sql = "INSERT INTO users (role, name, email, password, profile_img, is_active) VALUES ('$role', '$name', '$email', '$password', '$profileImg', '$isActive')";

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
