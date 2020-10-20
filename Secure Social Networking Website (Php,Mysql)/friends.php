<?php

session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
   
include "header.php";
include "dbConnection.php";
?>
<!DOCTYPE html>
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
<body>
	<?php

$select1 = "SELECT * FROM friendrequest WHERE Receiver = '$_SESSION[Username]'";
$query1 = mysqli_query($con,$select1);
if (mysqli_num_rows($query1) > 0){
	?>
  
	<h2 style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;">Friend Requests</h2>

	<?php
	while($row1 = mysqli_fetch_array($query1))
{ ?>
	<div class="row">
  <div class="column">
    <div class="card">
      <h3><?php echo $row1["Sender"]; ?></h3>
      <form action="acceptRequest.php" method="post">
	  <input type="hidden" name="Sender" value="<?php echo  $row1["Sender"]; ?>" required>
	  <input type="submit" value="Accept"></form>
    </div>
  </div>
</div><?php
}}
$select = "SELECT * FROM friends WHERE Sender = '$_SESSION[Username]'";
$query = mysqli_query($con,$select);
if (mysqli_num_rows($query) > 0)
{?>
	<h2 style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;">Friends</h2>
	<?php
	while($row = mysqli_fetch_array($query))
{?>
     <p class="tweet-body">
<div class="row">
  <div class="column">
    <div class="card">
      <h3 style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo $row["Receiver"]; ?></h3>
     
	  <?php
	  $Casual="Select * from sign_up where UserName='$_SESSION[Username]'";
	  $CQuery=mysqli_query($con,$Casual);
	  $rowCasual = mysqli_fetch_array($CQuery);
	  $type=$rowCasual['Type_User'];
	  if($type=='Casual'){ ?><input type="hidden"> <?php }
	  else{
	  ?> <form action="smessage.php" method="post">
	  <input type="hidden" name="Receiver" value="<?php echo  $row["Receiver"]; ?>" required>
	  <input type="submit" value="Message"></form>
	  <?php } ?>
	  <form action="viewprofile.php" method="post">
	  <input type="hidden" name="Receiver" value="<?php echo  $row["Receiver"]; ?>" required>
	  <input type="submit" value="View Profile" required></form>
	  <form action="unfriend.php" method="post">
	  <input type="hidden" name="Receiver" value="<?php echo  $row["Receiver"]; ?>" required>
	  <input type="submit" value="Unfriend"></form>
	  
	   <?php
	  $check="Select Privacy from sign_up where Username='$row[Receiver]'";
	  $queryCheck = mysqli_query($con,$check);
	  $row1= mysqli_fetch_array($queryCheck);
		  if($row1["Privacy"]=="All"){?>
	  <form action="postFriendStatus.php" method="post">
	  <input type="hidden" name="Receiver" value="<?php echo  $row["Receiver"]; ?>" required>
	  <input type="submit" value="Post to Timeline"></form>
	  <?php } 
	  ?>
    </div>
  </div>
</div> 
</p>
	<?php
}}
else{?>
	<p style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;"><?php echo "You have no friends";?></p><?php
	
}
}else{
	header("location:index.php");
}
?>