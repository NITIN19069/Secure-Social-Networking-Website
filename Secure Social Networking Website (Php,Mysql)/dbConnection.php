<?php
$host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "fcs";
    //create connection
    $con = new mysqli($host, $dbUsername, $dbPassword, $dbname);
	if (!$con) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } ?>