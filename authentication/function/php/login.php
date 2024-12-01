<?php
session_start();
require '../../../db/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $_SESSION['login_error'] = "Please enter both email and password!";
        header("Location: ../../web/api/login.php");
        exit();
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hashedPassword = $user['password'];

        if (password_verify($password, $hashedPassword)) {
            $updateQuery = "UPDATE users SET last_login = NOW() WHERE id = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("i", $user['id']);
            $updateStmt->execute();

            if ($user['role'] === 'supplier') {
                if ($user['is_active'] == 1) {
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['name'] = $user['name'];
                    header("Location: ../../../index.php"); 
                    exit();
                } else {
                    $_SESSION['login_error'] = "Your account is inactive. Please contact support.";
                    header("Location: ../../web/api/login.php");
                    exit();
                }
            } elseif ($user['role'] === 'admin') {
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['name'] = $user['name'];
                header("Location: ../../../features/admin/web/api/admin.php");
                exit();
            } elseif ($user['role'] === 'customer') {
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['name'] = $user['name'];
                header("Location: ../../../index.php");
                exit();
            } else {
                $_SESSION['login_error'] = "Invalid role!";
                header("Location: ../../web/api/login.php");
                exit();
            }
        } else {
            $_SESSION['login_error'] = "Invalid email or password!";
            header("Location: ../../web/api/login.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Invalid email or password!";
        header("Location: ../../web/api/login.php");
        exit();
    }
}
?>
