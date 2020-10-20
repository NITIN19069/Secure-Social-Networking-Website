<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
include "header.php";
include "dbConnection.php";
if(isset($_GET['msg'])){
	if($_GET['msg']=="?????"){echo "Cannot create more groups.";}
	else if($_GET['msg']=='X'){echo "Accepted to group.";}
	else if($_GET['msg']=='U%'){echo "Wrong PIN";}
	else if($_GET['msg']=='X%'){echo "Not Enough Money";}
	else if($_GET['msg']=='%T'){echo "Added to group.";}
	else{
	echo "Added to the group";}	
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
	.tweet-body {
        display: flex;
        justify-content: center;
            }
	* {
  box-sizing: border-box;
}

body {
  
  background: #76b852;
}

/* Float four columns side by side */
.column {
  float: left;
  width: 25%;
  padding: 0 100px;
}

/* Remove extra left and right margins, due to padding */
.row {margin: 0 -5px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}

/* Style the counter cards */
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 30px;
  text-align: center;
 background:#619245;
 color: #000;
 
}
</style>
</head>
<body><?php
$select = "SELECT * FROM sign_up WHERE UserName = '$_SESSION[Username]'";
$query = mysqli_query($con,$select);
$row = mysqli_fetch_array($query);
if($row["Type_User"]=="Premium"||$row["Type_User"]=="Commercial"){
?>
	<a href="groupform.php" style="text-decoration:none;"><h2 style="color: #000;font-family: 'Roboto', sans-serif;text-align: right;"> +Create group</h2></a>
	
	
<?php
}
else{
	?>
	<h2 style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;">To create a group you need to be a premium or commercial user.</h2>
<?php
}
?>
<a href="groups.php" style="text-decoration:none;"><h3 style="color: #000;font-family: 'Roboto', sans-serif;text-align: right;">Join Group</h3></a>
<h1 style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;">My Groups</h1>
<?php
$select = "SELECT * FROM groupinfo WHERE Admin = '$_SESSION[Username]'";
$query = mysqli_query($con,$select);
if (mysqli_num_rows($query) > 0){?>
	<h2 style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;"><?php echo "Group Created by me</h2>";
	while($row=mysqli_fetch_array($query)){?>
		<p class="tweet-body">
		<div class="row">
  <div class="column">
    <div class="card">
		<form action="MyGroups.php" method="post">
		<input type="hidden" name="gpID" value="<?php echo $row["GroupId"];?>" required>
		<input type="hidden" name="gpname" value="<?php echo $row["GroupName"];?>" required>
<input type="submit" value="<?php echo $row["GroupName"];?>" required>
		</form>
		</div>
</div></div>
</p><?php
		
	}
	}
	else{?>
		<p style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;"><?php echo "You haven't created any group.<br>";	?></p><?php	
	}
	?><h2 style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;"><?php echo "Groups you have joined</h2>";
	$selectPay="Select * from  paytogroup where Member='$_SESSION[Username]'";
	$queryPay=mysqli_query($con,$selectPay);
	if (mysqli_num_rows($queryPay) > 0){
	while($rowPay=mysqli_fetch_array($queryPay)){
		$GInfo="Select * from groupinfo where GroupId='$rowPay[GpId]'";
		$queryGInfo=mysqli_query($con,$GInfo);
		$rowGInfo=mysqli_fetch_array($queryGInfo);
		
		?><p class="tweet-body">
<div class="row">
  <div class="column">
    <div class="card">
		<form action="PINofEwallet.php" method="post">
	<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php
		echo $rowGInfo["GroupName"];
		?></p>
		<input type="hidden" name="GAdmin" value="<?php echo $rowPay["Admin"];?>" required>
		<input type="hidden" name="gpID" value="<?php echo $rowPay["GpId"];?>" required>
		<input type="hidden" name="gpname" value="<?php echo $rowGInfo["GroupName"];?>" required>
		<input type="hidden" name="Amount" value="<?php echo $rowGInfo["Amount"];?>" required>
		<input type="submit" value="Pay"></form>
		</div>
</div></div>
</p>
		<?php
	
	}}
	
	
	
$selectGroups="Select * from groupmembers where MemberName='$_SESSION[Username]'";
$queryMembers = mysqli_query($con,$selectGroups);
if (mysqli_num_rows($queryMembers) > 0){
	while($rowMembers=mysqli_fetch_array($queryMembers)){
		?>
		<p class="tweet-body">
<div class="row">
  <div class="column">
    <div class="card">
		<form action="ViewGroup.php" method="post">

	<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php
		echo $rowMembers["GroupName"];
		?></p>
		 
		<input type="hidden" name="gpID" value="<?php echo $rowMembers["GroupId"];?>" required>
		<input type="hidden" name="gpname" value="<?php echo $rowMembers["GroupName"];?>" required>
		<input type="submit" value="View"></form>
		</div>
</div></div>
</p>
		<?php
	
	}}
else{?>
		<p style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;"><?php echo "Not joined any group.<br>";	?></p><?php	

}
}
else{
	header("location:index.php");
}
?></body>
</html>