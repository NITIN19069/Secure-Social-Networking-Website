<?php
session_start();
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
header("location: Home.php");
} 
if(isset($_GET['msg'])){
	echo $_GET['msg']." Already in use";
	
}
?>
<!DOCTYPE html>
<html>
<head>
<title>SignUp Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->

<script>
function showCasual(){
  document.getElementById('divPremium').style.display ='none';
   document.getElementById('divCommercial').style.display ='none';
}
function showPremium(){
  document.getElementById('divPremium').style.display = 'block';
  document.getElementById('divCommercial').style.display ='none';
}
function showCommercial(){
  document.getElementById('divCommercial').style.display = 'block';
   document.getElementById('divPremium').style.display ='none';
}
function phonenumber(inputtxt)
{
  var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
  if(inputtxt.value.match(phoneno))
     {
	   return true;      
	 }
   else
     {
	   alert("Not a valid Phone Number");
	   return false;
     }
}

</script>
<style>
.hideP{
  display: none;
}
.hideC{
	display: none;
	
}
</style>
</head>
<body>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>SignUp Form</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="insertion.php" method="post" name="form1" onSubmit="return phonenumber(document.form1.Phone);">
					<input class="text" type="text" name="FirstName" placeholder="First name" required=""> 
					<input class="text" type="text" name="LastName" placeholder="Last name" required=""> 
					<input class="text" type="text" name="UserName" placeholder="Username" required=""> 
					<input class="text email" type="email" name="Email" placeholder="Email" required="">
					<input class="text" type="text" name="Phone" placeholder="Phone number" required="">
				  	<input class="text" type="password" name="Password" placeholder="Password" required="">
					<input class="text w3lpass" type="password" name="cpass" placeholder="Confirm Password" required="">
					<label>Gender</label><br><br>
					<input type ="radio" name="Gender" id="rad1" value="M" required />
					<label for="rad1">Male</label>
                    <input type ="radio" name="Gender" id="rad2" value="F" required />
					<label for="rad2">Female</label><br><br>
					<label> Birthday</label><br><br>
				    <input type="date" name="Birthday" required><br><br>
					<input type ="radio" id = "rd1" name="Type_User" value="Casual" onclick="showCasual();" required />
					<label for="rd1">Casual</label>
					<input type ="radio" id = "rd2" name="Type_User" value="Premium" onclick="showPremium();" required />
					<label for="rd2">Premium</label>
                    <input type ="radio" id = "rd3" name="Type_User" value="Commercial" onclick="showCommercial();" required />
					<label for="rd3">Commercial</label>
                     <br><br>
					<div id="divPremium" class="hideP">
						<h4>Choose A Plan:<br><input type="radio" name="PremiumPlan" value="Silver" required>Silver: Can run at most 2 closed groups at a time.Price: Rs. 50 per month.<br>
												<input type="radio" name="PremiumPlan" value="Gold" required>Gold: Can run at most 4 closed groups at a time.Price: Rs. 100 per month<br>
												<input type="radio" name="PremiumPlan" value="Platinum" required>Platinum: Can run any number of groups.Price: Rs. 150 per month.</h4>
					</div>
					<div id="divCommercial" class="hideC">
						<h4>You need to pay Rs. 5000 per Year</h4>
					</div>
				  <div class="wthree-text">
						<label class="anim">
							<input type="checkbox" class="checkbox" required="">
							<span>I Agree To The Terms & Conditions</span>
						</label>
						<div class="clear"> </div>
					</div>
					<input type="submit" value="SIGNUP">
				</form>
				
			</div>
</body>
</html>
