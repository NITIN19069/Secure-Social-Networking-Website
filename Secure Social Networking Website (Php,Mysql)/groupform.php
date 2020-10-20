<?php

session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
   include "header.php";
   include "dbConnection.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  
body { background: #76b852;}
* {box-sizing: border-box;}

.new, select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #000;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

.new1{
  background-color: #000;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #619245;
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 500px;
  background-color: #619245;
  margin: auto;
  padding: 10px 15px;
  font-family: 'Roboto', sans-serif;
}

 ::placeholder {
    font-size: 1em;
  color: #fff;
  opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
 color: #fff;
 font-size: 1em;
}

::-ms-input-placeholder { /* Microsoft Edge */
 color: #fff;
 font-size: 1em;
}
</style> 
<script>
function showFree(){
    document.getElementById('divPaid').style.display ='none';
}
function showPaid(){
  document.getElementById('divPaid').style.display = 'block';
  }


</script>
<style>
.hide{
  
  display: none;
}
</style>
</head>
<body>
<?php
  $select = "SELECT * FROM sign_up WHERE Username = '$_SESSION[Username]'";
  $query = mysqli_query($con,$select);
  $row = mysqli_fetch_array($query);
  $flag=1;
  $count=0;
  $typeUser=$row['Type_User'];
  $type=$row['Type_premium'];
  if($typeUser=='Premium'&& $type!='Platinum'){
	$group = "SELECT * FROM groupinfo WHERE Admin = '$_SESSION[Username]'";
  $queryGroup = mysqli_query($con,$group);
  while($rowGroup = mysqli_fetch_array($queryGroup)){$count=$count+1;}
  if($type=="Silver"){
	  if($count >= 2) {$flag=0;}
	  } 
	  else if($type=="Gold"){
	  if($count >= 4) {$flag=0;}
	  }
 }
if($flag==0){
	header("location:group.php?msg=?????");
}
else{

?>
<h2 style="color: #fff;font-family: 'Roboto', sans-serif;padding: 0 650px;">Create New Group</h2><br>

<div class="card">
  <form action="createGroup.php" method="post" style="color: #fff;font-family: 'Roboto', sans-serif;">
    <label >Group Name</label>
    <input class="new" type="text"  placeholder="Your group name.." name="GroupName" style="background-color: #619245;" required><br>
  <label >Privacy</label><br><br>
    <input type="radio" name="PrivacyOfGroup" value="free" onClick=showFree() required>Free Group<br>
  <input type="radio" name="PrivacyOfGroup" value="paid" onclick=showPaid() required>Paid Group
  
  <div id="divPaid" class="hide">
            <h4>Enter amount<input type="text" name="amount" required></h4><br>
  </div><br><br>
  <label> Type of group</label>
  <select  name="TypeOfGroup" style="color: #fff;font-family: 'Roboto', sans-serif;background-color: #619245;">
      <option value="open">Open</option>
      <option value="closed">Closed</option>
    </select><br>
    <input class="new1" type="submit" value="Create">
  </form>
</div>

</body>
</html> 
<?php
}} else{
  header("location:index.php");
}
?>