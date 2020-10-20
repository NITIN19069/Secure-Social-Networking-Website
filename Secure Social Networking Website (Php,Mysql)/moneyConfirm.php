<?php
session_start();
include "dbConnection.php";
$amount=$_POST["amount"];
$otp=$_POST["otp"];
$select = "Select * from ewallet where UserName='$_SESSION[Username]'";
$query=mysqli_query($con,$select);
 if (mysqli_query($con,$select))
{      
$row = mysqli_fetch_array($query);
	if ($row['pin'] == $otp)
	{
		$new_amount=$row['Amount']+$amount;
		$trans=$row['No_Of_Transaction']+1;
        $select1= "Update ewallet Set Amount='$new_amount',No_Of_Transaction=$trans where UserName='$_SESSION[Username]'";
	    $query2=mysqli_query($con,$select1);
		$insertTrans="Insert into transaction (Sender,Receiver,Amount) values('$_SESSION[Username]','$_SESSION[Username]',$amount)";
		 $i=mysqli_query($con,$insertTrans);
		if($query2&&$i){
		header("Location:EWallet.php?amt=??");}
}
else
{
	header("Location:EWallet.php?amtfailed=??");
}
}
?>

		  