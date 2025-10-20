function validateRegisterForm() {
  const username = document.getElementById("username").value.trim();
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value;
  const confirm = document.getElementById("confirm").value;


  // Username validation
  if (username.length < 3) {
    alert("Username must be at least 3 characters long.");
    return false;
  }

  // Email format validation
  const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
  if (!emailPattern.test(email)) {
    alert("Please enter a valid email address.");
    return false;
  }

  // Password validation
  if (password.length < 6) {
    alert("Password must be at least 6 characters long.");
    return false;
  }

  // Confirm password
  if (password !== confirm) {
    alert("Passwords do not match!");
    return false;
  }

  return true; // form will submit to register.php
}