<?php
$host = "localhost";
$user = "root";       
$pass = "";          
$dbname = "registration";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get data from POST
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];

// Hash password
$hashed = password_hash($password, PASSWORD_BCRYPT);

// Insert user
$stmt = $conn->prepare("INSERT INTO user (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashed);

if ($stmt->execute()) {
  echo "<script>alert('Registration successful!'); window.location.href='login.html';</script>";
} else {
  echo "<script>alert('Error: Email already exists or database error'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>