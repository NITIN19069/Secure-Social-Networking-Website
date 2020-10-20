<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
include "header.php";
include "dbConnection.php";
?><p>Enter Ewallet Pin</p>
<form method="post" action="PayForGroup.php">
<input type="text" required="" name="Pin">
<input type="hidden" name="gpname" value="<?php echo $_POST['gpname']?>">
<input type="hidden" name="Amount" value="<?php echo $_POST['Amount']?>">
<input type="hidden" name="GAdmin" value="<?php echo $_POST['GAdmin']?>">
<input type="hidden" name="gpID" value="<?php echo $_POST['gpID']?>">
<input type="submit" value="Pay">

</form>
<?php
}
else{
	header("location:index.php");
}
?>
		
		