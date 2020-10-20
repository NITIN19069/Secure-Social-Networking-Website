<?php
session_start();
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
include "dbConnection.php";
include "Header.php";
if(isset($_GET{'error'})){
	echo "Please select a friend!";
}
//$FirstName = $_POST['FirstName'];

?>
<html>
<style>
	.tweet-body {
        display: flex;
        justify-content: center;
            }
    
    body{
 background: #76b852;

  }
  ::placeholder {
  	font-size: 2em;
  color: #fff;
  opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
 color: #fff;
 font-size: 2em;
}

::-ms-input-placeholder { /* Microsoft Edge */
 color: #fff;
 font-size: 2em;
}

</style>


<?php
$select = "Select * from sign_up where UserName='$_SESSION[Username]'";
$check=mysqli_query($con,$select);
$rowCheck=mysqli_fetch_array($check);
if($rowCheck['Type_User']=="Casual"){
	header("location:Home.php?x=?");
}
else if($rowCheck['Type_User']=="Commercial"){
?>
<div>
<form method="post" enctype="multipart/form-data" action="checkMessage.php" >
	<br>
	<br>
<p class="tweet-body">
<select name="Receiver" style="background-color:#000;color: #fff;  ">
<option>SELECT FRIENDS</option>
<?php
$query="SELECT UserName from sign_up Except Select UserName from sign_up where UserName = '$_SESSION[Username]'";
$result=mysqli_query($con,$query);
if($result)
{
while($row=mysqli_fetch_array($result))
{
$fname=$row['UserName'];
echo "<option>".$fname."<br></option>";
}
}
?>
</p></select></div><br><br>
<p class="tweet-body">
<!--<div class="tweet-body">-->
<textarea class="message" name="message" placeholder="Write your message here!" rows="15" cols="60" style="background:#619245;" required></textarea> 
</p>
<br>
<br>

<p class="tweet-body">
<input type="submit" value="SEND MESSAGE" action="checkMessage.php" >
</p>
</form>

<?php
}
else{?><div>
<form method="post" enctype="multipart/form-data" action="checkMessage.php" >
	<br>
	<br>
<p class="tweet-body">
<select name="Receiver" style="background-color:#000;color: #fff;  ">
<option>SELECT FRIENDS</option>
<?php
$query="SELECT Receiver from friends where Sender = '$_SESSION[Username]'";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result) > 0)
{
while($row=mysqli_fetch_array($result))
{
$fname=$row['Receiver'];
echo "<option>".$fname."<br></option>";
}
}
else{
	header("location:Home.php?msg=%v	");
}
?>
</p></select></div><br><br>
<p class="tweet-body">
<!--<div class="tweet-body">-->
<textarea class="message" name="message" placeholder="Write your message here!" rows="15" cols="60" style="background:#619245;" required></textarea> 
</p>
<br>
<br>

<p class="tweet-body">
<input type="submit" value="SEND MESSAGE" action="checkMessage.php" >
</p>
</form><?php
}
}
else{
	header("location:index.php");
	} 
?></html>