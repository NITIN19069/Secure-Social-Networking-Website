	<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
	include "header.php";
   include "dbConnection.php";
   if(isset($_GET{'error1'})){
	echo "Please select a friend!";
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
<script>
function CheckSelect(){
	var Select=document.getElementById("name").value;
	if(Select=="OYE"){
		alert("Select Friends First.");
		return false;
	}
	else{
		return true;
	}
	
}
</script>
</head>
<body>
   <?php
   $groupName=$_POST["gpname"];
   $gpID=$_POST["gpID"];?>
   <h1 style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 800px;"><?php echo $groupName;?></h1>
   <h2 style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;"><?php echo "Add Friends:<br>"; ?></h2><?php  
$select="Select Receiver from friends where Sender='$_SESSION[Username]' Except select MemberName from groupmembers where GroupId='$gpID'";
$query = mysqli_query($con,$select);
if (mysqli_num_rows($query) > 0)
{?>
	<p class="tweet-body">
		<div class="row">
  <div class="column">
    <div class="card">
	<form action="AddToGroup.php" method="post"><select name="Friend" id="name">
<option value="OYE"disabled selected>SELECT FRIENDS</option>
<?php
while($row=mysqli_fetch_array($query))
{
$fname=$row['Receiver'];
?><option value="<?php echo $fname;?>"><?php echo $fname;?></option><?php
}?>
</select>
		<input type="hidden" name="gpID" value="<?php echo $gpID;?>">
		<input type="hidden" name="gpname" value="<?php echo $groupName;?>"><br><br>
<input type="submit" onclick="return CheckSelect()"></form>
		</div>
</div></div>
</p>
<?php
}
else{
	?><p style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;"><?php 
	echo "No more friends to add to group<br>";?></p><?php
}?>
<br>
   <h2 style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;"><?php echo "Join Requests:<br>";?></h2><?php  
$selectRequests="Select * from grouprequest where GroupId='$gpID'";
$queryrequests = mysqli_query($con,$selectRequests);
if (mysqli_num_rows($queryrequests) > 0){
	while($row=mysqli_fetch_array($queryrequests)){?>
		<p class="tweet-body">
		<div class="row">
  <div class="column">
    <div class="card">
	<form action="AcceptToGroup.php" method="post">
	
		<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo $row["UserName"];?></p>
		
		<input type="hidden" name="User" value="<?php echo $row["UserName"];?>">
		<input type="hidden" name="gpID" value="<?php echo $gpID;?>">
		<input type="hidden" name="gpname" value="<?php echo $groupName;?>">
		<input type="submit" value="Accept"></form>
		</div>
</div></div>
</p><?php
	}
}else{?>
	
	<p style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;"><?php echo "No current requests<br><br>";?></p><?php
}
?>
   <h2 style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;"><?php echo "Members:";?></h2><?php  
$selectMembers="Select * from groupmembers where GroupId='$gpID'";
$queryMembers = mysqli_query($con,$selectMembers);
if (mysqli_num_rows($queryMembers) > 0){
	while($rowMembers=mysqli_fetch_array($queryMembers)){?>
		<p class="tweet-body">
		<div class="row">
  <div class="column">
    <div class="card">

	<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo $rowMembers["MemberName"]."<br>";?></p>
	</div>
</div></div>
</p><?php
	}}
else{?>
	
	<p style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;"><?php echo "No members yet."; ?></p><?php
}


}
else{
	header("location:index.php");
}
?>
</body>
</html>
