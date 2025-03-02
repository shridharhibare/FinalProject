document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("signupForm").addEventListener("submit", function (e) {
      const fullName = document.getElementById("fullName").value.trim();
      const email = document.getElementById("email").value.trim();
      const phone = document.getElementById("phone").value.trim();
      const password = document.getElementById("password").value;

      let errorMessage = "";

      if (!fullName || !email || !phone || !password) {
          errorMessage = "Please fill in all the fields.";
      } else if (!validateEmail(email)) {
          errorMessage = "Please enter a valid email address.";
      } else if (!validatePhone(phone)) {
          errorMessage = "Please enter a valid phone number.";
      }

      if (errorMessage) {
          e.preventDefault(); // Only prevent submission if there's an error
          alert(errorMessage);
      } 
  });
});
