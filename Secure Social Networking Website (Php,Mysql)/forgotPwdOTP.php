<?php
session_start();
if(isset($_SESSION['fgt_pwd1']) && $_SESSION['fgt_pwd1'] == true)
{
?>
<html>
<form action = "forgotPwd.php" method = "post">
<input type ="text" name = "otp" placeholder="Enter OTP" required=""><br><br>
<input type ="password" name = "password" placeholder="Set New Password" required=""><br><br>
<input type = "password" name = "password" placeholder="Confirm New Password" required=""><br><br>
<input type ="submit" name="submit" value ="Change Password">
</form>
</html>
<?php

header("Refresh:60; url=index.php");
}
else{
	
	header("Location:index.php");
}
?>
