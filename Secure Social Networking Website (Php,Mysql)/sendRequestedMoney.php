<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
	include "header.php";
   include "dbConnection.php";
   $Sender=$_POST['Sender'];
	$Amt=$_POST['Amount'];
	$Id=$_POST['TransID'];
	$CheckMoney="Select * from ewallet where UserName='$_SESSION[Username]'";
	$Checkquery = mysqli_query($con,$CheckMoney);
	$row = mysqli_fetch_array($Checkquery);
	$WalletAmount=$row['Amount'];
	if($WalletAmount<$Amt){
		header("location:EWallet.php?m=?");
	}
	else{
		$WalletAmount=$WalletAmount-$Amt;
		$tran=$row['No_Of_Transaction']+1;
		$Update = "Update ewallet Set Amount='$WalletAmount',No_Of_Transaction='$tran' where UserName='$_SESSION[Username]'";
		$u=mysqli_query($con,$Update);
		$CheckMoneyR="Select * from ewallet where UserName='$Sender'";
		$CheckqueryR = mysqli_query($con,$CheckMoneyR);
		$rowR = mysqli_fetch_array($CheckqueryR);
		$AmountR=$rowR['Amount']+$Amt;
		$UpdateR = "Update ewallet Set Amount='$AmountR' where UserName='$Sender'";
		$uR=mysqli_query($con,$UpdateR);
		$insert="Insert into transaction (Sender,Receiver,Amount) values('$_SESSION[Username]','$Sender',$Amt)";
		$i=mysqli_query($con,$insert);
		$delete="delete from requestmoney where RMId='$Id'";
		$d=mysqli_query($con,$delete);
		if($d){
			header("location:EWallet.php");}
	
		else{echo"kuch to gadabad h";}
		
	}
   }else{
  header("location:index.php");
  
}
?>