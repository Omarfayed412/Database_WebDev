<?php
session_start(); // Start session for user authentication

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "registration";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        // Store user info in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        
        // Properly escape the username for JavaScript
        $username = htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8');
        
        echo "<script>
            alert('Welcome " . $username . "!');
            window.location.href = 'dashboard.php'; // Redirect to dashboard or home page
        </script>";
    } else {
        echo "<script>alert('Invalid password'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('User not found'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>