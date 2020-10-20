<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) 
{
include "dbConnection.php";
$PIN=$_POST['Pin'];
$ver="Yes";
$insert="UPDATE ewallet SET verifypin='$ver',pin='$PIN' WHERE UserName='$_SESSION[Username]'";
$query=mysqli_query($con,$insert);
if(mysqli_query($con,$insert))
{
	header("location:EWallet.php");
}
else
{
	header("location:setpin.php?msg5=??");
}
}
else
{
	header("location:index.php");
}