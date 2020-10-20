<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
include "Header.php";
include "dbConnection.php";
$FirstName= $_POST['firstname'];
$GroupName=$_POST['firstname'];
?><!DOCTYPE html>
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
  width: 30%;
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
<body>
<?php
$select = "SELECT * FROM sign_up where FirstName='$FirstName' Except Select * From sign_up where UserName='$_SESSION[Username]'";
$query = mysqli_query($con,$select);
if (mysqli_num_rows($query) > 0)
{?>
<h2 style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;">Related People Search</h2>
<?php

while($row = mysqli_fetch_array($query))
{ 
$select2 = "SELECT * FROM friends where Sender='$_SESSION[Username]' And Receiver='$row[UserName]'";
$query2 = mysqli_query($con,$select2);
if (mysqli_num_rows($query2) > 0){?>
  <p class="tweet-body">
<div class="row">
  <div class="column">
    <div class="card">
      <h3 style="color: #fff;font-family: 'Roboto', sans-serif;font-size: 25px;"><?php echo $row['UserName']; ?></h3>
      <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo $row['FirstName']." ".$row['LastName'];?></p>
      <form action="viewprofile.php" method="post">
	  <input type="hidden" name="Receiver" value="<?php echo $row['UserName']; ?>">
	  <input type="submit" value="View Profile"></form>
    </div>
  </div>
</div>	
	</p>
<?php }else{
$select3 = "SELECT * FROM friendrequest where Sender='$_SESSION[Username]' And Receiver='$row[UserName]'";
$query3 = mysqli_query($con,$select3);
if (mysqli_num_rows($query3) > 0){	
?>
<p class="tweet-body">
<div class="row">
  <div class="column">
    <div class="card">
      <h3 style="color: #fff;font-family: 'Roboto', sans-serif;font-size: 25px;"><?php echo $row['UserName']; ?></h3>
      <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo $row['FirstName']." ".$row['LastName'];?></p>
      <form action="deleteRequest.php" method="post">
	  <input type="hidden" name="Receiver" value="<?php echo $row['UserName']; ?>">
	  <input type="submit" value="Friend Request Sent.Delete request."></form>
    </div>
  </div>
</div>	
	</p>
<?php }else{?>
  <p class="tweet-body">
<div class="row">
  <div class="column">
    <div class="card">
      <h3 style="color: #fff;font-family: 'Roboto', sans-serif;font-size: 25px;"><?php echo $row['UserName']; ?></h3>
      <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo $row['FirstName']." ".$row['LastName'];?></p>
      <form action="sentRequest.php" method="post">
	  <input type="hidden" name="Receiver" value="<?php echo $row['UserName']; ?>">
	  <input type="submit" value="Add friend"></form>
    </div>
  </div>
</div>
</p>
<?php }}}}else{?>

  <p style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;"><?php echo "No user found";?></p><?php
}
?><h2 style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;">Related Group Search</h2>
<?php 
$selectG = "SELECT * FROM groupinfo where GroupName = '$GroupName' Except Select * from groupinfo where Admin='$_SESSION[Username]'";
$queryG = mysqli_query($con,$selectG);
if (mysqli_num_rows($queryG) > 0)
{	
while($rowG=mysqli_fetch_array($queryG)){?>

  <?php
  $sPay="Select * from paytogroup where GpId='$rowG[GroupId]' And Member='$_SESSION[Username]'";
  $queryPay=mysqli_query($con,$sPay);
  if(mysqli_num_rows($queryPay) > 0){
	  $rowPay=mysqli_fetch_array($queryPay);
	 ?> <p class="tweet-body">
<div class="row">
  <div class="column">
    <div class="card">
      <form action="PINofEwallet.php" method="post">
	  <p style="color: #fff;font-family: 'Roboto', sans-serif;font-size: 25px;"><?php echo $rowG['GroupName'];?></p>
  <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Admin: ".$rowG['Admin'];?></p>
    <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Type: ".$rowG['Type'];?></p>
  <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Number of members: ".$rowG['GroupMember'];?></p>
    <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Amount: ".$rowG['Amount'];?></p>
		</p>
		<input type="hidden" name="GAdmin" value="<?php echo $rowPay["Admin"];?>">
		<input type="hidden" name="gpID" value="<?php echo $rowPay["GpId"];?>">
		<input type="hidden" name="gpname" value="<?php echo $rowG["GroupName"];?>">
		<input type="hidden" name="Amount" value="<?php echo $rowG["Amount"];?>">
		<input type="submit" value="Pay"></form>
      </div>
  </div>
</div>
</p>
	  <?php
  }
  else{
	  $SAlreadyJoined="Select * from groupmembers where GroupId='$rowG[GroupId]' And MemberName='$_SESSION[Username]'";
	  $QJoined=mysqli_query($con,$SAlreadyJoined);
	  if(mysqli_num_rows($QJoined) > 0){
		  
		 ?> <p class="tweet-body">
<div class="row">
  <div class="column">
    <div class="card">
      <p style="color: #fff;font-family: 'Roboto', sans-serif;font-size: 25px;"><?php echo $rowG['GroupName'];?></p>
  <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Admin: ".$rowG['Admin'];?></p>
    <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Type: ".$rowG['Type'];?></p>
  <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Number of members: ".$rowG['GroupMember'];?></p>
  <?php if($rowG['Privacy']=='paid'){
	  ?> <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Amount: ".$rowG['Amount'];?></p><?php
  } ?>
  <form action="ViewGroup.php" method="post">		 
		<input type="hidden" name="gpID" value="<?php echo $rowG["GroupId"];?>">
		<input type="hidden" name="gpname" value="<?php echo $rowG["GroupName"];?>">
		<input type="submit" value="View"></form>
      </div>
  </div>
</div>
</p>
		  <?php
		  
		  
		  
	  }
	  
	  else{
	   if($rowG['Type']=="open"){
	   $check="Select * from grouprequest where GroupId='$rowG[GroupId]' And UserName='$_SESSION[Username]'";
		$queryCheck=mysqli_query($con,$check);
		if(mysqli_num_rows($queryCheck) > 0){?>
      <p class="tweet-body">
<div class="row">
  <div class="column">
    <div class="card">
      <p style="color: #fff;font-family: 'Roboto', sans-serif;font-size: 25px;"><?php echo $rowG['GroupName'];?></p>
  <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Admin: ".$rowG['Admin'];?></p>
    <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Type: ".$rowG['Type'];?></p>
  <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Number of members: ".$rowG['GroupMember'];?></p>
  <?php if($rowG['Privacy']=='paid'){
	  ?> <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Amount: ".$rowG['Amount'];?></p><?php
  } ?>
  
				<form action="DeletejoinRequest.php" method="post">
			<input type="hidden" name="GId" value="<?php echo $row['GroupId']; ?>">
			<input type="submit" value="Delete Request To Join Group"></form>
      </div>
  </div>
</div>
</p>
				<?php
				}
			else{
		if($rowG['Privacy']=="free"){
			?><p class="tweet-body">
<div class="row">
  <div class="column">
    <div class="card">
      <p style="color: #fff;font-family: 'Roboto', sans-serif;font-size: 25px;"><?php echo $rowG['GroupName'];?></p>
  <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Admin: ".$rowG['Admin'];?></p>
    <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Type: ".$rowG['Type'];?></p>
  <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Number of members: ".$rowG['GroupMember'];?></p>
		<form action="joinRequest.php" method="post">
		<input type="hidden" name="Receiver" value="<?php echo $rowG['GroupName']; ?>">
		<input type="hidden" name="GId" value="<?php echo $rowG['GroupId']; ?>">
		<input type="submit" value="Request To Join Group"></form>
    </div>
  </div>
</div>
</p>
		<?php
		}
		else{?>
      <p class="tweet-body">
<div class="row">
  <div class="column">
    <div class="card">
<p style="color: #fff;font-family: 'Roboto', sans-serif;font-size: 25px;"><?php echo $rowG['GroupName'];?><br></p>
  <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Admin: ".$rowG['Admin'];?></p>
    <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Type: ".$rowG['Type'];?></p>
  <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Number of members: ".$rowG['GroupMember'];?></p>
		<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Amount ".$rowG['Amount'];?></p>
		<form action="joinRequest.php" method="post">
		<input type="hidden" name="Receiver" value="<?php echo $rowG['GroupName']; ?>">
		<input type="hidden" name="GId" value="<?php echo $rowG['GroupId']; ?>">
		<input type="hidden" name="Amt" value="<?php echo $rowG['Amount']; ?>">
		<input type="submit" value="Request To Join Group"></form>
    </div>
  </div>
</div>
</p>
		<?php
			}}
	}else{?>
    <p class="tweet-body">
<div class="row">
  <div class="column">
    <div class="card">
    <p style="color: #fff;font-family: 'Roboto', sans-serif;font-size: 25px;"><?php echo $rowG['GroupName'];?><br>
  <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Admin: ".$rowG['Admin'];?></p>
    <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Type: ".$rowG['Type'];?></p>
  <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Number of members: ".$rowG['GroupMember'];?></p>
		<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Group closed";?><br></p>
    </div>
  </div>
</div>
</p><?php
  }
  }
  
  } }
}
else{?>
	<p style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;"><?php echo "No groups";?></p><?php
}?>
</body>
</html>
<?php
}
else{
  header("location:index.php");
  }
?>