<?php
session_start();
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
include "Header.php";

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

<form method="post" enctype="multipart/form-data" action="checkPost.php" >
	<br>
		<br>
	<p class="tweet-body">

	<textarea class="status" name="status" placeholder="Write your post here!" rows="15" cols="60" style="background:#619245;" required></textarea> <br><br>
</p>
<p class="tweet-body">
	<input type="submit" value="Update Status" >
</p>
	</form>

</html><?php
}
else{
	header("location:index.php");
	} 
?>