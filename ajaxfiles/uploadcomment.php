<?php session_start();?>
<?php
$x=$_REQUEST["x"];
$y=$_REQUEST["y"];
$usr=$_SESSION["USER"];
require 'dbconnect.php';
	$usr=$_SESSION["USER"];
		mysqli_real_escape_string($conn,$usr);
		$flag=false;
$sql="SELECT username FROM users WHERE username='$usr'";
if($res=mysqli_query($conn,$sql))
{
while($r=mysqli_fetch_row($res))
{
	if ($r[0]!="") 
	{
		$flag=true;
	}
}
}
else
echo "<script>window.location='../index.php';</script>";
if (!$flag) 
{
echo "<script>window.location='../index.php';</script>";
}
if ($_SESSION["USER"]=="") 
{
echo "<script>window.location='index.php';</script>";
}
error_reporting(0);
mysqli_real_escape_string($post,$x);
mysqli_real_escape_string($post,$usr);
mysqli_real_escape_string($post,$y);
$sql="INSERT INTO comments(feedno,username,comment,likes) VALUES('$x','$usr','$y','0')";
if(mysqli_query($post,$sql))
	echo true;
else
	echo false;

?>