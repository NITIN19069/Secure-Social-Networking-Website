<?php
session_start();
include "dbConnection.php";
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
	
	include "Header.php";
$user=$_SESSION["Username"];
if(isset($_GET{'msg5'})){
	echo "  Something went wrong, PLEASE TRY AGAIN";
}   


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

<br>
<div class="dropdown">
  <form action ="setpinconfirm.php" method ="post">
 <br>
 <h2>Note: Keep this pin confidential and remember it, if lost then you will not be able to use ewallet.</h2>

<input type = "text" name ="Pin" placeholder="Set 4 Digit Transaction Pin" required />

<br>

<input type = "submit" name = "submit" value="Set Pin" >

</form></p>
<?php
}
else{
	
	header("location:index.php");
	} 
?>
 
