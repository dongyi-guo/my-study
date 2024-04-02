/**
 * Dynamic functions for registration page
 */
function submitForm() {
  if (check()) {
    alert("Submission Succeed!");
    return true;
  } else {
    alert(
      "5-10 characters in length\n" +
        "Contain at least 1 lowercase letter, 1 uppercase letter, 1 number and one of the following! "
    );
    return false;
  }
}

function check() {
  if (checkPassword()) {
    console.log("is true");
    return true;
  } else {
    console.log("is false");
    return false;
  }
}

/* check password */
function checkPassword() {
  var password = document.getElementById("password");
  var rePassword = document.getElementById("rePassword");
  console.log(password.value);
  console.log(rePassword.value);
  /*
      1, Two values has to be matched
      2, Length required between 5-10 digits
      3, At least 1 small letter、1 capital letter、1 number and 1 special character(ex: !、@、#、$)
  */
  var pwdRegex = new RegExp(
    "(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(?=.*[^a-zA-Z0-9]).{5,10}"
  );
  console.log(password.value === rePassword.value);
  console.log(pwdRegex.test(password.value));

  if (password.value === rePassword.value && pwdRegex.test(password.value)) {
    // if (password.length < 4 && password.length > 11 && rePassword.length < 4 && rePassword.length > 11) {
    // if (!pwdRegex.test(password) && !pwdRegex.test(rePassword)) {
    console.log("is return ture");
    return true;
  } else {
    console.log("is return false");
    return false;
  }
}
