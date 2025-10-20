let btn = document.getElementById("loginBtn");
// console.log("test");
btn.onclick= function () {
  console.log("test");
  const email = document.getElementById("loginEmail").value.trim();
  const password = document.getElementById("loginPassword").value;

  if (email === ""){
    alert("Please fill in Email field.");
    return false;
  }

  if (password === ""){
    alert("Please fill in Password field.");
    return false;
  } 

  //“Start : some text : @ : some text : . : 2–3 lowercase letters : end.”
  const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
  if (!emailPattern.test(email)) {
    alert("Invalid email format.");
    return false;
  }
  
  return true;
}