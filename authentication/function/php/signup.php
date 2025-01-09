<?php

session_start();
include '../../../db/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $socialLink = $_POST['social_link'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $profileImg = 'profile.jpg';
    $isActive = 0;

    if ($role == 'customer') {
        $sql = "INSERT INTO users (role, name, email, address, birthday, social_link, username, password, profile_img, is_active) 
                VALUES ('$role', '$name', '$email', '$address', '$birthday', '$socialLink', '$username', '$password', '$profileImg', '$isActive')";
    } elseif ($role == 'supplier') {
        $profession = $_POST['profession'];
        $yearsInProfession = $_POST['years_in_profession'];

        $sql = "INSERT INTO users (role, name, email, address, birthday, social_link, profession, years_in_profession, username, password, profile_img, is_active) 
                VALUES ('$role', '$name', '$email', '$address', '$birthday', '$socialLink', '$profession', '$yearsInProfession', '$username', '$password', '$profileImg', '$isActive')";
    }

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
