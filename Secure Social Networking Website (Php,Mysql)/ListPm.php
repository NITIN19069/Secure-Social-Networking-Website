<?php
session_start();
include "dbConnection.php";
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
	include "Header.php";
$user=$_SESSION["Username"];
?>
<html>
<br>
<style>
	.tweet-body {
        display: flex;
        justify-content: center;
            }
    
    body{
 background: #76b852;

  }
</style>
<?php
//$receiver = $_POST['message'];
$select = "SELECT * FROM pmessage where S_userID='$user' UNION SELECT * FROM pmessage where R_userID='$user' order by timestamp DESC ";

$query = mysqli_query($con,$select);
if (mysqli_num_rows($query) > 0) {
while($row = mysqli_fetch_array($query))
{ 

?>

<div class="tweet-body">
<form method="post" enctype="multipart/form-data" >
	<textarea class="message" name="message" required="" placeholder="Write your message here!" rows="4" cols="50" style="background:#619245;color:#fff;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);font-size: 1.5em; "><?php echo $row['S_userID']; echo " --> "; echo $row['R_userID'];echo "\n";?>	<?php echo $row['message']; ?>
	</textarea> <br>

	</form>
</div>
<?php
}}
else{
	echo "You have no message";	
}
}

else{
	
	header("location:index.php");
	} 
?>
 
