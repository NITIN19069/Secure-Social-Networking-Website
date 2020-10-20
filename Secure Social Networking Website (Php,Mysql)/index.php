<?php
session_start();
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
header("location: Home.php");
}
$_SESSION["fgt_pwd"]=false;

if(isset($_GET['msg'])){
	echo "You have been added as a casual user.To change, login and go to edit profile.";
	
}
if(isset($_GET['abc'])){
	echo "Not added";
	
}
if(isset($_GET['xyz'])){
	echo "Password changed successfully!";
	
}
if(isset($_GET['m'])){
	echo "Enter Correct Details.";
	
}
?>
<html>
<head>
<title>Log In Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->
</head>
<body>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>Log In Form</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="checkLogin.php" method="post">
					<input class="text" type="email" name="Email" placeholder="Email" required="">
					<input class="text" type="password" name="Password" placeholder="Password" required="">
					<div class="wthree-text">
						<div class="clear"> </div>
					</div>
					<input type="submit" value="Log In">
					<br><a href="sess_frgt.php">Forgot Password? </a>
				</form>
				<p>Don't have an Account? <a href="SignUp.php"> Sign Up Now!</a></p>
			</div>
		</div>
		
	</div>
	<!-- //main -->
</body>
</html>