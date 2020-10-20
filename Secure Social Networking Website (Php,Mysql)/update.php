<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
include "dbConnection.php";
$Phone = $_POST['phno'];
$Birthday=$_POST['dob'];
$Type_User=$_POST['Type_User'];	
if(isset($_POST['PremiumPlan'])){
	$prePlan=$_POST['PremiumPlan'];
}
if(isset($_GET['m'])){
	$otp=$_POST['otp'];
	$otpGen=$_POST['otpGen'];
	if($otp==$otpGen){
		if($Type_User=='Premium'){
			$Update = "Update sign_up Set Phone='$Phone',Birthday='$Birthday',Type_User='$Type_User',Type_premium='$prePlan' where UserName = '$_SESSION[Username]'";
		}
		else{
		$Update = "Update sign_up Set Phone='$Phone',Birthday='$Birthday',Type_User='$Type_User',Type_premium='' where UserName = '$_SESSION[Username]'";}
	if(mysqli_query($con , $Update))
		{
			header("location:home.php");
		}
		else{
			echo "Not Added";
	}
	}else{
		header("location:home.php?u='?'");
	}
		}
	
else{
$check = "SELECT * FROM sign_up WHERE Username = '$_SESSION[Username]'";
  $querycheck = mysqli_query($con,$check);
  $row = mysqli_fetch_array($querycheck);
if($Type_User==""||$Type_User==$row['Type_User']){
	$Update = "Update sign_up Set Phone='$Phone',Birthday='$Birthday' where UserName = '$_SESSION[Username]'";
	if(mysqli_query($con , $Update))
		{
			header("location:home.php");
		}
		else{
			echo "Not Added";
		}
}	
else{
	$otp = rand(1000,9999); 
	$sub="Verification OTP";
	$msg="The otp for the payment is $otp";
	$rec=$_POST['Email'];
	mail($rec,$sub,$msg);
	?>
<!DOCTYPE html>
<html>
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
  padding: 15px 15px;
  font-family: 'Roboto', sans-serif;
}
</style>
</head>
<BODY>
	<br>
<p style="color: #000;font-family: 'Roboto', sans-serif;padding: 0 515px;">Check your email for the OTP</p><br>
		<h2 style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 515px;">Enter OTP</h2>
		<div class="card">
		<form action = "update.php?m=?" method="post">	
		<div class="tablerow">
		<input type="text" name="otp" placeholder="One Time Password" class="login-input" required><br><br>
		<input type="hidden" name="phno" value="<?php echo $Phone; ?>">
		<input type="hidden" name="dob" value="<?php echo $Birthday; ?>">
		<input type="hidden" name="Type_User" value="<?php echo $Type_User; ?>">
		<input type="hidden" name="otpGen" value="<?php echo $otp; ?>">
		<?php if(isset($_POST['PremiumPlan'])){	?>
		<input type="hidden" name="PremiumPlan" value="<?php echo $prePlan; ?>">
		<?php } ?>
		</div>
		<div class="tableheader">
		<input type="submit" name="submit_otp" value="Submit"></div>
		</form>
	</div>
</BODY>

<?php
    
}}

}else{
	
	header("location:index.php");
}
?>