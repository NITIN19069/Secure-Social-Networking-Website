<?php
session_start();
if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) {
    include "dbConnection.php";
if(isset($_GET["Type"]))
	{
	$type=$_GET["Type"];
	}
	$TypeUser=$_GET["typeUser"];
	if($TypeUser=="Premium"){
	if($type=="Silver"){
		?>
		<h4>Silver. Amount to be paid Rs 50 per month.<h4>
		<form action="Payment.php" method="post">
		<input type="email" name="Email" placeholder="Enter Email ID" required=""><br>
		<input type="text" name="OTP" required=""><br>Enter OTP<br>
		<input type="hidden" name="TypeUser" value="<?php echo $TypeUser; ?>" required>
		<input type="hidden" name="Type" value="<?php echo $type; ?>" required>
		<input type="submit">
		</form>
		<?php
	}
	else if($type=="Gold"){
		?>
		<h4>Gold. Amount to be paid 100 Rs per month.</h4>
		<form action="Payment.php" method="post">
		<input type="email" name="Email" placeholder="Enter Email ID" required=""><br>
		<input type="text" name="OTP" required><br>Enter OTP HERE/Amount to be paid<br>
		<input type="hidden" name="TypeUser" value="<?php echo $TypeUser; ?>" required>
		<input type="hidden" name="Type" value="<?php echo $type; ?>" required>
		<input type="submit">
		</form>
		<?php
	}
	else if($type=="Platinum"){
		?>
		<h4>Platinum. Amount to be paid 150 Rs per month.</h4>
		<form action="Payment.php" method="post">
		<input type="email" name="Email" placeholder="Enter Email ID" required=""><br>
		<input type="text" name="OTP" required><br>Enter OTP HERE/Amount to be paid<br>
		<input type="hidden" name="TypeUser" value="<?php echo $TypeUser; ?>">
		<input type="hidden" name="Type" value="<?php echo $type; ?>">
		<input type="submit">
		</form><?php
	}
}
else if($TypeUser=="Commercial"){
	?>
		<h4>Amount to be paid Rs 5000 per year.<h4>
		<form action="Payment.php" method="post">
		<input type="email" name="Email" placeholder="Enter Email ID" required=""><br>
		<input type="text" name="OTP" required><br>Enter OTP HERE/Amount to be paid<br>
		<input type="hidden" name="TypeUser" value="<?php echo $TypeUser; ?>">
		<input type="submit">
		</form><?php
}

header("Refresh:60; url=sessionout.php");
}
else{
	header("location:index.php");
	
}

?>