<?php
require('dbconn.php');
?>

<!DOCTYPE html>
<html>

<!-- Head -->
<head>

	<title>Library Management </title>

	<!-- Meta-Tags -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Library Member Login Form Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<!-- //Meta-Tags -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<!-- Style --> 
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
	<!-- Fonts -->
		<link href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
	<!-- //Fonts -->
	<script>
window.onload = function() {
    <?php if(isset($_SESSION['message'])): ?>
        var messageType = "<?php echo $_SESSION['msg_type']; ?>";
        var messageDiv = document.getElementById('message');
        messageDiv.style.display = 'block';
        messageDiv.textContent = "<?php echo $_SESSION['message']; ?>";
        messageDiv.className = messageType; // Use this class to style your message
        <?php unset($_SESSION['message']); unset($_SESSION['msg_type']); ?> // Clear message after displaying
    <?php endif; ?>
}
</script>
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
					<input type="text" Name="email" placeholder="Enter your email" required="">
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
			<form action="index.php" method="post">
				<div class="input-boxes">
				<div class="input-box">
					<i class="fas fa-user"></i>
					<input type="text" Name="name" placeholder="Enter your name" required>
				</div>
				<div class="input-box">
					<i class="fas fa-envelope"></i>
					<input type="text" Name="email" placeholder="Enter your email" required>
				</div>
				<div class="input-box">
					<i class="fas fa-signature"></i>
					<input type="text" Name="username" placeholder="Create a username" required>
				</div>
				<div class="input-box">
					<i class="fas fa-lock"></i>
					<input type="password" Name="password" placeholder="Enter your password" required>
				</div>
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
if(isset($_POST['signin']))
{$u=$_POST['email'];
 $p=$_POST['password'];

 $sql="select * from bookbud.user where email='$u' OR username='$u'";

 $result = $conn->query($sql);
$row = $result->fetch_assoc();
$x=$row['password'];
$y=$row['type'];
$id=$row['userId'];
if(strcasecmp($x,$p)==0 && !empty($u) && !empty($p))
  {//echo "Login Successful";
   $_SESSION['email']=$u;
   $_SESSION['userId']=$id;
   $_SESSION['type']=$y;
   
if ($y == 'Admin') {
	echo header("Location:admin/index.php");

}elseif($y=='Librarian'){
	echo header("Location:librarian/index.php");

}elseif ($y=='User') {
	echo header("Location:user/index.php");

}else{
	echo header('Location:staff/index.php');
}
       
  }
else { 
	echo "<script type='text/javascript'>alert('Failed to Login! Incorrect IDNo or Password')</script>";
}
   

}

if(isset($_POST['signup']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$username=$_POST['username'];
	$type='User';

	$sql="insert into bookbud.user (name,username,email,password,type) values ('$name','$username','$email','$password','$type')";

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

?>

</body>
<!-- //Body -->

</html>