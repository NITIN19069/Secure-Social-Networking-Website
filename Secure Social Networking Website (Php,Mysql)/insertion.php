<?php
include "dbConnection.php";
$UserName = $_POST['UserName'];
$FirstName= $_POST['FirstName'];
$LastName = $_POST['LastName'];
$Email = $_POST['Email'];
$Phone = $_POST['Phone'];
$Password = $_POST['Password'];
$cpass=$_POST['cpass'];
$Birthday=$_POST['Birthday'];
$Gender=$_POST['Gender'];
$Type_User=$_POST['Type_User'];		
$select = "SELECT * FROM sign_up WHERE Email = '$Email'";
$select2 = "SELECT * FROM sign_up WHERE UserName = '$UserName'";
$select3 = "SELECT * FROM sign_up WHERE Phone = '$Phone'";
$query = mysqli_query($con,$select);
$query2 = mysqli_query($con,$select2);
$query3 = mysqli_query($con,$select3);

if (mysqli_num_rows($query) > 0)
{
    header("location:SignUp.php?msg=Email");
}
else if (mysqli_num_rows($query2) > 0)
{
     header("location:SignUp.php?msg=Username");
}	
else if (mysqli_num_rows($query3) > 0)
{
    header("location:SignUp.php?msg=PhoneNo");
}
else{
	$verified = "No";
$otp = rand(1000,9999); 
$sub="Email Verification OTP";
$msg="The otp for the Email verification is $otp";
$rec=$_POST['Email'];
$ver="No";
mail($rec,$sub,$msg);
     $INSERT = "Insert into sign_up values ('$FirstName','$LastName','$UserName','$Email',$Phone,'$Password','$Birthday','$Gender','Casual','All','none')";
	 $otpInsert = "Insert into authentication values ('$otp','$Email','$verified',0)";
	$ewalletINSERT = "Insert into ewallet values ('$UserName',0,0,'$ver',0000)";
	$s=mysqli_query($con,$ewalletINSERT);
	$q=mysqli_query($con , $INSERT);
	$p=mysqli_query($con , $otpInsert);
		if($q && $p)
		{	if($Type_User=="Premium")
		{
			$Type_Of_Plan=$_POST['PremiumPlan'];
			$otp_payement = rand(1000,9999); 
			$Query= "Insert into payement values('$otp_payement','$Email',CURRENT_TIMESTAMP)";
			mysqli_query($con,$Query);
						if($Type_Of_Plan=="Gold"){
				$sub="Payment OTP";
				$msg="The otp for payment of Rs 100 for Premium Gold User is $otp_payement, For security purposes do not disclose this to anyone";
				$rec=$_POST['Email'];
				mail($rec,$sub,$msg);
		}
			if($Type_Of_Plan=="Silver"){
				$sub="Payment OTP";
				$msg="The otp for payment of Rs 50 for Premium Silver User is $otp_payement, For security purposes do not disclose this to anyone";
				$rec=$_POST['Email'];
				mail($rec,$sub,$msg);
			}
			if($Type_Of_Plan=="Platinum")
			{
				$sub="Payment OTP";
				$msg="The otp for payment of Rs 150 for Premium Platinum User is $otp_payement, For security purposes do not disclose this to anyone";
				$rec=$_POST['Email'];
				mail($rec,$sub,$msg);
			}
			
			session_start();
			$_SESSION["signed_in"]=true;
			$_SESSION["Username"] = $UserName;
			header("location:Pay.php?Type=$Type_Of_Plan&typeUser=$Type_User");
						
		}
		else if($Type_User=='Commercial')
		{
			$otp_payement = rand(1000,9999); 
			$sub="Payment OTP";
			$msg="The otp for confirming the payment of Rs 5000 is $otp_payement , For security purposes do not disclose this to anyone";
			$rec=$_POST['Email'];
			mail($rec,$sub,$msg);
			$Query= "Insert into payement values('$otp_payement','$Email',CURRENT_TIMESTAMP)";
			mysqli_query($con,$Query);
			session_start();
			$_SESSION["signed_in"]=true;
			$_SESSION["Username"] =$UserName;
			header("location:Pay.php?typeUser=$Type_User");
			
		}
		else{
			header("location:index.php");
		}}
		else{
			header("location:index.php?ab=??");
		}
}
?>