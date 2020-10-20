<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
	include "header.php";
    include "dbConnection.php";
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
.card1{
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 500px;
  background-color: #619245;
  margin: auto;
  text-align: center;
  font-family: 'Roboto', sans-serif;
  padding: 10px 0;
}
</style>
</head>
<body>
   <?php
	$GPID=$_POST["gpID"]; 
	$GPName=$_POST["gpname"];
	$select="Select * from groupinfo where GroupId='$GPID'";
	$query = mysqli_query($con,$select);
		$row=mysqli_fetch_array($query);
		?>
		<br>
		<div class="card1">
		<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "Group Name: ".$row["GroupName"];?></p>
		<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "<br>Admin: ".$row["Admin"];?></p>
		<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "<br>Type: ".$row["Type"];?></p>
		 <p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "<br>Privacy: ".$row["Privacy"];?></p>
		 <?php if($row["Privacy"]=="paid"){
			 ?><p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "<br>Amount: ".$row["Amount"];?></p><?php
			 } ?>
		<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo "<br>Number of members: ".$row["GroupMember"];?></p>
		</div>

		<h2 style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 100px;"><?php echo "Members:";?></h2><?php  
		$selectMembers="Select * from groupmembers where GroupId='$GPID'";
		$queryMembers = mysqli_query($con,$selectMembers);
		if (mysqli_num_rows($queryMembers) > 0){
				while($rowM=mysqli_fetch_array($queryMembers)){?>
		<p class="tweet-body">
		<div class="row">
  <div class="column">
    <div class="card">

	<p style="color: #fff;font-family: 'Roboto', sans-serif;"><?php echo $rowM["MemberName"]."<br>";?></p>
	</div>
</div></div>
</p>
<?php
			}
	}
	 }
else{
	header("location:index.php");
}
?>
</body>
</html>