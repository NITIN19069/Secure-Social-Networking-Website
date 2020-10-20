<html>
<head>
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
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
	
   include "dbConnection.php";
   include "header.php";
   if(isset($_GET['msg'])){
		if($_GET['msg']=="???"){
			echo "Request Deleted";	
		}
		else if($_GET['msg']=="A"){
			echo "Not Enough Balance in Wallet. Add Money";
		}
		else{
		echo "Request to join group sent.";
	}}
    $select = "SELECT * FROM groupinfo Except Select * from groupinfo where Admin='$_SESSION[Username]'";
	$query = mysqli_query($con,$select);
if(mysqli_num_rows($query) > 0){	
while($row = mysqli_fetch_array($query)){
		
	   if($row['Type']=="open"){
		  
			$check="Select * from grouprequest where GroupId='$row[GroupId]' And UserName='$_SESSION[Username]'";
			$queryCheck=mysqli_query($con,$check);
			if(mysqli_num_rows($queryCheck) > 0){?>
					<p class="tweet-body">
		<div class="row">
  <div class="column">
    <div class="card">
		 <p style="color: #fff;font-family: 'Roboto', sans-serif;font-size: 25px;"><?php echo $row['GroupName'];?></p>
		 <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "ADMIN: ".$row['Admin'];?></p>
		<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Type: ".$row['Type'];?></p>
		<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Number of members: ".$row['GroupMember'];?></p>
		<?php if($row['Privacy']=='paid'){
			?>
			<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Amount: ".$row['Amount'];?></p>
			<?php
		} ?>
				<form action="DeletejoinRequest.php" method="post">
			<input type="hidden" name="GId" value="<?php echo $row['GroupId']; ?>">
			<input type="submit" value="Delete Request To Join Group"></form>
			</div>
</div></div>
</p>
				<?php
			}
			else{
				 $SAlreadyJoined="Select * from groupmembers where GroupId='$row[GroupId]' And MemberName='$_SESSION[Username]'";
	  $QJoined=mysqli_query($con,$SAlreadyJoined);
	  if(mysqli_num_rows($QJoined) > 0){
		  
		 ?> 
		 <input type="hidden">
		  <?php  
	  }else{			
				if($row['Privacy']=="free"){?>
					<p class="tweet-body">
		<div class="row">
  <div class="column">
    <div class="card">
		 <p style="color: #fff;font-family: 'Roboto', sans-serif;font-size: 25px;"><?php echo $row['GroupName'];?></p>
		 <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "ADMIN: ".$row['Admin'];?></p>
		<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Type: ".$row['Type'];?></p>
		<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Number of members: ".$row['GroupMember'];?></p>
					<form action="joinRequest.php" method="post">
					<input type="hidden" name="Receiver" value="<?php echo $row['GroupName']; ?>">
					<input type="hidden" name="GId" value="<?php echo $row['GroupId']; ?>">
					<input type="hidden" name="GAdmin" value="<?php echo $row['Admin']; ?>">
					<input type="submit" value="Request To Join Group"></form>
					</div>
</div></div>
</p>
					<?php
				}
				else{?>
					<p class="tweet-body">
		<div class="row">
  <div class="column">
    <div class="card">
		 <p style="color: #fff;font-family: 'Roboto', sans-serif;font-size: 25px;"><?php echo $row['GroupName'];?></p>
		 <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Admin: ".$row['Admin'];?></p>
		<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Type: ".$row['Type'];?></p>
		<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Number of members: ".$row['GroupMember'];?></p>
		<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Amount: ".$row['Amount'];?></p>
				
				<form action="joinRequest.php" method="post">
				<input type="hidden" name="Receiver" value="<?php echo $row['GroupName']; ?>">
				<input type="hidden" name="GId" value="<?php echo $row['GroupId']; ?>">
				<input type="hidden" name="Amt" value="<?php echo $row['Amount']; ?>">
				<input type="submit" value="Request To Join Group"></form>
				</div>
</div></div>
</p>
				<?php
				}
			}
			}   }
	   else{?>
					<p class="tweet-body">
		<div class="row">
  <div class="column">
    <div class="card">
		 <p style="color: #fff;font-family: 'Roboto', sans-serif;font-size: 25px;"><?php echo $row['GroupName'];?></p>
		 <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "ADMIN: ".$row['Admin'];?></p>
		<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Type: ".$row['Type'];?></p>
		<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Number of members: ".$row['GroupMember'];?></p>
		<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Group closed";?></p>
		</div>
</div></div>
</p><?php
		}
	 
	 }
}
else{?>

	<p style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;"><?php echo "No groups";?></p><?php
}}
else{
	header("location:index.php");
}
?></body></html>