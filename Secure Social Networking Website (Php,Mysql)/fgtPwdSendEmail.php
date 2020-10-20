<?php
session_start();

if(isset($_SESSION['fgt_pwd']) && $_SESSION['fgt_pwd'] == true)
{
	$_SESSION["fgt_pwd1"]=false;
	
?>
<html>
<form action = "mailFP.php" method = "post">
<input type ="text email" name = "Email" placeholder="Enter Email ID" required=""><br><br>
<input type ="submit" name = "submit" value="Send OTP">
</form>
</html>
<?php
}
else{
	header("Location:index.php");
}
?>