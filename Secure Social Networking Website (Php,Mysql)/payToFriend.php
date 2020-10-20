<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
include "dbConnection.php";
$amount = $_POST['amount'];
$sender=$_SESSION['Username'];
$receiver = $_POST['Receiver'];
if($receiver!="Select Friend to Pay"){
	
	$select1="Select * from ewallet where UserName='$sender'";
	$query=mysqli_query($con,$select1);
	$row1 = mysqli_fetch_array($query);
	$amt1=$row1['Amount'];
	$amt1=$amt1-$amount;
	if($amt1>=0){
		$trans=$row1['No_Of_Transaction']+1;		
		$update1="Update ewallet Set Amount='$amt1', No_Of_Transaction=$trans where UserName='$sender'";
		$query4=mysqli_query($con,$update1);
		$insert = "Insert into transaction(Sender,Receiver,Amount) values ('$sender','$receiver','$amount')";
		$queryx=mysqli_query($con,$insert);
		$select="Select * from ewallet where UserName='$receiver'";
		$query1=mysqli_query($con,$select);
		$row = mysqli_fetch_array($query1);
		$amt=$row['Amount'];
		$amt=$amt+$amount;
		$trans2=$row['No_Of_Transaction']+1;
		$update="Update ewallet Set Amount='$amt',No_Of_Transaction=$trans2 where UserName='$receiver'";
		$query3=mysqli_query($con,$update);
		if($query4&&$queryx&&$query3){
		header("location:EWallet.php?succ=??");
		}
}else
	{
		
		header("location:EWallet.php?err=??");
	}
}
else
{
	header("location:walletPay.php?err=??");	
}
}
	
		else {
		header("location:index.php");	
		}
?>
