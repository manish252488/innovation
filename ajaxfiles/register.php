
<?php session_start(); ?>
<?php
require 'dbconnect.php';
if ($_SERVER["REQUEST_METHOD"]=="POST") 
{
	$name=trim($_POST["name"]);
	$mail=trim($_POST["mail"]);
	$dob=$_POST["dob"];
	$uname=$_POST["uname"];
	$pass=$_POST["psw1"];
$sql="SELECT * FROM users";
if (!mysqli_query($conn,$sql)) 
{
$sql="CREATE TABLE users(slno int not null AUTO_INCREMENT,username varchar(50),name varchar(50),email varchar(50),dob varchar(50),password varchar(50),registerdate TIMESTAMP,primary key(slno))";
mysqli_query($conn,$sql);
insertdata($conn,$name,$mail,$dob,$pass,$uname);
}
else
{
	insertdata($conn,$name,$mail,$dob,$pass,$uname);
}
}
function insertdata($c,$n,$m,$d,$p,$u)
{
mysqli_real_escape_string($c,$n);
mysqli_real_escape_string($c,$m);
mysqli_real_escape_string($c,$d);
mysqli_real_escape_string($c,$p);
mysqli_real_escape_string($c,$u);
$sql="INSERT INTO users (name,username,email,dob,password) VALUES('$n','$u','$m','$d','$p')";
if(mysqli_query($c,$sql))
{
$_SESSION["USER"]=strtolower($u);
	echo "<script>window.location='../feeds.php';</script>";
	mysqli_close($conn);
}
}
?>