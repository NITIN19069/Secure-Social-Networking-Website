<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
   include "dbConnection.php";
   include "header.php";
   $GPName=$_POST["Receiver"];
   $GAdmin=$_POST["GAdmin"];
   if(isset($_POST['Amt'])){
	   $amt=$_POST["Amt"];
	   $checkBal="Select * from ewallet where UserName='$_SESSION[Username]'";
	    $CheckQuery = mysqli_query($con,$checkBal);
		$rowQ = mysqli_fetch_array($CheckQuery);
		$AMOUNT=$rowQ["Amount"];
		if($amt>$AMOUNT){
			header("location:groups.php?msg='A'");
		}
	   }
   $Gid=$_POST["GId"];		  
   $insert="Insert into grouprequest(GroupName,GroupId,UserName) values ('$GPName','$Gid','$_SESSION[Username]')";
   if(mysqli_query($con , $insert)){
	   header("location:groups.php?msg=??");
   }
   else{
	   echo"Sorry";
   }
}
else{
	header("location:index.php");
	
}?>