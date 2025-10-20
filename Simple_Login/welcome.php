<?php
session_start();

$servername = "localhost";
$username = "root";    
$password = "";       
$dbname = "users_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Only run if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT user_id, name FROM user WHERE email = ? AND password = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $email, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    $_SESSION['user_id'] = $row['user_id']; 
    $_SESSION['name'] = $row['name']; 
    header("Location: Welcome.html");   // Redirect to welcome page
    exit();
  } else {
    echo "Invalid email or password.";
  }

  $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <h2>Login</h2>
  <form method="POST" action="">
    <label>Email:</label>
    <input type="text" name="email" required><br><br>
    <label>Password:</label>
    <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
  </form>
</body>
</html>