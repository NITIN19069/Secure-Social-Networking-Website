
<?php 
session_start();
include "dbConnection.php";
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
	include "Header.php";
$user=$_SESSION["Username"];
$select = " SELECT * FROM friend_post where R_userid='$user' group by timestamp DESC";
$query = mysqli_query($con,$select);
while($row = mysqli_fetch_array($query))
{ 
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
</style>
<div class="tweet-body">

<form method="post" enctype="multipart/form-data" >
	<br>
	<textarea class="status" name="status" required="" placeholder="Write your post here!" rows="4" cols="50" style="background:#619245;color:#fff;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);font-size: 1.5em; "><?php echo $row["S_userid"].":\n";
	echo $row["status"]; ?>
	</textarea> <br><br>
	</form>
</div>
</html><?php }}
else{
	header("location:index.php");
	} 
 ?>
 <style>
	
    body{
 background: #76b852;

  }
</style>