<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      font-family: Calibri, Helvetica, sans-serif;
      background-image: url('https://w0.peakpx.com/wallpaper/702/688/HD-wallpaper-ice-cream-background-beautiful-best-available-for-ice-cream.jpg');
      background-color: rgba(0, 0, 0, 0.25);
      background-repeat: no-repeat;
      background-size: cover;
      margin: 0;
      padding: 0;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .cont1 {
      padding: 50px;
      color: #03072C;
      background-color: rgba(255, 255, 255, 0.8);
      border-radius: 5px;
      width: 400px;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    input[type="tel"],
    textarea {
      padding: 10px;
      border: none;
      border-radius: 5px;
      width: 100%;
      background-color: rgba(255, 255, 255, 0.8);
      color: black;
      margin-bottom: 10px;
    }

    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="email"]:focus,
    input[type="tel"]:focus,
    textarea:focus {
      outline: none;
      background-color: rgba(255, 255, 255, 1);
    }

    label {
      display: block;
      margin-bottom: 5px;
      color: white;
    }

    .registerbtn {
      background-color: #4CAF50;
      color: white;
      padding: 16px 20px;
      margin-bottom: 10px;
      border: none;
      cursor: pointer;
      width: 100%;
      border-radius: 5px;
      font-size: 16px;
    }

    .registerbtn:hover {
      opacity: 0.8;
    }

    .signup-link {
      color: white;
      text-align: center;
    }

    footer {
      background-color: rgb(128, 128, 128);
      color: white;
      text-align: center;
      padding: 10px 0;
      position: fixed;
      bottom: 0;
      width: 100%;
    }

    /* CSS for links container */
    .links-container {
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 20px 0;
    }

    .links-content {
      background-color: rgba(255, 255, 255, 0.8);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
      width: 80%;
      max-width: 600px;
    }

    .links-content h3 {
      margin-bottom: 15px;
      color: #03072C;
    }

    .links-content ul {
      list-style-type: none;
      padding: 0;
    }

    .links-content ul li {
      margin: 10px 0;
    }

    .links-content ul li a {
      text-decoration: none;
      color: #4CAF50;
      font-weight: bold;
    }

    .links-content ul li a:hover {
      color: #45a049;
    }
  </style>

  <script>
    function fetchUserDetails() {
      var email = document.getElementById("email").value;
      if (email.trim() === "") {
        alert("Please enter an email to fetch details.");
        return;
      }

      // Use AJAX to fetch user details
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "fetch_user_details.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if (response.status === "success") {
            document.getElementById("sname").value = response.data.name; // Match column name
            document.getElementById("phno").value = response.data.phone; // Match column name
            document.getElementById("password").value = response.data.password; // Match column name
            document.getElementById("cpassword").value = response.data.password; // Match column name
          } else {
            alert(response.message);
          }
        }
      };
      xhr.send("email=" + encodeURIComponent(email));
    }

    function validateForm() {
      var name = document.forms["updateForm"]["sname"].value;
      var phone = document.forms["updateForm"]["phno"].value;
      var email = document.forms["updateForm"]["email"].value;
      var password = document.forms["updateForm"]["password"].value;
      var cpassword = document.forms["updateForm"]["cpassword"].value;

      // Validate name
      if (name.trim() === "") {
        alert("Please enter your name");
        return false;
      }

      // Validate phone number
      if (phone.trim() === "" || phone.length !== 10 || isNaN(phone)) {
        alert("Please enter a valid 10-digit phone number");
        return false;
      }

      // Validate email format
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        alert("Invalid email address");
        return false;
      }

      // Validate password length
      if (password.length < 6) {
        alert("Password must be at least 6 characters long");
        return false;
      }

      // Password match check
      if (password !== cpassword) {
        alert("Passwords do not match");
        return false;
      }

      // If all validations pass, return true to submit the form
      return true;
    }
  </script>
</head>
<body>
  <header style="background-color:rgb(128, 128, 128); text-align:left;">
    <h1 style="color:blue;font-family: 'Bold';"><marquee>ICE CREAM PARLOUR</marquee></h1>
  </header>

  <!-- Links Container -->
  <div class="links-container">
    <div class="links-content">
      <?php include 'links.html'; ?>
    </div>
  </div>

  <div class="container">
    <div class="cont1">
      <form action="update_user.php" method="POST" onsubmit="return validateForm()" name="updateForm">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter Email" required>
        <button type="button" class="registerbtn" onclick="fetchUserDetails()">Fetch Details</button>

        <label for="name">Name</label>
        <input type="text" id="sname" name="sname" placeholder="Enter your name" required>

        <label for="phone">Phone</label>
        <input type="tel" id="phno" name="phno" placeholder="Phone number" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter Password" required>

        <label for="psw-repeat">Re-type Password</label>
        <input type="password" id="cpassword" name="cpassword" placeholder="Retype Password" required>

        <input type="submit" value="Update" class="registerbtn">
      </form>
      <div class="signup-link">
        
      </div>
    </div>
  </div>
</body>
</html>