<?php
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

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $user = $result->fetch_assoc();
  if (password_verify($password, $user['password'])) {
    echo "<script>alert('Login successful!');</script>";
  } else {
    echo "<script>alert('Invalid password'); window.history.back();</script>";
  }
} else {
  echo "<script>alert('User not found'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>