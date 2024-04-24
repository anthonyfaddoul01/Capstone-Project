<?php
require ('dbconn.php');
ob_start();
?>

<!DOCTYPE html>
<html>

<!-- Head -->

<head>

  <title>Library Management </title>

  <!-- Meta-Tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="keywords"
    content="Library Member Login Form Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
  <script
    type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <!-- //Meta-Tags -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- Style -->
  <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
  <!-- Fonts -->
  <link href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <!-- //Fonts -->

</head>
<!-- //Head -->

<!-- Body -->

<body class="flex-row">
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="images/loginimg.jpg" alt="">
      </div>
      <div class="back">
        <img class="backImg" src="images/loginimg.jpg" alt="">
      </div>
    </div>
    <div class="forms">
      <div class="form-content">
        <div class="login-form">
          <div class="title">Login</div>
          <form action="index.php" method="post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" Name="email" placeholder="Enter your email or username" required="">
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" Name="password" placeholder="Enter your Password" required="">
              </div>

              <div class="button input-box">
                <input type="submit" name="signin" value="Sign In">
              </div>
              <div class="text sign-up-text">Don't have an account? <label for="flip">Sign up now</label></div>
            </div>
          </form>
        </div>
        <div class="signup-form">
          <div class="title">Signup</div>
          <form action="index.php" method="post" name="signup" id="signup" autocomplete="off">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" Name="name" placeholder="Enter your name" required>
                <div class="validation-message"></div>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" Name="email" placeholder="Enter your email" required>
                <div class="validation-message"></div>
              </div>
              <div class="input-box">
                <i class="fas fa-signature"></i>
                <input type="text" Name="username" placeholder="Create a username" required>
                <div class="validation-message"></div>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" Name="password" placeholder="Enter your password" required>
                <div class="validation-message"></div>
              </div>
              <?php include ("trial.php") ?>
              <div class="button input-box">
                <input type="submit" name="signup" value="Sign Up">
              </div>
              <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php
  if (isset($_POST['signin'])) {
    
    $u = $_POST['email'];
    $p = $_POST['password'];

    $sql = "select * from bookbud.user where email='$u' OR username='$u'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $x = $row['password'];
    $y = $row['type'];
    $id = $row['userId'];
    if (strcasecmp($x, $p) == 0 && !empty($u) && !empty($p)) {//echo "Login Successful";
      $_SESSION['email'] = $u;
      $_SESSION['userId'] = $id;
      $_SESSION['type'] = $y;

      if ($y == 'admin') {
        echo header("Location:admin/index.php");

      } elseif ($y == 'Librarian') {
        echo header("Location:librarian/index.php");

      } elseif ($y == 'User') {
        echo header("Location:user/index.php");

      } else {
        echo header('Location:error.php');
      }

    } else {
      echo "<script type='text/javascript'>alert('Failed to Login! Incorrect IDNo or Password')</script>";
    }


  }

  if (isset($_POST['signup'])) {
    echo '<script>alert("This is an alert message from PHP!");</script>';

    echo '<script>console.log("")</script>';
    $name = $_POST['name'];
    echo '<script>console.log("helooo")</script>';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    if (isset($_POST['interests']) && is_array($_POST['interests'])) {
      $genre = array_map(function ($item) use ($conn) {
        return mysqli_real_escape_string($conn, $item);
      }, $_POST['interests']);
    } else {
      $genre = []; // Or handle the error as appropriate
    }
    $genres = implode(', ', $genre);
    $type = 'User';

    $sql = "insert into bookbud.user (name,username,email,password,type,interests) values ('$name','$username','$email','$password','$type','$genres')";

    if ($conn->query($sql) === TRUE) {
      //echo "<script type='text/javascript'>alert('Registration Successful')</script>";
      $_SESSION['message'] = "Registration Successful";
      $_SESSION['msg_type'] = "success";
    } else {
      //echo "Error: " . $sql . "<br>" . $conn->error;
      //echo "<script type='text/javascript'>alert('User Exists')</script>";
      $_SESSION['message'] = "User Exists";
      $_SESSION['msg_type'] = "error";
    }
  }
  ob_flush();
  ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const signupForm = document.getElementById("signup");
    if (signupForm) {
        const inputs = signupForm.querySelectorAll('input[required]');

        function updateCustomMessage(input) {
            if (!input.value) {
                input.setCustomValidity('Please fill in this field.');
            } else {
                input.setCustomValidity('');
            }

            switch (input.name) {
                case 'name':
                    if (!/^[A-Za-z\s]{3,20}$/.test(input.value)) {
                        input.setCustomValidity('Name must be 3-20 characters long and contain only letters and spaces.');
                    }
                    break;
                case 'email':
                    if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(input.value)) {
                        input.setCustomValidity('Please enter a valid email address.');
                    }
                    break;
                case 'username':
                    if (input.value) {
                        checkUsername(input);
                    }
                    break;
                case 'password':
                    if (!/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}/.test(input.value)) {
                        input.setCustomValidity('Password must be at least 8 characters with one uppercase, one lowercase, one number, and one special character.');
                    }
                    break;
            }
            input.reportValidity();
        }

        function checkUsername(input) {
            const username = input.value;
            $.ajax({
                url: 'check_username.php',
                type: 'POST',
                data: {username: username},
                dataType: 'json',
                success: function(data) {
                    if (data.exists) {
                        input.setCustomValidity('Username already exists.');
                    } else {
                        input.setCustomValidity('');
                    }
                    input.reportValidity();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX error: " + textStatus + ' : ' + errorThrown);
                    console.error("Detailed server response: " + jqXHR.responseText); // Provides the actual response from the server
                    input.setCustomValidity('Failed to validate username. Try again.');
                    input.reportValidity();
                }
            });
        }

        inputs.forEach(input => {
            input.addEventListener('input', function() {
                updateCustomMessage(input);
            });
        });

        signupForm.addEventListener('submit', function(event) {
            // event.preventDefault();
            let formIsValid = true;
            inputs.forEach(input => {
                updateCustomMessage(input);
                if (!input.checkValidity()) {
                    formIsValid = false;
                }
            });

            if (formIsValid) {
             this.submit(); // Updated to use requestSubmit
            }
        });
    }
});

</script>


<!-- <script>
document.addEventListener("DOMContentLoaded", function () {
    const signupForm = document.querySelector('.signup-form');
    if (signupForm) {
        const inputs = signupForm.querySelectorAll('input[required]');

        // Utility function to update custom validation messages
        function updateCustomMessage(input) {
            if (!input.value) {
                input.setCustomValidity('Please fill in this field.');
            } else {
                input.setCustomValidity(''); // Clear any existing custom messages
            }

            switch (input.name) {
                case 'name':
                    if (!/^[A-Za-z\s]{3,20}$/.test(input.value)) {
                        input.setCustomValidity('Name must be 3-20 characters long and contain only letters and spaces.');
                    }
                    break;
                case 'email':
                    if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(input.value)) {
                        input.setCustomValidity('Please enter a valid email address.');
                    }
                    break;
                case 'username':
                    // Add any username-specific validations here if needed
                    break;
                case 'password':
                    if (!/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}/.test(input.value)) {
                        input.setCustomValidity('Password must be at least 8 characters with one uppercase, one lowercase, one number, and one special character.');
                    }
                    break;
            }
            input.reportValidity();
        }

        // Event listener for input changes to update validation messages
        inputs.forEach(input => {
            input.addEventListener('input', function () {
                updateCustomMessage(input);
            });
        });

        // Handling form submission with validation
        signupForm.addEventListener('submit', function (event) {
        //    event.preventDefault(); // Prevent the form from submitting until validation is complete

            let formIsValid = true;
            inputs.forEach(input => {
                updateCustomMessage(input);
                if (!input.checkValidity()) {
                    formIsValid = false;
                }
            });

            if (formIsValid) {
                this.submit(); // Submit the form if all validations are passed
            }
        });
    }
});
</script> -->
<!-- <script>
document.addEventListener("DOMContentLoaded", function() {
    const usernameInput = document.querySelector('input[name="username"]');

    usernameInput.addEventListener('input', function() {
        const username = this.value;

        if (username.length >= 3) { // Only check if username length is 3 or more
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'check_username.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                    if (this.responseText === 'taken') {
                      input.setCustomValidity('Please enter a valid email address.');
                        // Optionally, disable the submit button
                        // document.querySelector('input[type="submit"]').disabled = true;
                    } else {
                        
                        // Optionally, enable the submit button
                        // document.querySelector('input[type="submit"]').disabled = false;
                    }
                } else {
                    alert('Error checking username.');
                }
            };
            xhr.send('username=' + encodeURIComponent(username));
        }
    });
}); 
</script> -->
</body>
<!-- //Body -->

</html>