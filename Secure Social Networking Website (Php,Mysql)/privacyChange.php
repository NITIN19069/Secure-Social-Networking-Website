<?php
session_start();
include "dbConnection.php";
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
   include "Header.php";
   $privacy=$_POST["Privacy"];
   $Update = "Update sign_up Set Privacy='$privacy' where UserName = '$_SESSION[Username]'";
   if(mysqli_query($con , $Update))
		{
			header("location:home.php");
		}
		else{
			echo "Not Changed";
		}

}else{
	header("location:index.php");
	
}
?>