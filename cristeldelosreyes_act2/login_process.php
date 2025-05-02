<?php
session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'delosreyes_act_db';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Record an attempt (success or failed)
function recordLoginAttempt($conn, $user_id, $email, $status) {
    $stmt = $conn->prepare("INSERT INTO login_attempts (user_id, email, attempt) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $email, $status);
    $stmt->execute();
    $stmt->close();
}

// Count failed attempts in the last 5 minutes
function tooManyFailedAttempts($conn, $email) {
    $stmt = $conn->prepare("SELECT COUNT(*) FROM login_attempts WHERE email = ? AND attempt = 'failed' AND time > (NOW() - INTERVAL 5 MINUTE)");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($attempts);
    $stmt->fetch();
    $stmt->close();
    return $attempts >= 5;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (tooManyFailedAttempts($conn, $email)) {
        $_SESSION['error'] = "Too many failed login attempts. Try again after 5 minutes.";
        header("Location: login.php");
        exit();
    }

    // Find user by email
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            recordLoginAttempt($conn, $user_id, $email, 'success');
            $_SESSION['user_id'] = $user_id;
            header("Location: home.php"); // Update as needed
            exit();
        } else {
            recordLoginAttempt($conn, $user_id, $email, 'failed');
            $_SESSION['error'] = "Incorrect password.";
        }
    } else {
        // Email doesn't exist, user_id = NULL
        recordLoginAttempt($conn, null, $email, 'failed');
        $_SESSION['error'] = "Email not found.";
    }

    $stmt->close();
}

$conn->close();
header("Location: login.php");
exit();
