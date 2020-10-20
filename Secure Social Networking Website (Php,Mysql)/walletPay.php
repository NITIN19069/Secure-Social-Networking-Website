<?php
session_start();
include "dbConnection.php";
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
	include "Header.php";
	if(isset($_GET{'err'})){
	echo "Please select friend first";
}
$user=$_SESSION["Username"];



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
<?php

$select = "Select * from sign_up where UserName='$_SESSION[Username]'";
$query2 = mysqli_query($con,$select);
if (mysqli_num_rows($query2) > 0) {
while($row = mysqli_fetch_array($query2))
{ 

?>
<br>
<div class="dropdown">
  <form action ="payToFriend.php" method ="post">
  
  <select name="Receiver" style="background-color:#000;color: #fff;  ">
<option>Select Friend to Pay</option>
<?php
$query="SELECT Receiver from friends where Sender = '$_SESSION[Username]'";
$result=mysqli_query($con,$query);
if($result)
{
while($row=mysqli_fetch_array($result))
{
$fname=$row['Receiver'];
echo "<option>".$fname."<br></option>";
}
}
?>
</select></div><br>

<input type = "text" name ="amount" placeholder="Enter Amount" required />

<br>

<input type = "submit" name = "submit" value="Pay" >

</form></p>
<?php
}}
else{
	echo "You have no friends to pay money";	
}
}

else{
	
	header("location:index.php");
	} 
?>
 
