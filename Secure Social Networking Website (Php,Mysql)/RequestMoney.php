<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
   include "dbConnection.php";
   include "header.php";
   ?>
<html>
<head>
</head>
<body>
<?php
	$query="SELECT * from friends where Sender = '$_SESSION[Username]'";
	$result=mysqli_query($con,$query);
	if(mysqli_num_rows($result)> 0)
	{ 
	while($row=mysqli_fetch_array($result))
		{?><form action="SendMoneyRequest.php" method="post">
	<input type="text" name="Amount" required="">
<?php
		$fname=$row['Receiver'];
		echo "<br>".$fname;?>
		<input type="hidden" name="Receiver" value="<?php echo $row['Receiver']; ?>">
	    <input type="submit" value="Request">
		</form>
		<?php
		}
	}
	else{
		echo "Make some friends first";
	}
}
else{
  header("location:index.php");
  
}
?>
</body>
</html>