<?php
session_start();
require '../../../db/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to prevent SQL injection
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email); // Bind email to the prepared statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hashedPassword = $user['password']; // Assume this is the hashed password stored in the DB

        // Verify the password using password_verify
        if (password_verify($password, $hashedPassword)) {
            // Store session variables
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['name'] = $user['name'];

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: ../../../features/admin/web/api/admin.php"); // Admin dashboard
            } elseif ($user['role'] === 'client') {
                header("Location: ../../../client/home.php"); // Client homepage
            } elseif ($user['role'] === 'supplier') {
                header("Location: ../../../supplier/portal.php"); // Supplier portal
            } else {
                // Handle unexpected roles (optional)
                $_SESSION['login_error'] = "Invalid role!";
                header("Location: ../../web/api/login.php");
            }
            exit();
        } else {
            // Handle invalid password
            $_SESSION['login_error'] = "Invalid email or password!";
            header("Location: ../../web/api/login.php");
            exit();
        }
    } else {
        // Handle case where the user doesn't exist
        $_SESSION['login_error'] = "Invalid email or password!";
        header("Location: ../../web/api/login.php");
        exit();
    }
}
