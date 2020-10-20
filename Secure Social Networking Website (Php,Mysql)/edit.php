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
.hideP{
  display: none;
}
.hideC{
	display: none;
	
}
</style>

</head>

<body><?php
include "header.php";?>

<h2 class="hed" style="text-align:center">Edit Profile </h2>

<div class="card" style="background:#619245;">
  <?php
  $select = "SELECT * FROM sign_up WHERE Username = '$_SESSION[Username]'";
  $query = mysqli_query($con,$select);
  $row = mysqli_fetch_array($query);
  ?><form action="update.php" method="post">
  <h1 style="text-align:center;color: #fff;"><?php echo $row["UserName"];  ?></h1>
  <p class="title" style="padding: 10px;color: #fff;"><b>Name: </b><?php echo $row["FirstName"]."  ".$row["LastName"];?></p>
  <p class="title" style="padding: 10px;color: #fff;"><b>DOB: </b> <input type="date" name="dob" value="<?php echo $row["Birthday"] ?>" required></p>
  <p class="title" style="padding: 10px;color: #fff;"><b>Gender: </b><?php $gen=$row["Gender"];
  if($gen=='M'){
    echo "Male";
    }
  else{
    echo "Female";
    } 
    ?></p>
  <p class="title" style="padding: 10px;color: #fff;"><b>Type of User: </b><select name="Type_User" value="<?php  echo $row["Type_User"]?>" id="usertype"
																				 onchange="java_script_:show(this.options[this.selectedIndex].value)">
                                    <option value="<?php  echo $row["Type_User"]?>" disabled selected><?php  echo $row["Type_User"]?></option>
                                    <?php
                                    if($row["Type_User"]=="Casual"){?>
                                    <option value="Casual">Casual</option>
                                    <option value="Premium">Premium</option>
                                    <option value="Commercial">Commercial</option></select></p><?php
                                    }
                                    else if($row["Type_User"]=="Premium"){?>
                                    <option value="Premium">Premium</option>
                                    <option value="Commercial">Commercial</option></select></p><?php
                                    }
                                    else {?>                                    
                                    <option value="Commercial">Commercial</option></select></p><?php
                                    }?>
						<div id="divPremium" class="hideP">
						<h4>Choose A Plan:<br><input type="radio" name="PremiumPlan" value="Silver" required>Silver: Can run at most 2 closed groups at a time.Price: Rs. 50 per month.<br>
												<input type="radio" name="PremiumPlan" value="Gold" required>Gold: Can run at most 4 closed groups at a time.Price: Rs. 100 per month<br>
												<input type="radio" name="PremiumPlan" value="Platinum" required>Platinum: Can run any number of groups.Price: Rs. 150 per month.</h4>
					</div>
					<div id="divCommercial" class="hideC">
						<h4>You need to pay Rs. 5000 per Year</h4>
					</div>
					<script> 
function show(aval) {
    if (aval == "Premium") {
		<?php if( $row["Type_User"]=="Premium" ){ ?>
		divPremium.style.display='none';
		divCommercial.style.display='none';<?php }else{ ?>
		divPremium.style.display='block';
		divCommercial.style.display='none';<?php  } ?>
    } 
    else if(aval=='Commercial'){
		<?php if( $row["Type_User"]=="Commercial" ){ ?>
		divPremium.style.display='none';
		divCommercial.style.display='none';<?php }
		else{
			?>
		divPremium.style.display='none';
		divCommercial.style.display='block';<?php  } ?>
    }
	else{
		divPremium.style.display='none;'
		divCommercial.style.display='none';
		
	}
  }
</script>
  <h3 style="text-align:center">Contact Details</h3>
  <p class="title" style="padding: 10px;color: #fff;"><b>Email: </b><?php echo $row["Email"] ?></p>
  <p class="title" style="padding: 10px;color: #fff;"><b>Mobile number: </b><input type="text" name="phno" value="<?php echo $row["Phone"] ?>" required></p>
  <input type="hidden" name="Email" value="<?php echo $row["Email"] ?>" required >
  <p><button  class="button">Save</button></p>
  </form>
</div>

</body>
</html>
<?php
}else{
  header("location:index.php");
  
}
?>