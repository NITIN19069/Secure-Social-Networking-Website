      <?php
session_start();
include "dbConnection.php";?>
<!DOCTYPE html>
<html>
<head>
	<style>
   
  body{
 background: #76b852;

  }
.card {
  box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.2);
  max-width: 500px;
  margin: auto;
  color: #fff;
  padding: 10px 10px;
  font-family: arial;
}

.title {
  color: grey;
  font-size: 18px;
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
</style>
</head>
<body>

<?php
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
   include "Header.php";
  if(isset($_GET["msg"])){
	   echo "Wrong password entered.Enter Again.<br>";
	   
   }?>
   <h2 class="hed"><?php echo "Settings";  ?></h2>
   <?php
   $select = "SELECT * FROM sign_up WHERE UserName = '$_SESSION[Username]'";
   $query = mysqli_query($con,$select);
   $row = mysqli_fetch_array($query);
   if ($row > 0){
	  ?>
	  <h2 style="color: #000;font-family: 'Roboto', sans-serif;padding: 0 510px;">Privacy Settings:</h2>
	  <div class="card" style="background:#619245;">

	  <form action="privacyChange.php" method="post"><b>Who may post on your timeline: </b><select name="Privacy">
																<option value="" disabled selected><?php echo $row["Privacy"] ?></option>
																<option value="OnlyMe">Only Me</option>
																<option value="All">Friends</option>
																</select><input type="submit"></form></div>
			<br><h2 style="color: #000;font-family: 'Roboto', sans-serif;padding: 0 510px;">Change Your Password:</h2>
			<div class="card" style="background:#619245;">
			<form action="changePassword.php" method="post">Enter previous Password  <input type="password" name="previous" required><br><br>
			Enter new password      <input type="password" name="new" required><br><br>
			<input type="submit" value="Change password"></form></div>			
<?php   }
}else{
	header("location:index.php");
	
}

?>
