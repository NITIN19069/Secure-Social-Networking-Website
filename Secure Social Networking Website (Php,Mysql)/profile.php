<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
   include "dbConnection.php";
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  .had {
  font-size: 20px;
  text-align: center;
  color: #fff;
  font-weight: 10;
  text-transform: capitalize;
  letter-spacing: 4px;
  font-family: 'Roboto', sans-serif;
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
  body{
 background: #76b852;

  }
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 500px;
  margin: auto;
  text-align: left;
  font-family: arial;
}

.title {
  color: grey;
  font-size: 18px;
}

.button {
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
h1 { 
  display: block;
  font-size: 3em;
  margin-top: 0.67em;
  margin-bottom: 0.67em;
  margin-left: 0;
  margin-right: 0;
  font-weight: bold;
}
</style>
</head>
<body><?php
include "header.php";?>
<h2 class="hed" style="text-align:center">User Profile </h2>

<div class="card" style="background:#619245;">
  <?php
  $select = "SELECT * FROM sign_up WHERE Username = '$_SESSION[Username]'";
  $query = mysqli_query($con,$select);
  $row = mysqli_fetch_array($query);
  ?>
  <h1 style="text-align:center;color: #fff;"><?php echo $row["UserName"];  ?></h1>
  <p class="title" style="padding: 10px;color: #fff;"><b>Name: </b><?php echo $row["FirstName"]."  ".$row["LastName"];?></p>
  <p class="title" style="padding: 10px;color: #fff;"><b>DOB: </b><?php echo $row["Birthday"] ?></p>
  <p class="title" style="padding: 10px;color: #fff;"><b>Gender: </b><?php $gen=$row["Gender"];
	if($gen=='M'){
		echo "Male";
		}
	else{
		echo "Female";
		} 
		?></p>
  <p class="title" style="padding: 10px;color: #fff;"><b>Type of User: </b><?php echo $row["Type_User"];
  if($row["Type_User"]=="Premium"){
	  echo " ( ".$row['Type_premium']." )";
  }
  
  ?>
  
  </p>
  
  <h3 style="text-align:center">Contact Details</h3>
  <p class="title" style="padding: 10px;color: #fff;"><b>Email: </b><?php echo $row["Email"] ?></p>
  <p class="title" style="padding: 10px;color: #fff;"><b>Mobile number: </b><?php echo $row["Phone"] ?></p>
  <p><a href="edit.php">
  <button class="button">Edit Profile</button></a></p>
</div>

</body>
</html>
<?php
}else{
	header("location:index.php");
	
}

?>