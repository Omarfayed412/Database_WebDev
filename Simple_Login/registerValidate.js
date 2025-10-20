let btn = document.getElementById("submitBtn");

btn.onclick = function validateRegisterForm() {
  const username = document.getElementById("nameReg").value.trim();
  const email = document.getElementById("emailReg").value.trim();
  const password = document.getElementById("passReg").value;
  const confirm = document.getElementById("confReg").value;


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