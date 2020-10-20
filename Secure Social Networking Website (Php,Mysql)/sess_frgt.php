<?php
session_start();
$_SESSION["fgt_pwd"]=true;
header("Location:fgtPwdSendEmail.php");
?>