<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
	include "header.php";
    include "dbConnection.php";
    $gpId=$_POST["gpID"];
    $gpname=$_POST["gpname"];
	$user=$_POST["User"];
	$CheckPaid="Select * from groupinfo where GroupId='$gpId'";
	$queryCheckPaid=mysqli_query($con,$CheckPaid);
   $rowPaid = mysqli_fetch_array($queryCheckPaid);
    $amt=$rowPaid['Amount'];
   if($amt==0){
	   $insert="Insert into groupmembers(GroupName,GroupId,MemberName) values ('$gpname','$gpId','$user')";
   $select="Select * from groupinfo where GroupId='$gpId'";
   $query2=mysqli_query($con,$select);
   $row = mysqli_fetch_array($query2);
   $no=$row["GroupMember"];
   $no=$no+1;
   $update="Update groupinfo Set GroupMember='$no' where GroupId = '$gpId'";
   $query3=mysqli_query($con,$update);
   $Delete="Delete from grouprequest where GroupId = '$gpId' And UserName='$user'";
   $resultDelete=mysqli_query($con,$Delete);
   if(mysqli_query($con,$insert)){
	   header("location:group.php?msg=??");
   }}
   else{
   $DeleteReq="Delete from grouprequest where GroupId = '$gpId' And UserName='$user'";
   $resultDelete=mysqli_query($con,$DeleteReq);
   $InsertPay="Insert into paytogroup values ('$_SESSION[Username]','$gpId','$user',$amt)"; 	
	  if(mysqli_query($con,$InsertPay)){
		  header("location:group.php?msg=X");
	  } 
   
}}
else{
	header("location:index.php");
}
?>
	  