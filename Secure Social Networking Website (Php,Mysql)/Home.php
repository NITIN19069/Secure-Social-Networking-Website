<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
   
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
 * {
  box-sizing: border-box;
}

body {
  background: #76b852;
   background: -webkit-linear-gradient(to top, #76b852, #8DC26F);
  background: -moz-linear-gradient(to top, #76b852, #8DC26F);
  background: -o-linear-gradient(to top, #76b852, #8DC26F);
  background: linear-gradient(to top, #76b852, #8DC26F);
  background-size: cover;
  background-attachment: fixed;
  font-family: 'Roboto', sans-serif;
  text-align:center;
}
.hed {

  font-size: 3em;
  text-align: center;
  color: #fff;
  font-weight: 100;
  text-transform: capitalize;
  letter-spacing: 4px;
  font-family: 'Roboto', sans-serif;
}
.had {
  font-size: 20px;
  text-align: center;
  color: #fff;
  font-weight: 10;
  text-transform: capitalize;
  letter-spacing: 4px;
  font-family: 'Roboto', sans-serif;
}
.column {
  width: 450px;
  height:590px;
  padding: 0 10px;
}

/* Remove extra left and right margins, due to padding */
.row {margin: 0 -5px;}

.card {
  width:430px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color: #619245;
}
  
h1 { 
  display: block;
  font-size: 1em;
  margin-top: 0.67em;
  margin-bottom: 0.67em;
  margin-left: 0;
  margin-right: 0;
  font-weight: bold;
}
</style>

</head>
<body><?php
include "header.php";

?>
<h1 style="text-align:right"><?php
echo $_SESSION["Username"];
?></h1>
<?php
if(isset($_GET['msg'])){
	if($_GET['msg']=='%v'){echo "You don't have friends to send message.";}
else{echo "Friend request send";}}
if(isset($_GET['m'])){echo "Friend request deleted";}
if(isset($_GET['u'])){echo "Profile not updated";}
if(isset($_GET['x'])){echo "To send messages upgrade to premium or commercial user.";}
?>
<h2 class="hed" style="text-align:center;">Home-Page</h2>
  <div class="column" style="background:#619245;margin-left:550px;" >
    <div class="card">
    <h4 class="had"><b>PROFILE</b></h4> 
    <a href="profile.php"style="color: #fff;text-decoration:none;">View Profile</a><br>
    <a href="edit.php"style="color: #fff;text-decoration:none;">Edit Profile</a>
  </div>
<br>
    <div class="card">
  <h3 class="had"> <b>MESSAGE </b></h3>
     <a href="ListPm.php"style="color: #fff;text-decoration:none;">Inbox</a><br>
	 <a href="CompMsg.php"style="color: #fff;text-decoration:none;">Compose</a>
</div>
<br>  
    <div class="card">
    <h3 class="had"> <b>FRIENDS </b></h3>
<a href="friends.php" style="color: #fff;text-decoration:none;">Friends List</a>
</div>
<br>
    <div class="card">
    <h3 class="had"><b>NEWS FEED</b></h3>
    <a href="viewPost.php"style="color: #fff;text-decoration:none;">View Feed</a><br>
    <a href="PostStatus.php"style="color: #fff;text-decoration:none;">Post Status</a>
</div>
</div>
<br>
</body>
</html>

<?php
}else{
	header("location:index.php");
	
}

?>
