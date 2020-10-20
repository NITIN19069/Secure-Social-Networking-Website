<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
   include "header.php";
   include "dbConnection.php";
	$receiver=$_REQUEST['Receiver'];
	$Delete="Delete from friendrequest where Sender = '$_SESSION[Username]' And Receiver='$receiver'";
	if(mysqli_query($con,$Delete)){
		header("location:home.php?m=?");
	}
?>

<?php
}else{
	header("location:index.php");
	
}

?>