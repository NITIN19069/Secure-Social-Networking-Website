<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
   include "dbConnection.php";
   $gid=$_POST["GId"];
   
   
   $delete="Delete from grouprequest where GroupId = '$gid' And UserName='$_SESSION[Username]'";
   if(mysqli_query($con,$delete)){
		header("location:groups.php?msg=???");
	}
   
   }
else{
	header("location:index.php");
	
}?>