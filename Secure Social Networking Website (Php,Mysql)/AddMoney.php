<?php
session_start();
include "dbConnection.php";
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
	include "Header.php";
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
<p>
 <form action ="moneyAdd.php" method ="post">
<input type = "text" name ="amount" placeholder="Enter Amount" required=""/>

<br>

<input type = "submit" name = "submit" value="Add" >

</form></p>
<?php
}
else

{
	
	header("location:index.php");
	} 
?>
 
