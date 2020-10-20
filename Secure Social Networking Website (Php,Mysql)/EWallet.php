<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
	include "header.php";
   include "dbConnection.php";
   if(isset($_GET{'succ'})){
 echo "Money Sent Successfully";  }
   
if(isset($_GET{'msg'})){
	if($_GET['msg']=='??'){
		echo "Money request not Sent.";
	}
		else{
		echo "Money Request Sent.";}
}
if(isset($_GET{'m'})){
	echo "Not enough Money";
}
if(isset($_GET{'err'})){
	echo "Not enough Money";
}
if(isset($_GET{'amt'})){
	echo "Money Added Successfully";
}
if(isset($_GET{'amtfailed'})){
	echo "Incorrect Pin, Payment Failed";
}
$verified="SELECT * FROM ewallet where UserName='$_SESSION[Username]'";
$query3=mysqli_query($con,$verified);
$row3= mysqli_fetch_array($query3);
if($row3['verifypin']=="No")
{
	header("Location:setpin.php");
	
}
?>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  .btn-group button {
  background-color: #4CAF50; /* Green background */
  border: 1px solid green; /* Green border */
  color: white; /* White text */
  padding: 10px 24px; /* Some padding */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
}

/* Clear floats (clearfix hack) */
.btn-group:after {
  content: "";
  clear: both;
  display: table;
}

.btn-group button:not(:last-child) {
  border-right: none; /* Prevent double borders */
}

/* Add a background color on hover */
.btn-group button:hover {
  background-color: #3e8e41;
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 700px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
</style>
</head>
<body>

<h2 style="text-align:center">E-Wallet</h2>
<?php 
$select1 = "SELECT * FROM requestmoney WHERE Receiver = '$_SESSION[Username]'";
$query1 = mysqli_query($con,$select1);
if (mysqli_num_rows($query1) > 0){
?>
<h3>Money Requests</h3>
<?php
while($row1 = mysqli_fetch_array($query1))
{
	?><h3><?php echo $row1["Sender"]; ?></h3>
	Amount Requested:<?php echo $row1["Amount"]; ?>
      <form action="sendRequestedMoney.php" method="post">
	  <input type="hidden" name="Sender" value="<?php echo  $row1["Sender"]; ?>" required>
	  <input type="hidden" name="Amount" value="<?php echo  $row1["Amount"]; ?>" required>
	  <input type="hidden" name="TransID" value="<?php echo  $row1["RMId"]; ?>" required>
	  <input type="submit" value="Accept"></form><?php
	
}

}
?>
<div class="card">
  
  <h3>Total Balance-  
  <?php 
  $select = "SELECT * FROM ewallet WHERE Username = '$_SESSION[Username]'";
  $query = mysqli_query($con,$select);
  $row = mysqli_fetch_array($query);
  echo $row['Amount'];
  ?></h3>
  <div class="btn-group">
  <a href="RequestMoney.php"><button style="width:50%">Request</button></a>
  
  <a href="walletPay.php"><button style="width:50%">Pay</button></a>
</div>
     <p>History </p>
	 <?php
	 $History="Select * from transaction where Sender='$_SESSION[Username]' Or Receiver ='$_SESSION[Username]'";
	 $result=mysqli_query($con,$History);
	if(mysqli_num_rows($result)> 0){ ?>
	<table>
	<tr>
	<td>Transaction With  </td>
	<td>Credit </td>
	<td>Debit </td>
	<td>Time </td>
	</tr>
	<?php
		while($rowH=mysqli_fetch_array($result)){ ?>
		<tr>
		<?php
		if($rowH['Sender']==$rowH['Receiver']){
			?>
			<td>Money Added</td>
			<td><?php echo $rowH['Amount'];?></td>
			<td></td>
			<?php
			
		}
		else if($rowH['Sender']==$_SESSION['Username']){
			?>
			<td><?php echo $rowH['Receiver'];?></td>
			<td></td>
			<td><?php echo $rowH['Amount'];?></td>
			<?php
		}
	else{
		?>
		<td><?php echo $rowH['Sender'];?></td>
		<td><?php echo $rowH['Amount'];?> </td>
		<td> </td>
		<?php
	} ?>
	<td><?php echo $rowH['Timestamp'];?></td>
	</tr>
	<?php
	} 
	?></table><?php
	}
	else
	{
		echo "No transactions yet.";
		}
	 ?>
 
  <p><a href="AddMoney.php"><button>Add Money</button></a></p>
</div>

</body>
</html>
<?php
}else{
  header("location:index.php");
  
}

?>