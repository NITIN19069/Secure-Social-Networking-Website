<?php
session_start();
include "dbConnection.php";
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
	include "Header.php";
$user=$_SESSION["Username"];
$amount=$_POST["amount"]

?>
<html>
<br>
<style>
	.tweet-body {
        display: flex;
        justify-content: center;
            }
    
    body{
 background: #76b852;

  }
</style>
<p>
 <form action ="moneyConfirm.php" method ="post">
 <input type="text" name="amount" value="<?php echo  $amount; ?>" required >
<input type = "text" name ="otp" placeholder="Enter Transaction Pin"/ required="">
<br>
</br>
<input type = "submit" name = "submit" value="Add Money" >
</form></p>
<?php
}
else

{
	
	header("location:index.php");
	} 
?>
 
