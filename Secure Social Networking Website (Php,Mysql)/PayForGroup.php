<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
include "header.php";
include "dbConnection.php";
$user=$_SESSION['Username'];
$gid=$_POST['gpID'];
$gname=$_POST['gpname'];
$gamount=$_POST['Amount'];
$PIN=$_POST['Pin'];
$GAdmin=$_POST['GAdmin'];
$sel="select * from ewallet where UserName='$user'";
$que=mysqli_query($con,$sel);
$row=mysqli_fetch_array($que);
if($PIN==$row['pin']){
		$ewalletBalance="Select * from ewallet where UserName='$_SESSION[Username]'";
		$QueryEwallet=mysqli_query($con,$ewalletBalance);
		$rowEwallet=mysqli_fetch_array($QueryEwallet);
		$a=$rowEwallet['Amount'];
		if($gamount > $a){
			header("location:group.php?msg=X%");
		}
		else{
		$CheckMoneyR="Select * from ewallet where UserName='$GAdmin'";
		$CheckqueryR = mysqli_query($con,$CheckMoneyR);
		$rowR = mysqli_fetch_array($CheckqueryR);
		$AmountR=$rowR['Amount']+$gamount;
		$trans=$rowR['No_Of_Transaction']+1;
		$UpdateR = "Update ewallet Set Amount='$AmountR',No_Of_Transaction='$trans' where UserName='$GAdmin'";
		$uR=mysqli_query($con,$UpdateR);
		$insertT="Insert into transaction (Sender,Receiver,Amount) values('$_SESSION[Username]','$GAdmin',$gamount)";
		 $i=mysqli_query($con,$insertT);
		 $a=$a-$gamount;
		 $TT=$rowEwallet['No_Of_Transaction']+1;
		 $updateMember="Update ewallet Set Amount='$a',No_Of_Transaction='$TT' where UserName='$_SESSION[Username]'";
		 $um=mysqli_query($con,$updateMember);
		 $deletePAY="Delete from paytogroup where GpId='$gid' And Member='$_SESSION[Username]'";
		 $dP=mysqli_query($con,$deletePAY);
		 $insertG="Insert into groupmembers(GroupName,GroupId,MemberName) values ('$gname','$gid','$_SESSION[Username]')";
		 $iG=mysqli_query($con,$insertG);
   $selectG="Select * from groupinfo where GroupId='$gid'";
   $query2=mysqli_query($con,$selectG);
   $row = mysqli_fetch_array($query2);
   $no=$row["GroupMember"];
   $no=$no+1;
   $updateG="Update groupinfo Set GroupMember='$no' where GroupId = '$gid'";
   $query3=mysqli_query($con,$updateG);
if($CheckqueryR&&$uR&&$i&&$um&&$dP&&$iG&&$query2&&$query3){
	header("location:group.php?msg=%T");
}
		 
		 
}}
else{
	header("location:group.php?msg=U%");
}
		
}
else{
	header("location:index.php");
}
?>
