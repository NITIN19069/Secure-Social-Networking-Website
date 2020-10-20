<?php
session_start();
include "dbConnection.php";
$Email= $_SESSION['email'];
if(isset($_SESSION['otp_in']) && $_SESSION['otp_in'] == true){
if(isset($_GET['msg'])){
	 $message = "Invalid OTP/Email ID. Please enter correct details";
      echo "<script type='text/javascript'>alert('$message');</script>";
	
 $var=1;
$update1="Select * from authentication where Email ='$Email'";
$result = mysqli_query($con,$update1);
$row = mysqli_fetch_array($result);
$res= $row["login_count"]+$var;
$update="UPDATE authentication SET login_count = '$res' WHERE Email ='$Email'";
mysqli_query($con,$update); 
if($row['login_count'] >=4)
{
  session_destroy();
  $update="UPDATE authentication SET login_count = 0 WHERE Email ='$Email'";
mysqli_query($con,$update);
  header("Location: index.php");
 
}
 }
	?>
<HTML>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  
body { background: #76b852;}
* {box-sizing: border-box;}
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 500px;
  background-color: #619245;
  margin: auto;
  padding: 10px 15px;
  font-family: 'Roboto', sans-serif;
}
</style>
</head>
<BODY>
        <p style="color: #000;font-family: 'Roboto', sans-serif;padding: 0 515px;">Check your email for the OTP</p>
		<h2 style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 515px;">Enter OTP</h2>
		<div class="card">
		<form action = "checkOTP.php" method="post">	
		<div class="tablerow">
		<input type="email" name="Email" placeholder="Enter Email" class="login-input" required><br><br>
			<input type="text" name="otp" placeholder="One Time Password" class="login-input" required><br><br>
		</div>
		<div class="tableheader">
		<input type="submit" name="submit_otp" value="Submit"></div>
		</form>
	</div>
</BODY>
</HTML>
<?php
}
else
{
	header("Location: index.php");
}
?>	


