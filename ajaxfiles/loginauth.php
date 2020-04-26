<?php session_start(); ?>
<?php
	$usr=trim($_REQUEST["x"]);
	$psw=trim($_REQUEST["y"]);
require 'dbconnect.php';	
mysqli_real_escape_string($conn,$usr);
$sql="SELECT password FROM users WHERE username='$usr'";
if($res=mysqli_query($conn,$sql))
{
$r=mysqli_fetch_row($res);
if($r[0]==$psw)
{
	$_SESSION["USER"]=strtolower($usr);
	echo true;
}
else
echo false;
}
else
	echo false;
mysqli_close($conn);
?>