<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
   include "header.php";
   include "dbConnection.php";
   $gpId=$_POST["gpID"];
   $gpname=$_POST["gpname"];
   $add= $_POST["Friend"];
   $insert="Insert into groupmembers(GroupName,GroupId,MemberName) values ('$gpname','$gpId','$add')";
   $select="Select * from groupinfo where GroupId='$gpId'";
   $query2=mysqli_query($con,$select);
   $row = mysqli_fetch_array($query2);
   $no=$row["GroupMember"];
   $no=$no+1;
   $update="Update groupinfo Set GroupMember='$no' where GroupId = '$gpId'";
   $query3=mysqli_query($con,$update);
   $Delete="Delete from grouprequest where GroupId = '$gpId' And UserName='$add'";
   $resultDelete=mysqli_query($con,$Delete);
   if($add!="SELECT FRIENDS")
   {
   if(mysqli_query($con,$insert)){
	   header("location:group.php?msg=??");
	   
   }
   }
   else {
	   header("location:MyGroups.php?error1=??");
   }
}
else{
	header("location:index.php");
}
?>